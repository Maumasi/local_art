<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:02 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
use AppBundle\Entity\MarketGroup;
use AppBundle\Entity\PendingInvitations;
use AppBundle\Entity\Venue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/account/artist")
 * @Security("is_granted('ROLE_ARTIST')")
 */
class ArtistController extends Controller
{

    /**
     * @Route("/", name="artist_profile")
     */
    public function artistProfile() {
        $em = $this->getDoctrine()->getEntityManager();
        $artist = $em->getRepository(Artist::class)
            ->findArtistByUser($this->getUser())[0];

        $artist = $em->getRepository(Artist::class)
            ->findArtistByUser($this->getUser())[0];

        $invitations = $em->getRepository(PendingInvitations::class)
            ->findByArtist($artist);

        $marketGroups = $em->getRepository(MarketGroup::class)
            ->findByArtist($artist);

        $totalPending = 0;
        foreach($invitations as $invite) {
            if($invite->getRequestStatus() == 'pending') {
                $totalPending++;
            }
        }

        return $this->render(':secure/account/artist:artistProfile.html.twig', [
            'user' => $artist,
            'total_invitations' => $totalPending,
            'marketGroups' => $marketGroups,
        ]);
    }


    /**
     * @Route("/marketInites", name="market_invites")
     */
    public function artistInvitations() {
        $em = $this->getDoctrine()->getEntityManager();
        $artist = $em->getRepository(Artist::class)
            ->findArtistByUser($this->getUser())[0];

        $invitations = $em->getRepository(PendingInvitations::class)
            ->findByArtist($artist);

        $pendingInvitations = 0;
        foreach($invitations as $invite ) {
            if($invite->getRequestStatus() == 'pending'){
                $pendingInvitations++;
            }
        }

        $response = $this->render(':secure/account/artist:artistInvitations.html.twig', [
            'user' => $artist,
            'invitations' => $invitations,
            'total_pending' => $pendingInvitations,
        ]);

        $response->setSharedMaxAge(10);

        return $response;
    }


    /**
     * @Route("/artistInviteResponse/{response}/{inviteId}", name="artist_invite_response")
     */
    public function artistInviteResponse($response, $inviteId) {

//        set the requset status
        $em = $this->getDoctrine()->getEntityManager();
        $invitation = $em->getRepository(PendingInvitations::class)
            ->find($inviteId);
        $invitation->setRequestStatus($response);
        $em->persist($invitation);
        $em->flush();

        if ($response == 'accepted') {

            $artist = $em->getRepository(Artist::class)
                ->findArtistByUser($this->getUser())[0];

            $venue = $em->getRepository(Venue::class)
                ->findVenueByUser($invitation->getVenue()->getUser())[0];

            $group = new MarketGroup();
            $group->setVenue($venue);
            $group->setArtist($artist);
            $em->persist($group);
            $em->flush();

        }// if

        return $this->redirectToRoute('market_invites');
    }
}