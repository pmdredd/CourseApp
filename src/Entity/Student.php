<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $averageMark = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $averageGrade = null;

    #[ORM\OneToMany(mappedBy: 'student', targetEntity: Submission::class)]
    private Collection $submissions;

    public function __construct()
    {
        $this->submissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAverageMark(): ?int
    {
        return $this->averageMark;
    }

    public function setAverageMark(?int $averageMark): self
    {
        $this->averageMark = $averageMark;

        return $this;
    }

    public function getAverageGrade(): ?string
    {
        return $this->averageGrade;
    }

    public function setAverageGrade(string $averageGrade): self
    {
        $this->averageGrade = $averageGrade;

        return $this;
    }

    /**
     * @return Collection<int, Submission>
     */
    public function getSubmissions(): Collection
    {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): self
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions->add($submission);
            $submission->setStudent($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getStudent() === $this) {
                $submission->setStudent(null);
            }
        }

        return $this;
    }
}
