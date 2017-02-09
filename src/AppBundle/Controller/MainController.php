<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 1/26/17
 * Time: 2:44 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\State;
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
    public function homePage(Request $request)
    {



//        persist all states if they are not already in the database
        $em = $this->getDoctrine()->getEntityManager();
        $states = $em->getRepository(State::class);

        if(!$states->findAll()) {
            foreach ($this->states() as $key => $state) {

                $addstate = new State();
                $addstate->setState($state);
                $addstate->setStateAbbr($key);
                $em->persist($addstate);
                $em->flush();
            }
        }


        $form = $this->createForm(MarketSearch::class);
        $venues = $em->getRepository(Venue::class);

//        check for search results
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $search = $form->getData();
            $marketSearchResults = [];
            $usedZipCode = false;

//            only used the zip code to fild markets
            if($search['zipCode']) {
                $marketSearchResults = $venues->findAllVenuesByZipCode($search['zipCode']);
                $usedZipCode = true;
            }

//            if zip code input was quesied and there were no results returned or if zip code was not used
            if($usedZipCode && !$marketSearchResults || !$usedZipCode) {
                $marketSearchResults = $venues->findAllVenuesByAddress($search['city'], $search['state']);
            }

//            if the search form has been submitted with no searchable input, set to null
            if( !($search['zipCode'] || $search['state'])) {
                $noResultsResponce = null;

            } elseif($search['zipCode']) {
                $noResultsResponce = 'zip code '.$search['zipCode'];

            } elseif($search['state'] && $search['city']) {
                $noResultsResponce = ucwords($search['city']).', '.$search['state'];
            } else {
                $noResultsResponce = $search['state'];
            }

            return $this->render(':main:index.html.twig', [
                'marketSearch' => $form->createView(),
                'results' => $marketSearchResults,
                'search' => $noResultsResponce,
            ]);
        }

//        search form not submitted
        return $this->render(':main:index.html.twig', [
            'marketSearch' => $form->createView(),
            'results' => null,
            'search' => null,
        ]);
    }


    /**
     * @Route("/details/{marketId}/{marketName}", name="market_details")
     */
    public function marketDetails($marketId) {

        $em = $this->getDoctrine()->getEntityManager();
        $venue = $em->getRepository(Venue::class);
        $market = $venue->find($marketId);

        return $this->render('main/marketDetailsPage.html.twig', [
            'market' => $market,
        ]);

    }


    public function states() {
        return [
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming',
        ];
    }
}