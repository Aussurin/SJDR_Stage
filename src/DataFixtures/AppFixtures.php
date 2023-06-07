<?php

namespace App\DataFixtures;

use App\Entity\Attribut;
use App\Entity\AvantageInconvenient;
use App\Entity\Clan;
use App\Entity\Discipline;
use App\Entity\Pouvoir;
use App\Entity\Predateur;
use App\Entity\Skill;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $manager->flush();
    }
}
