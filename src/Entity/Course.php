<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Course
 *
 * @ORM\Entity
 * @ORM\Table(name="course", indexes={@Index(name="course_idx", columns={"id"})})
 */
class Course
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
     *      max = 50,
     *      minMessage = "Course name must be at least {{ limit }} characters long",
     *      maxMessage = "Course name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coursework", mappedBy="course")
     */
    private $courseworks;

    public function __construct()
    {
        $this->courseworks = new ArrayCollection();
    }

    /**
     * @return Collection|Coursework[]
     */
    public function getCourseworks(): Collection
    {
        return $this->courseworks;
    }

    public function addCoursework(Coursework $coursework): self
    {
        if (!$this->courseworks->contains($coursework)) {
            $this->courseworks[] = $coursework;
            $coursework->setCourse($this);
        }

        return $this;
    }

    public function removeCoursework(Coursework $coursework): self
    {
        if ($this->courseworks->contains($coursework)) {
            $this->courseworks->removeElement($coursework);
            // set the owning side to null (unless already changed)
            if ($coursework->getCourse() === $this) {
                $coursework->setCourse(null);
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

    public function __toString()
    {
        return $this->name;
    }


}
