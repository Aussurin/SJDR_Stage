<?php

namespace App\Entity;

use App\Repository\ProgressionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressionRepository::class)]
class Progression
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'progression', targetEntity: AttributPersonnage::class, orphanRemoval: true)]
    private Collection $attributs;

    #[ORM\OneToMany(mappedBy: 'progression', targetEntity: SkillPersonnage::class, orphanRemoval: true)]
    private Collection $skills;

    #[ORM\OneToMany(mappedBy: 'progression', targetEntity: PointCreation::class, orphanRemoval: true)]
    private Collection $pointsCreation;


    #[ORM\ManyToOne]
    private ?Predateur $predateur = null;

    #[ORM\OneToOne(inversedBy: 'progression', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?FicheVampire $ficheVampire = null;

    #[ORM\OneToOne(mappedBy: 'progression', cascade: ['persist', 'remove'])]
    private ?PouvoirPerso $pouvoirPerso = null;

    public function __construct()
    {
        $this->attributs = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->pointsCreation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, AttributPersonnage>
     */
    public function getAttributs(): Collection
    {
        return $this->attributs;
    }

    public function addAttribut(AttributPersonnage $attribut): self
    {
        if (!$this->attributs->contains($attribut)) {
            $this->attributs->add($attribut);
            $attribut->setProgression($this);
        }

        return $this;
    }

    public function removeAttribut(AttributPersonnage $attribut): self
    {
        if ($this->attributs->removeElement($attribut)) {
            // set the owning side to null (unless already changed)
            if ($attribut->getProgression() === $this) {
                $attribut->setProgression(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SkillPersonnage>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(SkillPersonnage $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setProgression($this);
        }

        return $this;
    }

    public function removeSkill(SkillPersonnage $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getProgression() === $this) {
                $skill->setProgression(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PointCreation>
     */
    public function getPointsCreation(): Collection
    {
        return $this->pointsCreation;
    }

    public function addPointsCreation(PointCreation $pointsCreation): self
    {
        if (!$this->pointsCreation->contains($pointsCreation)) {
            $this->pointsCreation->add($pointsCreation);
            $pointsCreation->setProgression($this);
        }

        return $this;
    }

    public function removePointsCreation(PointCreation $pointsCreation): self
    {
        if ($this->pointsCreation->removeElement($pointsCreation)) {
            // set the owning side to null (unless already changed)
            if ($pointsCreation->getProgression() === $this) {
                $pointsCreation->setProgression(null);
            }
        }

        return $this;
    }


    public function getPredateur(): ?Predateur
    {
        return $this->predateur;
    }

    public function setPredateur(?Predateur $predateur): self
    {
        $this->predateur = $predateur;

        return $this;
    }

    public function getFicheVampire(): ?FicheVampire
    {
        return $this->ficheVampire;
    }

    public function setFicheVampire(FicheVampire $ficheVampire): self
    {
        $this->ficheVampire = $ficheVampire;

        return $this;
    }

    public function getPouvoirPerso(): ?PouvoirPerso
    {
        return $this->pouvoirPerso;
    }

    public function setPouvoirPerso(PouvoirPerso $pouvoirPerso): self
    {
        // set the owning side of the relation if necessary
        if ($pouvoirPerso->getProgression() !== $this) {
            $pouvoirPerso->setProgression($this);
        }

        $this->pouvoirPerso = $pouvoirPerso;

        return $this;
    }
}
