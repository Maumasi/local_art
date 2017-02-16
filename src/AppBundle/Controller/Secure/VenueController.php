<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:05 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
use AppBundle\Entity\PendingInvitations;
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
            ->findVenueByUser($this->getUser())[0];

        $pendingInites = $em->getRepository(PendingInvitations::class)
            ->findByVenue($venue);

        $totalPending = 0;
        foreach($pendingInites as $invite) {
            if($invite->getRequestStatus() == 'pending') {
                $totalPending++;
            }
        }

        return $this->render(':secure/account/venue:venueProfile.html.twig', [
            'user' => $venue,
            'pending_invites' => $totalPending,
        ]);
    }


    /**
     * @Route("/inviteArtist", name="invite_artist_to_market")
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

            return $this->render(':secure/account/venue:venueInviteArtist.html.twig', [
                'artistSearch' => $form->createView(),
                'artists' => $artistsRequested
            ]);

        }

        return $this->render(':secure/account/venue:venueInviteArtist.html.twig', [
            'artistSearch' => $form->createView(),
            'artists' => null
        ]);
    }

    /**
     * @Route("/inviteArtist/{id}", name="send_to_invite_artist")
     */
    public function sendInvitationToArtist($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $selectedArtist = $em->getRepository(Artist::class)
            ->find($id);

        $currentVenue = $em->getRepository(Venue::class)
            ->findVenueByUser($this->getUser());

        $invitation = new PendingInvitations();
        $invitation->setArtist($selectedArtist);
        $invitation->setVenue($currentVenue[0]);
        $invitation->setRequestStatus('pending');

        $em->persist($invitation);
        $em->flush();

        return $this->render(':secure/account/venue:venueProfile.html.twig', [
            'user' => $currentVenue[0],
        ]);
    }

    /**
     * @Route("/retractInvitation/{id}", name="remove_invitation")
     */
    public function removeInvitation($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $invitation = $em->getRepository(PendingInvitations::class)
            ->find($id);

        $em->remove($invitation);
        $em->flush();

        return self::
    }
}