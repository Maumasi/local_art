<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 2:40 PM
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $role = ['ROLE_USER'];


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Urls", mappedBy="user")
     */
    private $urls;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Phone", mappedBy="user")
     */
    private $phone;

    public function __construct()
    {
        $this->urls = new ArrayCollection();
        $this->phone = new ArrayCollection();
    }


    // getters and setters

    public function getId()
    {
        return $this->id;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function setRoles($role)
    {
        $this->role = $role;
    }


    public function getRoles()
    {
        return $this->role;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function eraseCredentials()
    {
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {
    }

}