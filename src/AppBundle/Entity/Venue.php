<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 2:51 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VenueRepository")
 * @UniqueEntity(fields={"email"}, message="A venue account already exists with this email")
 * @ORM\Table(name="venue")
 */
class Venue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bio;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $marketName;

    /**
     * @ORM\Column(type="string")
     */
    private $marketSubtitle;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $profileImage;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $website;


    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $streetAddress;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\State")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;


    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $zipCode;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PendingInvitations", mappedBy="venue")
     */
    private $invitations;

    /**
     * @ORM\Column(type="json_array")
     */
    private $artistCollection = [];


//    this password should never persist
    /**
     * @Assert\NotBlank()
     */
    private $nakedPassword;

//    market hours

    /**
     * @Assert\NotBlank()
     */
    private $sunOpen;

    /**
     * @Assert\NotBlank()
     */
    private $monOpen;

    /**
     * @Assert\NotBlank()
     */
    private $tueOpen;

    /**
     * @Assert\NotBlank()
     */
    private $wedOpen;

    /**
     * @Assert\NotBlank()
     */
    private $thuOpen;

    /**
     * @Assert\NotBlank()
     */
    private $friOpen;

    /**
     * @Assert\NotBlank()
     */
    private $satOpen;

    /**
     * @Assert\NotBlank()
     */
    private $sunClose;

    /**
     * @Assert\NotBlank()
     */
    private $monClose;

    /**
     * @Assert\NotBlank()
     */
    private $tueClose;

    /**
     * @Assert\NotBlank()
     */
    private $wedClose;

    /**
     * @Assert\NotBlank()
     */
    private $thuClose;

    /**
     * @Assert\NotBlank()
     */
    private $friClose;

    /**
     * @Assert\NotBlank()
     */
    private $satClose;


    /**
     * @ORM\Column(type="json_array")
     */
    private $marketHours = [];



//    getters and setters

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getMarketName()
    {
        return $this->marketName;
    }

    public function setMarketName($marketName)
    {
        $this->marketName = $marketName;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getMarketSubtitle()
    {
        return $this->marketSubtitle;
    }

    public function setMarketSubtitle($marketSubtitle)
    {
        $this->marketSubtitle = $marketSubtitle;
    }

    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    public function setStreetAddress($streetAddress)
    {
        $this->streetAddress = $streetAddress;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getNakedPassword()
    {
        return $this->nakedPassword;
    }

    public function setNakedPassword($nakedPassword)
    {
        $this->nakedPassword = $nakedPassword;
    }

    public function getSunOpen()
    {
        return $this->sunOpen;
    }

    public function setSunOpen($sunOpen)
    {
        $this->sunOpen = $sunOpen;
    }

    public function getMonOpen()
    {
        return $this->monOpen;
    }

    public function setMonOpen($monOpen)
    {
        $this->monOpen = $monOpen;
    }

    public function getTueOpen()
    {
        return $this->tueOpen;
    }

    public function setTueOpen($tueOpen)
    {
        $this->tueOpen = $tueOpen;
    }

    public function getWedOpen()
    {
        return $this->wedOpen;
    }

    public function setWedOpen($wedOpen)
    {
        $this->wedOpen = $wedOpen;
    }

    public function getThuOpen()
    {
        return $this->thuOpen;
    }

    public function setThuOpen($thuOpen)
    {
        $this->thuOpen = $thuOpen;
    }

    public function getFriOpen()
    {
        return $this->friOpen;
    }

    public function setFriOpen($friOpen)
    {
        $this->friOpen = $friOpen;
    }

    public function getSatOpen()
    {
        return $this->satOpen;
    }

    public function setSatOpen($satOpen)
    {
        $this->satOpen = $satOpen;
    }

    public function getSunClose()
    {
        return $this->sunClose;
    }

    public function setSunClose($sunClose)
    {
        $this->sunClose = $sunClose;
    }

    public function getMonClose()
    {
        return $this->monClose;
    }

    public function setMonClose($monClose)
    {
        $this->monClose = $monClose;
    }

    public function getTueClose()
    {
        return $this->tueClose;
    }

    public function setTueClose($tueClose)
    {
        $this->tueClose = $tueClose;
    }

    public function getWedClose()
    {
        return $this->wedClose;
    }

    public function setWedClose($wedClose)
    {
        $this->wedClose = $wedClose;
    }

    public function getThuClose()
    {
        return $this->thuClose;
    }

    public function setThuClose($thuClose)
    {
        $this->thuClose = $thuClose;
    }

    public function getFriClose()
    {
        return $this->friClose;
    }

    public function setFriClose($friClose)
    {
        $this->friClose = $friClose;
    }

    public function getSatClose()
    {
        return $this->satClose;
    }

    public function setSatClose($satClose)
    {
        $this->satClose = $satClose;
    }

    public function getMarketHours()
    {
        return $this->marketHours;
    }

    public function setMarketHours($marketHours)
    {
        $this->marketHours = $marketHours;
    }

    public function getInvitations()
    {
        return $this->invitations;
    }

    public function setInvitations($invitations)
    {
        $this->invitations = $invitations;
    }

    public function getArtistCollection()
    {
        return $this->artistCollection;
    }

    public function setArtistCollection($artistCollection)
    {
        $this->artistCollection = $artistCollection;
    }


}