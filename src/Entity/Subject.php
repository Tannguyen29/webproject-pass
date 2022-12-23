<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $Subjectcode = null;

    #[ORM\Column(length: 30)]
    private ?string $Subjectname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectcode(): ?string
    {
        return $this->Subjectcode;
    }

    public function setSubjectcode(string $Subjectcode): self
    {
        $this->Subjectcode = $Subjectcode;

        return $this;
    }

    public function getSubjectname(): ?string
    {
        return $this->Subjectname;
    }

    public function setSubjectname(string $Subjectname): self
    {
        $this->Subjectname = $Subjectname;

        return $this;
    }
}
