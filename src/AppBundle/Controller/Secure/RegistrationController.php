<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:11 PM
 */

namespace AppBundle\Controller\Secure;


use AppBundle\Entity\Artist;
use AppBundle\Entity\User;
use AppBundle\Form\ArtistRegitration;
use AppBundle\Form\VenueRegistration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/registration")
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/artist", name="artist_registration")
     */
    public function artistRegistration(Request $request) {
        $form = $this->createForm(ArtistRegitration::class);

        // save data to the database if no form errors
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            // call entity manager and collect form data
            $em = $this->getDoctrine()->getManager();
            $newArtist = $form->getData();


            // use custom service to upload artist profile image
            $profileImg = $newArtist->getProfileImage();
            $imageName = $this->get('app.save_file')->img($profileImg);



            // create a new user entity for the artist
            $user = new User();
            $user->setEmail($newArtist->getEmail());
            $user->setNakedPassword($newArtist->getNakedPassword());
            $user->setCreatedAt(new \DateTime());
            $user->setRoles(['ROLE_USER', 'ROLE_ARTIST']);
            $em->persist($user);
            $em->flush();

            $newArtist->setUser($user);
            $newArtist->setProfileImage($imageName);

            $em->persist($newArtist);
            $em->flush();

            // success message
            $this->addFlash('artistRegistered', sprintf('Welcome %s, to Local Art!', $newArtist->getFirstName()));

            // send the user back to their intended path after registration
            // change default destination in AppBundle\Security\LoginAuthentication:getDefaultSuccessRedirectUrl
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $newArtist->getUser(),                  // user entity
                    $request,                               // request object
                    $this->get('app.secure.login_form'),    // authentication service
                    'main'                                  // firewall name from security.yml
                );

        }

        return $this->render(':secure:artistRegistration.html.twig', [
            'artistRegistration' => $form->createView(),
        ]);
    }



    /**
     * @Route("/venue", name="venue_registration")
     */
    public function venueRegistration(Request $request) {

        $form = $this->createForm(VenueRegistration::class);

        // save data to the database if no form errors
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            // call entity manager and collect form data
            $em = $this->getDoctrine()->getManager();
            $newVenue = $form->getData();


            // use custom service to upload venue profile image
            $profileImg = $newVenue->getProfileImage();
            $imageName = $this->get('app.save_file')->img($profileImg);
            $newVenue->setProfileImage($imageName);

//            market hours
            $marketHours = [
                [
                    'Sunday',
                    $newVenue->getSunOpen(),
                    $newVenue->getSunClose()

                ],
                [
                    'Monday',
                    $newVenue->getMonOpen(),
                    $newVenue->getMonClose()

                ],
                [
                    'Tuesday',
                    $newVenue->getTueOpen(),
                    $newVenue->getTueClose()

                ],
                [
                    'Wednesday',
                    $newVenue->getWedOpen(),
                    $newVenue->getWedClose()

                ],
                [
                    'Thursday',
                    $newVenue->getThuOpen(),
                    $newVenue->getThuClose()

                ],
                [
                    'Friday',
                    $newVenue->getFriOpen(),
                    $newVenue->getFriClose()

                ],
                [
                    'Saturday',
                    $newVenue->getSatOpen(),
                    $newVenue->getSatClose()

                ],
            ];

            $newVenue->setMarketHours($marketHours);


            // create a new user entity for the venue
            $user = new User();
            $user->setEmail($newVenue->getEmail());
            $user->setNakedPassword($newVenue->getNakedPassword());
            $user->setCreatedAt(new \DateTime());
            $user->setRoles(['ROLE_USER', 'ROLE_VENUE']);
            $em->persist($user);
            $em->flush();

            // create new venue
            $newVenue->setUser($user);
            $em->persist($newVenue);
            $em->flush();

            // success message
            $this->addFlash('venueRegistered', sprintf('Welcome %s, to Local Art!', $newVenue->getMarketName()));

            // send the user back to their intended path after registration
            // change default destination in AppBundle\Security\LoginAuthentication:getDefaultSuccessRedirectUrl
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $newVenue->getUser(),                   // user entity
                    $request,                               // request object
                    $this->get('app.secure.login_form'),    // authentication service
                    'main'                                  // firewall name from security.yml
                );
        }

        return $this->render(':secure:venueRegistration.html.twig', [
            'venueRegistration' => $form->createView(),
        ]);
    }
}