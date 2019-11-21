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
    private $grades = array('A1', 'A2', 'A3', 'A4', 'A5',
                            'B1', 'B2', 'B3',
                            'C1', 'C2', 'C3',
                            'D1', 'D2', 'D3',
                            'MF', 'CF', 'BF');

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
            $coursework->setCourse(array_rand(array_flip($this->courses)));

            $manager->persist($coursework);
            $this->courseworks[] = $coursework;
        }

        $manager->flush();
    }

    private function loadSubmissions(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $submission = new Submission();
            $submission->setCoursework(array_rand(array_flip($this->courseworks)));
            $submission->setStudent(array_rand(array_flip($this->students)));
            $submission->setMark($this->faker->numberBetween(1, 100));
            $submission->setHandInDate($this->faker->dateTimeBetween('+01 days', '+1 month'));
            $submission->setSecondSubmission(false);
            $submission->setGrade(array_rand(array_flip($this->grades)));

            $manager->persist($submission);
        }

        $manager->flush();
    }
}
