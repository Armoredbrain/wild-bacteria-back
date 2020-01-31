<?php

namespace App\DataFixtures;

use App\Entity\Bacteria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class BacteriaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) : void
    {
        $bacteriaName = [
          'bio',
          'bacteria',
          'micro',
          'bacterium',
          'pathogenic',
          'cell',
          'mitochondrion',
        ];

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $bacteria = new Bacteria();
            $bacteria->setName($bacteriaName[rand(0,6)] . ' ' . $faker->userName);
            $bacteria->setAvatar("bacteria_" . rand(1,5) . ".jpg");
            $bacteria->setInstrument($this->getReference('instrument_' . rand(1, 5)));
            $bacteria->setTeam($this->getReference('team_' . rand(1, 5)));
            $manager->persist($bacteria);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies() : array
    {
        return [InstrumentFixtures::class];
    }
}
