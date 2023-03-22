<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseWork;
use App\Entity\Student;
use App\Entity\Submission;
use App\Service\GradeCalculator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;
    /** @var array<Student> $students */
    private array $students = array();
    /** @var array<Course> $courses */
    private array $courses = array();
    /** @var array<CourseWork> $courseworks */
    private array $courseworks = array();
    private GradeCalculator $gradeCalculator;

    /**
     * AppFixtures constructor.
     * @param GradeCalculator $gradeCalculator
     */
    public function __construct(GradeCalculator $gradeCalculator)
    {
        $this->gradeCalculator = $gradeCalculator;
    }

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        $this->loadStudents($manager);
        $this->loadCourses($manager);
        $this->loadCourseWorks($manager);
        $this->loadSubmissions($manager);
    }

    private function loadStudents(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $student = new Student();
            $student->setName($this->faker->name);
            $manager->persist($student);
            $this->students[] = $student;
        }

        $manager->flush();
    }

    private function loadCourses(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $course = new Course();
            $course->setName($this->faker->words(3, true));

            $manager->persist($course);
            $this->courses[] = $course;
        }

        $manager->flush();
    }

    private function loadCourseWorks(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $coursework = new CourseWork();
            $coursework->setName($this->faker->words(5, true));
            $coursework->setDeadline($this->faker->dateTime());
            $coursework->setCreditWeight($this->faker->numberBetween(1, 15));
            $coursework->setFeedbackDueDate($this->faker->dateTimeBetween('+1 month', '+2 months'));
            $coursework->setCourse($this->courses[array_rand($this->courses)]);

            $manager->persist($coursework);
            $this->courseworks[] = $coursework;
        }

        $manager->flush();
    }

    private function loadSubmissions(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $submission = new Submission();
            $submission->setCoursework($this->courseworks[array_rand($this->courseworks)]);
            $submission->setStudent($this->students[array_rand($this->students)]);
            $submission->setMark($this->faker->numberBetween(1, 100));
            $submission->setHandInDate($this->faker->dateTimeBetween('+01 days', '+1 month'));
            $submission->setResubmitted($this->faker->boolean(10)); // 10% chance of being true
            $submission->setGrade($this->gradeCalculator->calculateGrade(
                $submission->getMark(),
                $submission->isResubmitted()
            ));

            $manager->persist($submission);
        }

        $manager->flush();
    }
}
