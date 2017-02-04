<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/31/17
 * Time: 8:05 PM
 */

namespace AppBundle\Controller\Secure;

use AppBundle\Entity\Venue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}