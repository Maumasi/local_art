<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:05 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
use AppBundle\Entity\Venue;
use AppBundle\Form\ArtistSearch;
use AppBundle\Repository\ArtistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/account/venue")
 * @Security("is_granted('ROLE_VENUE')")
 */
class VenueController extends Controller
{

    /**
     * @Route("/", name="venue_profile")
     */
    public function venueProfile() {
        $em = $this->getDoctrine()->getEntityManager();
        $venue = $em->getRepository(Venue::class)
            ->findVenueByUser($this->getUser());

        return $this->render(':secure/account/venue:venueProfile.html.twig', [
            'user' => $venue[0],
        ]);
    }


    /**
     * @Route("/inviteArtists", name="invite_artist_to_market")
     */
    public function inviteArtistToMarket(Request $request) {

        $form = $this->createForm(ArtistSearch::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $artist = $em->getRepository(Artist::class);
//            $artistByFirstName;

            $artistQuery = $form->getData();
            $artistSearch = explode(" ", $artistQuery['artist']);

//            is it possible that a first name and last name was queried?
            if(count($artistSearch) >= 2) {
                $artistsRequested = $artist->findByFullNameAndBusinessName($artistSearch[0], $artistSearch[1], $artistQuery['artist']);
            } else {
                $artistsRequested = $artist->findByEitherFirstLastOrBusinessName($artistQuery['artist']);
            }

            dump($artistsRequested); die;

        }

        return $this->render(':secure/account/venue:venueInviteArtist.html.twig', [
            'artistSearch' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inviteArtists/{artist}")
     */
    public function sendInvitationToArtist(Artist $artist) {


    }
}