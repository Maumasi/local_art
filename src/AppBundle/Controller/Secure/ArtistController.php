<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:02 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
use AppBundle\Entity\PendingInvitations;
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

        return $this->render(':secure/account/artist:artistProfile.html.twig', [
            'user' => $artist,
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

        return $this->render(':secure/account/artist:artistInvitations.html.twig', [
            'user' => $artist,
            'invitations' => $invitations,
        ]);
    }
}