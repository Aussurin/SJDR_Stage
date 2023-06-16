<?php

namespace App\Entity;

use App\Repository\PouvoirPersoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PouvoirPersoRepository::class)]
class PouvoirPerso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'pouvoirPerso', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Progression $progression = null;

    #[ORM\ManyToMany(targetEntity: Discipline::class)]
    private Collection $Discipline;

    #[ORM\ManyToMany(targetEntity: Pouvoir::class)]
    private Collection $pouvoirs;

    public function __construct()
    {
        $this->Discipline = new ArrayCollection();
        $this->pouvoirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgression(): ?Progression
    {
        return $this->progression;
    }

    public function setProgression(Progression $progression): self
    {
        $this->progression = $progression;

        return $this;
    }

    /**
     * @return Collection<int, Discipline>
     */
    public function getDiscipline(): Collection
    {
        return $this->Discipline;
    }

    public function addDiscipline(Discipline $discipline): self
    {
        if (!$this->Discipline->contains($discipline)) {
            $this->Discipline->add($discipline);
        }

        return $this;
    }

    public function removeDiscipline(Discipline $discipline): self
    {
        $this->Discipline->removeElement($discipline);

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
        }

        return $this;
    }

    public function removePouvoir(Pouvoir $pouvoir): self
    {
        $this->pouvoirs->removeElement($pouvoir);

        return $this;
    }
}
