<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\Coursework;
use App\Entity\Student;
use App\Entity\Submission;
use App\Service\GradeCalculator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;
    private $students = array();
    private $courses = array();
    private $courseworks = array();
    private $gradeCalculator;

    /**
     * AppFixtures constructor.
     * @param $gradeCalculator
     */
    public function __construct(GradeCalculator $gradeCalculator)
    {
        $this->gradeCalculator = $gradeCalculator;
    }


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
            // faker returns a datetime object, but our model stores dates as a string, so we must format the obj into a string
            $deadline = $this->faker->dateTimeBetween('+01 days', '+1 month');
            $coursework->setDeadline($deadline->format('Y-m-d')); 
            $coursework->setCreditWeight($this->faker->numberBetween(1, 15));
            $coursework->setFeedbackDueDate($this->faker->dateTimeBetween('+1 month','+2 months')->format('Y-m-d'));
            // get a random Course object from the $courses array, using index - 1 to avoid undefined offset error
            $coursework->setCourse($this->courses[array_rand($this->courses)]);

            $manager->persist($coursework);
            $this->courseworks[] = $coursework;
        }

        $manager->flush();
    }

    private function loadSubmissions(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $submission = new Submission();
            $submission->setCoursework($this->courseworks[array_rand($this->courseworks)]);
            $submission->setStudent($this->students[array_rand($this->students)]);
            $submission->setMark($this->faker->numberBetween(1, 100));
            $submission->setHandInDate($this->faker->dateTimeBetween('+01 days', '+1 month')->format('Y-m-d'));
            $submission->setIsSecondSubmission($this->faker->boolean(10)); // 10% chance of being true
            $submission->setGrade($this->gradeCalculator->calculateGrade($submission->getMark(), $submission->isIsSecondSubmission()));

            $manager->persist($submission);
        }

        $manager->flush();
    }
}
