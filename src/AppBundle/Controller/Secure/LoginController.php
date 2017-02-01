<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:05 PM
 */

namespace AppBundle\Controller\Secure;


use AppBundle\Form\Login;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LoginController extends Controller
{
    /**
     * @Route("/login", name="secure_login")
     */
    public function login() {

        $securityUtil = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $securityUtil->getLastAuthenticationError();

        // last username entered by the user
        $lastEmail = $securityUtil->getLastUsername();

        $loginForm = $this->createForm(Login::class, [
            '_email' => $lastEmail,
        ]);

        return $this->render('secure/login.html.twig', [
            'login_form' => $loginForm->createView(),
            'error'         => $error,
        ]);
    }
}