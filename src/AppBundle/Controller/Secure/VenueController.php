<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:05 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
use AppBundle\Entity\MarketGroup;
use AppBundle\Entity\PendingInvitations;
use AppBundle\Entity\Venue;
use AppBundle\Form\ArtistSearch;
use AppBundle\Repository\ArtistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/account/venue", schemes={"%secure_channel%"})
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

        $marketGroup = $em->getRepository(MarketGroup::class)
            ->findByVenue($venue);

//        make array of artist ids
        $artistIds = [];
        foreach($marketGroup as $member) {
            $artistIds[] = $member->getArtist()->getId();
        }

        $artists = $em->getRepository(Artist::class)
            ->findBy(['id' => $artistIds]);


        return $this->render(':secure/account/venue:venueProfile.html.twig', [
            'user' => $venue,
            'pending_invites' => $totalPending,
            'artists' => $artists,
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

            $venue = $em->getRepository(Venue::class)
                ->findVenueByUser($this->getUser())[0];
            $sentRequests = $em->getRepository(PendingInvitations::class)
                ->findByVenue($venue);

            $artistIds = [];
            foreach($sentRequests as $request) {
                $artistIds[] = $request->getArtist()->getId();
            }


            $artistQuery = $form->getData();
            $artistSearch = explode(" ", $artistQuery['artist']);

//            is it possible that a first name and last name was queried?
            if(count($artistSearch) >= 2) {
                $artistsRequested = $artist->findByFullNameAndBusinessName($artistSearch[0], $artistSearch[1], $artistQuery['artist'], $artistIds);
            } else {
                $artistsRequested = $artist->findByEitherFirstLastOrBusinessNameOrEmail($artistQuery['artist'], $artistIds);
            }

            return $this->render(':secure/account/venue:venueInviteArtist.html.twig', [
                'artistSearch' => $form->createView(),
                'artists' => $artistsRequested,
                'query' => $artistQuery['artist'],
            ]);

        }

        return $this->render(':secure/account/venue:venueInviteArtist.html.twig', [
            'artistSearch' => $form->createView(),
            'artists' => null,
            'query' => null,
        ]);
    }

    /**
     * @Route("/inviteArtist/{id}", name="send_invite_to_artist")
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

        return $this->redirectToRoute('invite_artist_to_market');
    }


    /**
     * @Route("/pendingInvitations", name="pending_invitations")
     */
    public function pendingArtistInvites() {

        $em = $this->getDoctrine()->getEntityManager();
        $venue = $em->getRepository(Venue::class)
            ->findVenueByUser($this->getUser())[0];

        $invitations = $em->getRepository(PendingInvitations::class)
            ->findByVenue($venue);

        $response = $this->render(':secure/account/venue:venuePendingInvitations.html.twig', [
            'invitations' => $invitations,
        ]);

        $response->setSharedMaxAge(10);

        return $response;
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

        return $this->redirectToRoute('pending_invitations');
    }
}