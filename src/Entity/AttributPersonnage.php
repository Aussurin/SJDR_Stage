<?php

namespace App\Entity;

use App\Repository\AttributPersonnageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributPersonnageRepository::class)]
class AttributPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $niveau = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Attribut $attribut = null;

    #[ORM\ManyToOne(inversedBy: 'attributs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Progression $progression = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getAttribut(): ?Attribut
    {
        return $this->attribut;
    }

    public function setAttribut(?Attribut $attribut): self
    {
        $this->attribut = $attribut;

        return $this;
    }

    public function getProgression(): ?Progression
    {
        return $this->progression;
    }

    public function setProgression(?Progression $progression): self
    {
        $this->progression = $progression;

        return $this;
    }
}
