<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/14/17
 * Time: 5:41 PM
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Artist;
use AppBundle\Entity\Venue;
use Doctrine\ORM\EntityRepository;

class InvitationRepository extends EntityRepository
{
    public function findByVenue(Venue $venue) {

        return $this->createQueryBuilder('invite')
            ->andWhere('invite.venue = :venue')
            ->setParameter('venue', $venue)
            ->getQuery()
            ->execute();

    }

    public function findByArtist(Artist $artist) {

        return $this->createQueryBuilder('invite')
            ->andWhere('invite.artist = :artist')
            ->setParameter('artist', $artist)
            ->getQuery()
            ->execute();

    }

}