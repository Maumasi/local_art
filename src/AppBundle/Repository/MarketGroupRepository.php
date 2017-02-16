<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/15/17
 * Time: 9:29 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Artist;
use AppBundle\Entity\Venue;
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


    public function findByVenue(Venue $venue) {

        return $this->createQueryBuilder('market')
            ->andWhere('market.venue = :venue')
            ->setParameter('venue', $venue)
            ->getQuery()
            ->execute();
    }
}