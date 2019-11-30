<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Submission
 * @ORM\Entity(repositoryClass="App\Repository\SubmissionRepository")
 */
class Submission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mark", type="integer", nullable=true)

     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      notInRangeMessage = "Mark must between {{ min }} and {{ max }} inclusive",
     * )
     */
    private $mark;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="hand_in_date", type="date", nullable=false)
     *
     * @Assert\NotBlank
     * @Assert\Date
     */
    private $handInDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="second_submission", type="boolean", nullable=false)*
     */
    private $secondSubmission = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="grade", type="text", length=3, nullable=true)
     */
    private $grade;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coursework", inversedBy="submissions")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotBlank
     */
    private $coursework;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="submissions")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotBlank
     */
    private $student;

    public function getCoursework(): ?Coursework
    {
        return $this->coursework;
    }

    public function setCoursework(?Coursework $coursework): self
    {
        $this->coursework = $coursework;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(?int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getHandInDate(): ?DateTimeInterface
    {
        return $this->handInDate;
    }

    public function setHandInDate(DateTimeInterface $handInDate): self
    {
        $this->handInDate = $handInDate;

        return $this;
    }

    public function getSecondSubmission(): ?bool
    {
        return $this->secondSubmission;
    }

    public function setSecondSubmission(bool $secondSubmission): self
    {
        $this->secondSubmission = $secondSubmission;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }


}
