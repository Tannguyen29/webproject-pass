<?php

namespace App\Entity;

use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassroomRepository::class)]
class Classroom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $Classcode = null;

    #[ORM\Column(length: 255)]
    private ?string $Classname = null;

    #[ORM\ManyToMany(targetEntity: Subject::class)]
    private Collection $subject;

    public function __construct()
    {
        $this->subject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasscode(): ?string
    {
        return $this->Classcode;
    }

    public function setClasscode(string $Classcode): self
    {
        $this->Classcode = $Classcode;

        return $this;
    }

    public function getClassname(): ?string
    {
        return $this->Classname;
    }

    public function setClassname(string $Classname): self
    {
        $this->Classname = $Classname;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubject(): Collection
    {
        return $this->subject;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subject->contains($subject)) {
            $this->subject->add($subject);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        $this->subject->removeElement($subject);

        return $this;
    }
}
