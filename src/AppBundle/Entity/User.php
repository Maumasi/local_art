<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 2:40 PM
 */

namespace AppBundle\Entity;

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
    private $password;

    private $nakedPassword;

    /**
     * @ORM\Column(type="string")
     */
    private $userRole = ['ROLE_USER'];


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;


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


    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }


    public function getRoles()
    {
        return ['ROLE_USER', $this->userRole];
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        $this->password;
    }

    public function getNakedPassword()
    {
        return $this->nakedPassword;
    }

    public function setNakedPassword($nakedPassword)
    {
        $this->nakedPassword = $nakedPassword;

        // need this to trick doctrine to think $password has been changed
        $this->password = null;
    }



    public function eraseCredentials()
    {
        // making sure this is never saved ever
        $this->nakedPassword = null;
    }

    public function getSalt()
    {
    }

}