<?php

namespace App\DataFixtures;

use App\Entity\Course;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CourseFixtures extends Fixture
{
    public const COURSE_COURSEWORK_REFERENCE = 'admin-user';

    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            $course = new Course();
            $course->setName($this->faker->words(3, true));
            $manager->persist($course);
        }

        $manager->flush();
    }
}
