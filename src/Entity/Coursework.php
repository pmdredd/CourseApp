<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Coursework
 *
 * @ORM\Entity
 */
class Coursework
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
     *      min = 5,
     *      max = 75,
     *      minMessage = "Coursework name must be at least {{ limit }} characters long",
     *      maxMessage = "Coursework name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="deadline", type="string", nullable=false)
     *
     * @Assert\NotBlank
     */
    private $deadline;

    /**
     * @var int
     *
     * @ORM\Column(name="credit_weight", type="integer", nullable=false)
     *
     * @Assert\NotBlank
     * @Assert\Positive(
     *     message="The credit weight must be a greater than 0"
     * )
     */
    private $creditWeight;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="feedback_due_date", type="string", nullable=false)
     *
     * @Assert\NotBlank
     */
    private $feedbackDueDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Course", inversedBy="courseworks")
     *
     * @Assert\NotBlank
     */
    private $course;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Submission", mappedBy="coursework")
     */
    private $submissions;

    public function __construct()
    {
        $this->submissions = new ArrayCollection();
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
            $submission->setCoursework($this);
        }

        return $this;
    }

    public function removeSubmission(Submission $submission): self
    {
        if ($this->submissions->contains($submission)) {
            $this->submissions->removeElement($submission);
            // set the owning side to null (unless already changed)
            if ($submission->getCoursework() === $this) {
                $submission->setCoursework(null);
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

    public function getDeadline(): ?string
    {
        return $this->deadline;
    }

    public function setDeadline(string $deadline): self
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

    public function getFeedbackDueDate(): ?string
    {
        return $this->feedbackDueDate;
    }

    public function setFeedbackDueDate(string $feedbackDueDate): self
    {
        $this->feedbackDueDate = $feedbackDueDate;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }


}
