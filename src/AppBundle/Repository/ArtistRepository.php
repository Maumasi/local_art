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

    public function findArtistUser(User $user) {
        return $this->createQueryBuilder('artist')
            ->andWhere('artist.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();

    }
}