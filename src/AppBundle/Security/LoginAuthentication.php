<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/1/17
 * Time: 12:32 AM
 */

namespace AppBundle\Security;


use AppBundle\Entity\User;
use AppBundle\Form\Login;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginAuthentication extends AbstractFormLoginAuthenticator
{

    private $formFactory;
    private $em;
    private $router;


    public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router)
    {

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
    }



    public function getCredentials(Request $request)
    {
        // bool to check is the login form was submitted
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');

        // failed login
        if(!$isLoginSubmit) {
            return null;
        }

        // successful login
        $loginForm = $this->formFactory->create(Login::class);
        $loginForm->handleRequest($request);

        $credentials = $loginForm->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['_email']
        );

        return $credentials;
    }



    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $userEmail = $credentials['_email'];

        return $this->em->getRepository(User::class)
            ->findOneBy(['email' => $userEmail]);
    }



    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        $foundMatch = false;

        // if email and password match return true
        if($password == '123123') {
            $foundMatch = true;
        }

        return $foundMatch;
    }


    // failed to login, keep user at /login
    protected function getLoginUrl()
    {
        return $this->router->generate('secure_login');
    }


    // login success, send user to their profile page
    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('home_page');
    }


}