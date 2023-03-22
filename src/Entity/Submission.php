<?php

namespace App\Entity;

use App\Repository\SubmissionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubmissionRepository::class)]
class Submission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $mark = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $handInDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $resubmitted = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $grade = null;

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CourseWork $coursework = null;

    #[ORM\ManyToOne(inversedBy: 'submissions')]
    private ?Student $student = null;

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

    public function getHandInDate(): ?\DateTimeInterface
    {
        return $this->handInDate;
    }

    public function setHandInDate(\DateTimeInterface $handInDate): self
    {
        $this->handInDate = $handInDate;

        return $this;
    }

    public function isResubmitted(): ?bool
    {
        return $this->resubmitted;
    }

    public function setResubmitted(?bool $resubmitted): self
    {
        $this->resubmitted = $resubmitted;

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

    public function getCourseWork(): ?CourseWork
    {
        return $this->coursework;
    }

    public function setCourseWork(?CourseWork $coursework): self
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
}
