<?php

namespace App\DataFixtures;

use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class InstrumentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 4; $i++) {
            $instrument = new Instrument();
            $instrument->setName($faker->colorName);
            $instrument->setSound("sound_" . rand(1,5));
            $this->addReference('instrument_'. rand(1,5), $instrument);
        }
        $manager->flush();
    }
}
