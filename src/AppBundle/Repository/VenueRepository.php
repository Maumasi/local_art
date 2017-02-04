<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 2:45 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class VenueRepository extends EntityRepository
{
    public function findVenueByUser(User $user) {
        return $this->createQueryBuilder('venue')
            ->andWhere('venue.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }
}