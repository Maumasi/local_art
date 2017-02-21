<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 4:47 AM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class ArtistRepository extends EntityRepository
{

    public function findArtistByUser(User $user) {
        return $this->createQueryBuilder('artist')
            ->andWhere('artist.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();

    }


    public function findByEitherFirstLastOrBusinessNameOrEmail($name, $artistIds) {

//        prevent this query from returning everything from this table
        if(!$name) {
            return null;
        }

        $qb = $this->createQueryBuilder('artist');

        return $this->createQueryBuilder('artist')
            ->andWhere($qb->expr()->like('artist.firstName', ':name'))
            ->orWhere($qb->expr()->like('artist.lastName', ':name'))
            ->orWhere($qb->expr()->like('artist.businessName', ':name'))
            ->orWhere($qb->expr()->like('artist.email', ':name'))
            ->andWhere('artist.id NOT IN (:artistIds)')
            ->setParameter('name', $name.'%')
            ->setParameter('artistIds', $artistIds)
            ->getQuery()
            ->execute();
    }


    public function findByFullNameAndBusinessName($firstName, $lastName, $businessName, $artistIds)
    {
        $qb = $this->createQueryBuilder('artist');

        return $this->createQueryBuilder('artist')
            ->andWhere($qb->expr()->like('artist.firstName', ':firstName'))
            ->orWhere($qb->expr()->like('artist.lastName', ':lastName'))
            ->orWhere($qb->expr()->like('artist.businessName', ':businessName'))
            ->andWhere('artist.id NOT IN (:artistIds)')
            ->setParameter('firstName', $firstName . '%')
            ->setParameter('lastName', $lastName . '%')
            ->setParameter('businessName', $businessName . '%')
            ->setParameter('artistIds', $artistIds)
            ->getQuery()
            ->execute();
    }
}