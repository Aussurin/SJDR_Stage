<?php

namespace App\Entity;

use App\Repository\FicheVampireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'ficheVampire', targetEntity: Attache::class, orphanRemoval: true)]
    private Collection $attaches;

    #[ORM\OneToMany(mappedBy: 'ficheVampire', targetEntity: Possession::class)]
    private Collection $possessions;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clan $clan = null;

    #[ORM\OneToOne(mappedBy: 'ficheVampire', cascade: ['persist', 'remove'])]
    private ?Progression $progression = null;

    #[ORM\ManyToOne(inversedBy: 'fiches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    public function __construct()
    {
        $this->attaches = new ArrayCollection();
        $this->attributsPersonnage = new ArrayCollection();
        $this->possessions = new ArrayCollection();
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

    /**
     * @return Collection<int, Attache>
     */
    public function getAttaches(): Collection
    {
        return $this->attaches;
    }

    public function addAttach(Attache $attach): self
    {
        if (!$this->attaches->contains($attach)) {
            $this->attaches->add($attach);
            $attach->setFicheVampire($this);
        }

        return $this;
    }

    public function removeAttach(Attache $attach): self
    {
        if ($this->attaches->removeElement($attach)) {
            // set the owning side to null (unless already changed)
            if ($attach->getFicheVampire() === $this) {
                $attach->setFicheVampire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Possession>
     */
    public function getPossessions(): Collection
    {
        return $this->possessions;
    }

    public function addPossession(Possession $possession): self
    {
        if (!$this->possessions->contains($possession)) {
            $this->possessions->add($possession);
            $possession->setFicheVampire($this);
        }

        return $this;
    }

    public function removePossession(Possession $possession): self
    {
        if ($this->possessions->removeElement($possession)) {
            // set the owning side to null (unless already changed)
            if ($possession->getFicheVampire() === $this) {
                $possession->setFicheVampire(null);
            }
        }

        return $this;
    }

    public function getClan(): ?Clan
    {
        return $this->clan;
    }

    public function setClan(?Clan $clan): self
    {
        $this->clan = $clan;

        return $this;
    }

    public function getProgression(): ?Progression
    {
        return $this->progression;
    }

    public function setProgression(Progression $progression): self
    {
        // set the owning side of the relation if necessary
        if ($progression->getFicheVampire() !== $this) {
            $progression->setFicheVampire($this);
        }

        $this->progression = $progression;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }


}
