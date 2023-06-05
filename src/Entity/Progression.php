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

    #[ORM\ManyToMany(targetEntity: Pouvoir::class)]
    private Collection $pouvoirs;

    #[ORM\ManyToOne]
    private ?Predateur $predateur = null;

    public function __construct()
    {
        $this->attributs = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->pointsCreation = new ArrayCollection();
        $this->pouvoirs = new ArrayCollection();
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

    public function getPredateur(): ?Predateur
    {
        return $this->predateur;
    }

    public function setPredateur(?Predateur $predateur): self
    {
        $this->predateur = $predateur;

        return $this;
    }
}
