<?php

namespace App\DataFixtures;

use App\Entity\Disease;
use App\Entity\Drug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10000; $i++) {
            $disease = new Disease();
            $disease->setName($this->faker->sentence(2) . $this->faker->randomNumber(5));
            for ($k = 0; $k < 3; $k++) {
                $drug = new Drug();
                $drug->setName($this->faker->sentence(2) . $this->faker->randomNumber(5));
                $manager->persist($drug);
                $disease->addDrug($drug);
            }
            $manager->persist($disease);
        }

        $manager->flush();
    }
}
