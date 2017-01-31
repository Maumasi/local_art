<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 2:42 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_type")
 */
class UserType
{
    private $id;

    private $type;
}