<?php

namespace App\Entity;

use App\Repository\CourseWorkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseWorkRepository::class)]
class CourseWork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deadline = null;

    #[ORM\Column]
    private ?int $creditWeight = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $feedbackDueDate = null;

    #[ORM\ManyToOne(inversedBy: 'courseWorks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $course = null;

    #[ORM\OneToMany(mappedBy: 'coursework', targetEntity: Submission::class)]
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

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getCreditWeight(): ?int
    {
        return $this->creditWeight;
    }

    public function setCreditWeight(int $creditWeight): self
    {
        $this->creditWeight = $creditWeight;

        return $this;
    }

    public function getFeedbackDueDate(): ?\DateTimeInterface
    {
        return $this->feedbackDueDate;
    }

    public function setFeedbackDueDate(?\DateTimeInterface $feedbackDueDate): self
    {
        $this->feedbackDueDate = $feedbackDueDate;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

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
            $submission->setCoursework($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self
    {
        if ($this->submissions->removeElement($submission)) {
            // set the owning side to null (unless already changed)
            if ($submission->getCoursework() === $this) {
                $submission->setCoursework(null);
            }
        }

        return $this;
    }
}
