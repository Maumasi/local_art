<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 1:58 AM
 */

namespace AppBundle\Doctrine;



use AppBundle\Entity\Artist;
use AppBundle\Entity\User;
use AppBundle\Entity\Venue;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashNakedPasswordListener implements  EventSubscriber
{

    private $passwordEncoder;
    /**
     * @var Artist
     */
    private $artist;
    /**
     * @var Venue
     */
    private $venue;

    public function __construct(UserPasswordEncoder $passwordEncoder, Artist $artist, Venue $venue)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->artist = $artist;
        $this->venue = $venue;
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


    private function encodePassword(User $entity)
    {
        if(!empty($entity->getNakedPassword())) {
            $encoded = $this->passwordEncoder->encodePassword($entity, $entity->getNakedPassword());
            $entity->setPassword($encoded);
        }
    }

}