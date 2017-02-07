<?php
/**
 * Created by PhpStorm.
 * User: liumaumasi
 * Date: 2/6/17
 * Time: 4:44 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadDummyData implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__.'/fixtures.yml', $manager);
    }
}
