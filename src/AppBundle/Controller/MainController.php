<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/26/17
 * Time: 2:44 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Venue;
use AppBundle\Form\MarketSearch;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="home_page")
     */
    public function homePage()
    {

        return $this->render('main/index.html.twig');
    }


    /**
     * @Route("/search", name="market_search")
     */
    public function  marketSearch(Request $request){


        $form = $this->createForm(MarketSearch::class);
        $em = $this->getDoctrine()->getEntityManager();
        $venues = $em->getRepository(Venue::class);

//        check for search results
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $search = $form->getData();
            $marketSearchResults = [];

            if(!$search['zipCode']) {
                $marketSearchResults = $venues->findAllVenuesByAddress($search['city'], $search['state']);
            } else {
                $marketSearchResults = $venues->findAllVenuesByZipCode($search['zipCode']);
            }


            return $this->render('main/marketSearch.html.twig', [
                'marketSearch' => $form->createView(),
                'results' => $marketSearchResults,
            ]);
        }

//        search form not submitted
        return $this->render('main/marketSearch.html.twig', [
            'marketSearch' => $form->createView(),
            'results' => null,
        ]);
    }

}