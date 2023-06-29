<?php

namespace App\Entity;

use App\Repository\CampagneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampagneRepository::class)]
class Campagne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Membre::class, inversedBy: 'campagnes')]
    private Collection $joueurs;

    #[ORM\ManyToOne(inversedBy: 'campagnesMJ')]
    private ?Membre $maitreDeJeu = null;

    #[ORM\Column(length: 10)]
    private ?string $random = null;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Membre $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
        }

        return $this;
    }

    public function removeJoueur(Membre $joueur): self
    {
        $this->joueurs->removeElement($joueur);

        return $this;
    }

    public function getMaitreDeJeu(): ?Membre
    {
        return $this->maitreDeJeu;
    }

    public function setMaitreDeJeu(?Membre $maitreDeJeu): self
    {
        $this->maitreDeJeu = $maitreDeJeu;

        return $this;
    }

    public function getRandom(): ?string
    {
        return $this->random;
    }

    public function setRandom(string $random): self
    {
        $this->random = $random;

        return $this;
    }
}
