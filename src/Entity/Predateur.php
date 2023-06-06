<?php

namespace App\Entity;

use App\Repository\PredateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PredateurRepository::class)]
class Predateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $effet_divers = null;

    #[ORM\ManyToMany(targetEntity: Discipline::class, inversedBy: 'predateurs')]
    private Collection $discipline;

    #[ORM\ManyToMany(targetEntity: AvantageInconvenient::class, inversedBy: 'predateurs')]
    private Collection $avantageInconvenient;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specialisation = null;

    public function __construct()
    {
        $this->discipline = new ArrayCollection();
        $this->avantageInconvenient = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEffetDivers(): ?string
    {
        return $this->effet_divers;
    }

    public function setEffetDivers(?string $effet_divers): self
    {
        $this->effet_divers = $effet_divers;

        return $this;
    }

    /**
     * @return Collection<int, Discipline>
     */
    public function getDiscipline(): Collection
    {
        return $this->discipline;
    }

    public function addDiscipline(Discipline $discipline): self
    {
        if (!$this->discipline->contains($discipline)) {
            $this->discipline->add($discipline);
        }

        return $this;
    }

    public function removeDiscipline(Discipline $discipline): self
    {
        $this->discipline->removeElement($discipline);

        return $this;
    }

    /**
     * @return Collection<int, AvantageInconvenient>
     */
    public function getAvantageInconvenient(): Collection
    {
        return $this->avantageInconvenient;
    }

    public function addAvantageInconvenient(AvantageInconvenient $avantageInconvenient): self
    {
        if (!$this->avantageInconvenient->contains($avantageInconvenient)) {
            $this->avantageInconvenient->add($avantageInconvenient);
        }

        return $this;
    }

    public function removeAvantageInconvenient(AvantageInconvenient $avantageInconvenient): self
    {
        $this->avantageInconvenient->removeElement($avantageInconvenient);

        return $this;
    }

    public function getSpecialisation(): ?string
    {
        return $this->specialisation;
    }

    public function setSpecialisation(?string $specialisation): self
    {
        $this->specialisation = $specialisation;

        return $this;
    }
}
