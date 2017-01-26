<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/26/17
 * Time: 2:44 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController
{
    /**
     * @Route("/")
     */
    public function showTest(){
        return new Response("Liu's awesome test");
    }

}