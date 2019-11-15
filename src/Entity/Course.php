<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Course
 *
 * @ORM\Entity
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
