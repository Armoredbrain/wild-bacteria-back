<?php

namespace App\DataFixtures;

use App\Entity\Bacteria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class BacteriaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $bacteria = new Bacteria();
            $bacteria->setName($faker->colorName);
            $bacteria->setAvatar();
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
    }
}
