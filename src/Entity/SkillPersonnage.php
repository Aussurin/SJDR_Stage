<?php

namespace App\Entity;

use App\Repository\SkillPersonnageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkillPersonnageRepository::class)]
class SkillPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $niveau = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Skill $skill = null;

    #[ORM\ManyToOne(inversedBy: 'skills')]
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

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

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
