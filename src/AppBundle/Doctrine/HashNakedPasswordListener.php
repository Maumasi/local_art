<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 1:58 AM
 */

namespace AppBundle\Doctrine;



use AppBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashNakedPasswordListener implements  EventSubscriber
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoder $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function prePersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        if(!$entity instanceof User) {
            return null;
        }

        $this->encodePassword($entity);

    }


    public function preUpdate(LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        if(!$entity instanceof User) {
            return null;
        }

        $this->encodePassword($entity);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);

    }


    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    /**
     * @param User $entity
     */
    private function encodePassword(User $entity)
    {
        $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getNakedPassword());
        $entity->setPassword($encoded);
    }

}