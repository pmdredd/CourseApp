<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Coursework;
use App\Entity\Student;
use App\Entity\Submission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;
    private $students = array();
    private $courses = array();
    private $courseworks = array();

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        $this->loadStudents($manager);
        $this->loadCourses($manager);
        $this->loadCourseworks($manager);
        $this->loadSubmissions($manager);
    }

    private function loadStudents(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $student = new Student();
            $student->setName($this->faker->name);
            $manager->persist($student);
            $this->students[] = $student;
        }

        $manager->flush();
    }

    private function loadCourses(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $course = new Course();
            $course->setName($this->faker->words(3, true));

            $manager->persist($course);
            $this->courses[] = $course;
        }

        $manager->flush();
    }

    private function loadCourseworks(ObjectManager $manager)
    {
        for ($i = 1; $i <= 30; $i++) {
            $coursework = new Coursework();
            $coursework->setName($this->faker->words(5, true));
            $coursework->setDeadline($this->faker->dateTimeBetween('+01 days', '+1 month'));
            $coursework->setCreditWeight($this->faker->numberBetween(1, 15));
            $coursework->setFeedbackDueDate($this->faker->dateTimeBetween('+1 month','+2 months'));
            // get a random Course object from the $courses array, using index - 1 to avoid undefined offset error
            $coursework->setCourse($this->courses[rand(0, (count($this->courses) - 1))]);

            $manager->persist($coursework);
            $this->courseworks[] = $coursework;
        }

        $manager->flush();
    }

    private function loadSubmissions(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $submission = new Submission();
            $submission->setCoursework($this->courseworks[rand(0, (count($this->courseworks) - 1))]);
            $submission->setStudent($this->students[rand(0, (count($this->students) - 1))]);
            $submission->setMark($this->faker->numberBetween(1, 100));
            $submission->setHandInDate($this->faker->dateTimeBetween('+01 days', '+1 month'));
            $submission->setSecondSubmission(false);
            $submission->setGrade("A1");

            $manager->persist($submission);
        }

        $manager->flush();
    }
}
