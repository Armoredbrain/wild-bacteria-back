<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 1; $i < 6; $i++) {
            $team = new Team();
            $team->setName("team " . $faker->domainWord);
            $this->addReference('team_'. $i, $team);
            $manager->persist($team);
        }
        $manager->flush();
    }
}
