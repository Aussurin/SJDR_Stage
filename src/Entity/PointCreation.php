<?php

namespace App\Entity;

use App\Repository\PointCreationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointCreationRepository::class)]
class PointCreation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $niveau = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AvantageInconvenient $avantageInconvenient = null;

    #[ORM\ManyToOne(inversedBy: 'pointsCreation')]
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

    public function getAvantageInconvenient(): ?AvantageInconvenient
    {
        return $this->avantageInconvenient;
    }

    public function setAvantageInconvenient(?AvantageInconvenient $avantageInconvenient): self
    {
        $this->avantageInconvenient = $avantageInconvenient;

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
