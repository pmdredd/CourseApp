<?php

namespace App\DataFixtures;

use App\Entity\Coursework;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CourseworkFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            $coursework = new Coursework();
            $coursework->setName($this->faker->words(5, true));
            $coursework->setDeadline($this->faker->dateTimeBetween('+01 days', '+1 month'));
            $coursework->setCreditWeight($this->faker->numberBetween(1, 10));
            $coursework->setFeedbackDueDate($this->faker->dateTimeBetween('+1 month','+2 months'));
            $coursework->setCourse($this->faker)
            $manager->persist($coursework);
        }

        $manager->flush();
    }
}
