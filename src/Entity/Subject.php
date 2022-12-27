<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column]
    private ?float $SunjectFee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $SubjectStartDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $SubjectEndDate = null;

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

    public function getSunjectFee(): ?float
    {
        return $this->SunjectFee;
    }

    public function setSunjectFee(float $SunjectFee): self
    {
        $this->SunjectFee = $SunjectFee;

        return $this;
    }

    public function getSubjectStartDate(): ?\DateTimeInterface
    {
        return $this->SubjectStartDate;
    }

    public function setSubjectStartDate(\DateTimeInterface $SubjectStartDate): self
    {
        $this->SubjectStartDate = $SubjectStartDate;

        return $this;
    }

    public function getSubjectEndDate(): ?\DateTimeInterface
    {
        return $this->SubjectEndDate;
    }

    public function setSubjectEndDate(\DateTimeInterface $SubjectEndDate): self
    {
        $this->SubjectEndDate = $SubjectEndDate;

        return $this;
    }
    public function _toString(): string{
        return $this->getDateTime();
    }
}
