<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/15/17
 * Time: 9:29 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Artist;
use Doctrine\ORM\EntityRepository;

class MarketGroupRepository extends EntityRepository
{

    public function findByArtist(Artist $artist) {

        return $this->createQueryBuilder('market')
            ->andWhere('market.artist = :artist')
            ->setParameter('artist', $artist)
            ->getQuery()
            ->execute();
    }
}