<?php

namespace App\Entity;

use App\Repository\AvantageInconvenientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvantageInconvenientRepository::class)]
class AvantageInconvenient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Predateur::class, mappedBy: 'avantageInconvenient')]
    private Collection $predateurs;

    #[ORM\Column]
    private ?int $type = null;

    public function __construct()
    {
        $this->predateurs = new ArrayCollection();
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


    /**
     * @return Collection<int, Predateur>
     */
    public function getPredateurs(): Collection
    {
        return $this->predateurs;
    }

    public function addPredateur(Predateur $predateur): self
    {
        if (!$this->predateurs->contains($predateur)) {
            $this->predateurs->add($predateur);
            $predateur->addAvantageInconvenient($this);
        }

        return $this;
    }

    public function removePredateur(Predateur $predateur): self
    {
        if ($this->predateurs->removeElement($predateur)) {
            $predateur->removeAvantageInconvenient($this);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
