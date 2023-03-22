<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: CourseWork::class)]
    private Collection $courseWorks;

    public function __construct()
    {
        $this->courseWorks = new ArrayCollection();
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
     * @return Collection<int, CourseWork>
     */
    public function getCourseWorks(): Collection
    {
        return $this->courseWorks;
    }

    public function addCourseWork(CourseWork $courseWork): self
    {
        if (!$this->courseWorks->contains($courseWork)) {
            $this->courseWorks->add($courseWork);
            $courseWork->setCourse($this);
        }

        return $this;
    }

    public function removeCourseWork(CourseWork $courseWork): self
    {
        if ($this->courseWorks->removeElement($courseWork)) {
            // set the owning side to null (unless already changed)
            if ($courseWork->getCourse() === $this) {
                $courseWork->setCourse(null);
            }
        }

        return $this;
    }
}
