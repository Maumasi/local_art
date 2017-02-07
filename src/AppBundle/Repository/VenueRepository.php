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

//    find venues by their user id
    public function findVenueByUser(User $user) {
        return $this->createQueryBuilder('venue')
            ->andWhere('venue.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }

//    find all venues that have similar
    public function findAllVenuesByAddress($city, $state) {

        $qb = $this->createQueryBuilder('venue');

        return $qb
            ->andWhere('venue.state = :state')
            ->andWhere( $qb->expr()->like('venue.city', ':city'))
            ->setParameter('city', '%'.$city.'%')
            ->setParameter('state', $state)
            ->getQuery()
            ->execute();
    }

    public function findAllVenuesByZipCode($zipCode){

        $qb = $this->createQueryBuilder('venue');

        return $qb
            ->andWhere($qb->expr()->like('venue.zipCode', ':zipCode'))
            ->setParameter('zipCode', $zipCode.'%')
            ->getQuery()
            ->execute();
    }
}