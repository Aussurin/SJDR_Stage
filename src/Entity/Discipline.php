<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisciplineRepository::class)]
class Discipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Clan::class, inversedBy: 'disciplines')]
    private Collection $clans;

    #[ORM\OneToMany(mappedBy: 'discipline', targetEntity: Pouvoir::class)]
    private Collection $pouvoirs;

    #[ORM\ManyToMany(targetEntity: Predateur::class, mappedBy: 'discipline')]
    private Collection $predateurs;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->clans = new ArrayCollection();
        $this->pouvoirs = new ArrayCollection();
        $this->predateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, Clan>
     */
    public function getClans(): Collection
    {
        return $this->clans;
    }

    public function addClan(Clan $clan): self
    {
        if (!$this->clans->contains($clan)) {
            $this->clans->add($clan);
        }

        return $this;
    }

    public function removeClan(Clan $clan): self
    {
        $this->clans->removeElement($clan);

        return $this;
    }

    /**
     * @return Collection<int, Pouvoir>
     */
    public function getPouvoirs(): Collection
    {
        return $this->pouvoirs;
    }

    public function addPouvoir(Pouvoir $pouvoir): self
    {
        if (!$this->pouvoirs->contains($pouvoir)) {
            $this->pouvoirs->add($pouvoir);
            $pouvoir->setDiscipline($this);
        }

        return $this;
    }

    public function removePouvoir(Pouvoir $pouvoir): self
    {
        if ($this->pouvoirs->removeElement($pouvoir)) {
            // set the owning side to null (unless already changed)
            if ($pouvoir->getDiscipline() === $this) {
                $pouvoir->setDiscipline(null);
            }
        }

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
            $predateur->addDiscipline($this);
        }

        return $this;
    }

    public function removePredateur(Predateur $predateur): self
    {
        if ($this->predateurs->removeElement($predateur)) {
            $predateur->removeDiscipline($this);
        }

        return $this;
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
}
