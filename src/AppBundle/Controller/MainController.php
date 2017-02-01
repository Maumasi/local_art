<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/26/17
 * Time: 2:44 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homePage()
    {

        return $this->render('main/index.html.twig');
    }

}