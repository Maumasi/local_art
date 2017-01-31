<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 2:40 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artist")
 */
class Artist
{
    private $id;

    private $firstName;

    private $lastName;

    private $bio;

    private $businessName;

    private $profileImage;


    // user

    // phone

    // urls


}