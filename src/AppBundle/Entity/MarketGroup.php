<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/15/17
 * Time: 9:10 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="market_group")
 */
class MarketGroup
{

    private $id;

    private $artist;

    private $venue;

    public function getId()
    {
        return $this->id;
    }

    public function getArtist()
    {
        return $this->artist;
    }


    public function setArtist($artist)
    {
        $this->artist = $artist;
    }


    public function getVenue()
    {
        return $this->venue;
    }


    public function setVenue($venue)
    {
        $this->venue = $venue;
    }


}