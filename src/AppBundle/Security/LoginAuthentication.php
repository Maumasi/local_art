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
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
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
    private $passwordEncoder;
    private $user;


    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManager $em,
        RouterInterface $router,
        UserPasswordEncoder $passwordEncoder,
        User $user
    ){

        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
        $this->user = $user;
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

        $this->user = $this->em->getRepository(User::class)
            ->findOneBy(['email' => $userEmail]);

        return $this->em->getRepository(User::class)
            ->findOneBy(['email' => $userEmail]);
    }



    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['_password'];
        $foundMatch = false;

        // if email and password match return true
        if($this->passwordEncoder->isPasswordValid($user, $password)) {
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

//        if() {
//            return $this->router->generate('artist_profile');
//
//        } elseif ($this->authorizationChecker->isGranted('ROLE_VENUE')) {
//            return $this->router->generate('venue_profile');
//
//        } else {
            return $this->router->generate('home_page');
//        }
    }


}