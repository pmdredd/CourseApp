<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Entity
 * @ORM\Table(name="student", indexes={@Index(name="student_idx", columns={"id"})})
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=50, nullable=false)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 75,
     *      minMessage = "Student name must be at least {{ limit }} characters long",
     *      maxMessage = "Student name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Submission", mappedBy="student")
     */
    private $submissions;

    private $averageMark;

    private $averageGrade;


    public function __construct()
    {
        $this->submissions = new ArrayCollection();
    }

    /**
     * @return Collection|Submission[]
     */
    public function getSubmissions(): Collection
    {
        return $this->submissions;
    }

    public function addSubmission(Submission $submission): self
    {
        if (!$this->submissions->contains($submission)) {
            $this->submissions[] = $submission;
            $submission->setStudent($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self
    {
        if ($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
            // set the owning side to null (unless already changed)
            if ($submission->getStudent() === $this) {
                $submission->setStudent(null);
            }
        }

        return $this;
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

    /**
     * @return mixed
     */
    public function getAverageMark()
    {
        return $this->averageMark;
    }

    /**
     * @param mixed $averageMark
     */
    public function setAverageMark($averageMark): void
    {
        $this->averageMark = $averageMark;
    }

    /**
     * @return mixed
     */
    public function getAverageGrade()
    {
        return $this->averageGrade;
    }

    /**
     * @param mixed $averageGrade
     */
    public function setAverageGrade($averageGrade): void
    {
        $this->averageGrade = $averageGrade;
    }

    public function __toString()
    {
        return $this->name;
    }


}
