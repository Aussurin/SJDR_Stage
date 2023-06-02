<?php

namespace App\Entity;

use App\Repository\FicheVampireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheVampireRepository::class)]
class FicheVampire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $concept = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $experience = null;

    #[ORM\Column(length: 50)]
    private ?string $ambition = null;

    #[ORM\Column(length: 50)]
    private ?string $desire = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $generation = null;

    #[ORM\Column(length: 50)]
    private ?string $sire = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $humanite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getConcept(): ?string
    {
        return $this->concept;
    }

    public function setConcept(?string $concept): self
    {
        $this->concept = $concept;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getAmbition(): ?string
    {
        return $this->ambition;
    }

    public function setAmbition(string $ambition): self
    {
        $this->ambition = $ambition;

        return $this;
    }

    public function getDesire(): ?string
    {
        return $this->desire;
    }

    public function setDesire(string $desire): self
    {
        $this->desire = $desire;

        return $this;
    }

    public function getGeneration(): ?int
    {
        return $this->generation;
    }

    public function setGeneration(?int $generation): self
    {
        $this->generation = $generation;

        return $this;
    }

    public function getSire(): ?string
    {
        return $this->sire;
    }

    public function setSire(string $sire): self
    {
        $this->sire = $sire;

        return $this;
    }

    public function getHumanite(): ?int
    {
        return $this->humanite;
    }

    public function setHumanite(int $humanite): self
    {
        $this->humanite = $humanite;

        return $this;
    }
}
