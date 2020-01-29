<?php

namespace App\DataFixtures;

use App\Entity\Host;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class HostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) : void
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 3; $i++) {
            $host = new Host();
            $host->setName($faker->userName);
            $host->setAvatar('host_' . rand(1, 5));
            $host->setTeam($this->getReference('team_' . rand(1, 5)));
            $manager->persist($host);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies() : array
    {
        return [TeamFixtures::class];
    }
}
