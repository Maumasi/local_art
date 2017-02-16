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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarketGroupRepository")
 * @ORM\Table(name="market_group")
 */
class MarketGroup
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Artist", inversedBy="markets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Venue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $venue;


//    getters and setters
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