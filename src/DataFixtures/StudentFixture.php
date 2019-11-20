<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class StudentFixture extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            $student = new Student();
            $student->setName($this->faker->name);
            $manager->persist($student);
        }

        $manager->flush();
    }
}
