<?php

namespace App\Class;

use App\Entity\FicheVampire;

class AffichageVampire
{
    private array $descriptions=[];
    private array $attributs=[];
    private array $skills=[];
    private array $discs=[];
    private array $avantages=[];
    private int $humanite;




    public function convertir(FicheVampire $fiche) : self{
        $this->addDescription(['nom'=>$fiche->getNom()]);

        $predateur = $fiche->getProgression()->getPredateur();
        if (!is_null($predateur)){
            $this->addDescription(['predateur'=>$predateur->getNom()]);
            $this->addDescription(['predateurAide'=>$predateur->getDescription()]);
        }else{
            $this->addDescription(['predateur'=>'Predateur']);
            $this->addDescription(['predateurAide'=>'Bulle d\'aide du predateur']);
        }


        $this->addDescription(['desir'=>$fiche->getDesire()]);
        $this->addDescription(['ambition'=>$fiche->getAmbition()]);

        $clan = $fiche->getClan();
        if (!is_null($clan)){
            $this->addDescription(['clan'=>$clan->getNom()]);
            $this->addDescription(['clanFaiblesse'=>$clan->getFaiblesse()]);
        }else{
            $this->addDescription(['clan'=>'Clan']);
            $this->addDescription(['clanFaiblesse'=>'Faiblesse de clan']);
        }


        $this->addDescription(['generation'=>$fiche->getGeneration()]);

        foreach ($fiche->getProgression()->getAttributs() as $attribut){
            $this->addAttributs([(str_replace(array(' ','-'), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$attribut->getAttribut()->getNom()))))=>$attribut->getNiveau()]);
        }

        foreach ($fiche->getProgression()->getSkills() as $skill){
            $this->addSkills([(str_replace(array(' ','-'), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$skill->getSkill()->getNom()))))=>$skill->getNiveau()]);
        }

        foreach ($fiche->getProgression()->getPointsCreation() as $point){
            $this->addAvantages([$point->getAvantageInconvenient()->getNom()=>$point->getNiveau()]);
        }

        foreach ($fiche->getProgression()->getPouvoirPerso()->getDiscipline() as $discipline){
            $pouvoirs = [];
            foreach ($fiche->getProgression()->getPouvoirPerso()->getPouvoirs() as $p){
                if ($p->getDiscipline()->getNom() == $discipline->getNom()){
                    $pouvoirs = [$p->getNom()=>$p->getDescription()];
                }
            }
            $this->addDiscs([$discipline->getNom()=>$pouvoirs]);
        }

        $this->setHumanite($fiche->getHumanite());

        return $this;

    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->descriptions;
    }

    /**
     * @param array $description
     */
    public function addDescription(array $description): void
    {
        $new = array_merge($this->descriptions,$description);
        $this->descriptions=$new;
    }


    /**
     * @return array
     */
    public function getAttributs(): array
    {
        return $this->attributs;
    }

    /**
     * @param array $attributs
     */
    public function addAttributs(array $attributs): void
    {
        $new = array_merge($this->attributs,$attributs);
        $this->attributs = $new;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @param array $skills
     */
    public function addSkills(array $skills): void
    {
        $new = array_merge($this->skills, $skills);
        $this->skills = $new;
    }

    /**
     * @return array
     */
    public function getDiscs(): array
    {
        return $this->discs;
    }

    /**
     * @param array $discs
     */
    public function addDiscs(array $discs): void
    {
        $new = array_merge($this->discs, $discs);
        $this->discs = $new;
    }

    /**
     * @return array
     */
    public function getAvantages(): array
    {
        return $this->avantages;
    }

    /**
     * @param array $avantages
     */
    public function addAvantages(array $avantages): void
    {
        $new = array_merge($this->avantages, $avantages);
        $this->avantages = $new;
    }


    /**
     * @return int
     */
    public function getHumanite(): int
    {
        return $this->humanite;
    }

    /**
     * @param int $humanite
     */
    public function setHumanite(int $humanite): void
    {
        $this->humanite = $humanite;
    }

    /**
     * @return int
     */
    public function getSang(): int
    {
        return $this->sang;
    }

    /**
     * @param int $sang
     */
    public function setSang(int $sang): void
    {
        $this->sang = $sang;
    }
    /**
     * @return int
     */
    public function getNbavantage(): int
    {
        return $this->nbavantage;
    }

    /**
     * @param int $nbavantage
     */
    public function setNbavantage(int $nbavantage): void
    {
        $this->nbavantage = $nbavantage;
    }


}