<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:02 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Artist;
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
            ->findArtistByUser($this->getUser());

        return $this->render(':secure/account/artist:artistProfile.html.twig', [
            'user' => $artist[0],
        ]);
    }
}