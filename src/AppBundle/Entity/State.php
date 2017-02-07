<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/7/17
 * Time: 2:01 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="state")
 */
class State
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @ORM\Column(type="string")
     */
    private $stateAbbr;

    /**
     * @return mixed
     */
    public function getStateAbbr()
    {
        return $this->stateAbbr;
    }

    /**
     * @param mixed $stateAbbr
     */
    public function setStateAbbr($stateAbbr)
    {
        $this->stateAbbr = $stateAbbr;
    }

//    getters and setters
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    public function __toString()
    {
        return $this->getState();
    }

}