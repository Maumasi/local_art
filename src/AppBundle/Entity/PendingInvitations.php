<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/14/17
 * Time: 1:08 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="pending_invitations")
 */
class PendingInvitations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Venue", inversedBy="invitations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $venue;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Artist", inversedBy="invitations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * @ORM\Column(type="string")
     */
    private $requestStatus;


//    getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function getRequestStatus()
    {
        return $this->requestStatus;
    }

    public function setRequestStatus($requestStatus)
    {
        $this->requestStatus = $requestStatus;
    }
}