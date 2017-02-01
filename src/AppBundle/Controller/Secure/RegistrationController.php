<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:11 PM
 */

namespace AppBundle\Controller\Secure;


use AppBundle\Entity\User;
use AppBundle\Form\ArtistRegitration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/registration/artist", name="artist_registration")
     */
    public function artistRegistration(Request $request) {
        $form = $this->createForm(ArtistRegitration::class);

        // save data to the database if no form errors
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            // call entity manager and collect form data
            $em = $this->getDoctrine()->getManager();
            $newArtist = $form->getData();

            //dump($newArtist->getProfileImage());die;

            // create a new user entity for the artist
            $user = new User();
            $user->setEmail($newArtist->getEmail());
            $user->setCreatedAt(new \DateTime());
            $user->setUserRole('ROLE_ARTIST');
            $em->persist($user);
            $em->flush();

            $newArtist->setUser($user);
            $em->persist($newArtist);
            $em->flush();

            // success message
            $this->addFlash('artistRegistered', 'Welcome '.$newArtist->getFirstName().'! to Local Art!');

            // redirect
            return $this->redirectToRoute('home');
        }

        return $this->render(':Secure:artistRegistration.html.twig', [
            'artistRegistration' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registration/venue")
     */
    public function venueRegistration() {

    }
}