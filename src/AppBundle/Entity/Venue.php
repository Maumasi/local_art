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
 * @ORM\Entity
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
     * @ORM\Column(type="string")
     */
    private $website;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $address1;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @ORM\Column(type="string")
     */
    private $address2;

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

    // this password should never persist
    /**
     * @Assert\NotBlank()
     */
    private $nakedPassword;



    // getters and setters

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

    public function getAddress1()
    {
        return $this->address1;
    }

    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function setAddress2($address2)
    {
        $this->address2 = $address2;
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
}