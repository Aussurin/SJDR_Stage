<?php

namespace App\Controller;

use App\Class\AffichageVampire;
use App\Entity\AttributPersonnage;
use App\Entity\AvantageInconvenient;
use App\Entity\Discipline;
use App\Entity\FicheVampire;
use App\Entity\PointCreation;
use App\Entity\Pouvoir;
use App\Entity\PouvoirPerso;
use App\Entity\Progression;
use App\Entity\SkillPersonnage;
use App\Form\FicheVampireType;
use App\Repository\AttributRepository;
use App\Repository\FicheVampireRepository;
use App\Repository\PouvoirPersoRepository;
use App\Repository\PredateurRepository;
use App\Repository\SkillRepository;
use App\Service\ModifierFicheFormBuilder;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheVampireController extends AbstractController
{
    public function __construct(private readonly RecuperateurContexte $recuperateurContexte)
    {
    }

    #[Route('/fiche/vampire/creer', name: 'app_fiche_vampire_creer')]
    public function creer(Request $request, EntityManagerInterface $entityManager,AttributRepository $attributRepository,  SkillRepository $skillRepository,  PredateurRepository $predateurRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $fiche = new FicheVampire();

        $ficheform = $this->createForm(FicheVampireType::class,$fiche);
        $ficheform->handleRequest($request);

        if ($ficheform->isSubmitted() && $ficheform->isValid()){

            $progression = $this->initialisationVampire($attributRepository,$skillRepository,$predateurRepository,$entityManager);
            $fiche->setProgression($progression);
            $fiche->setMembre($this->getUser());

            $entityManager->persist($fiche);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Fiche créé.',
            );
            return $this->redirectToRoute('app_fiche_vampire_modifier_id', array('id'=>$fiche->getId()));
        }


        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('fiche_vampire/creer.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'ficheform'=> $ficheform->createView()
        ]);
    }
    public function initialisationVampire(AttributRepository $attributRepository,  SkillRepository $skillRepository,  PredateurRepository $predateurRepository, EntityManagerInterface $entityManager) : Progression {
        $progression = new Progression();
        $attributs = $attributRepository->findAll();
        $skills = $skillRepository->findAll();
        $predateur = $predateurRepository->findOneBy(['nom'=>'Consensualiste']);

        foreach ($attributs as $attribut){
            $attrperso = new AttributPersonnage();
            $attrperso->setAttribut($attribut);
            $attrperso->setNiveau(1);
            $attrperso->setProgression($progression);

            $entityManager->persist($attrperso);
            $progression->addAttribut($attrperso);
        }
        foreach ($skills as $skill){
            $skillperso = new SkillPersonnage();
            $skillperso->setSkill($skill);
            $skillperso->setNiveau(0);
            $skillperso->setProgression($progression);

            $entityManager->persist($skillperso);

            $progression->addSkill($skillperso);
        }
        $pouvoirPerso = new PouvoirPerso();
        $pouvoirPerso->setProgression($progression);
        $progression->setPouvoirPerso($pouvoirPerso);
        $progression->setPredateur($predateur);

        $entityManager->persist($progression);

        return $progression;
    }

    #[Route('/fiche/vampire/modifier/{id}', name: 'app_fiche_vampire_modifier_id')]
    public function progression(Request $request, $id, ModifierFicheFormBuilder $formBuilder, EntityManagerInterface $entityManager, FicheVampireRepository $ficheVampireRepository, PouvoirPersoRepository $pouvoirPersoRepository): Response{
        $vampire = 0;
        $membre = $this->getUser();
        $fiches = $membre->getFiches();

        foreach ($fiches as $fiche){
            if ($fiche->getId()==$id){
                $vampire = $ficheVampireRepository->trouverUneFicheId($id)[0];
                break;
            }
        }

        if($vampire === 0){
            $this->addFlash(
                'alert',
                'Cette fiche ne vous appartient pas.',
            );
            return $this->redirectToRoute('app_profil');
        }
       /* foreach ($vampire->getProgression()->getPouvoirPerso()->getDiscipline() as $discipline){
            $i = $discipline;
        }

        foreach ($vampire->getProgression()->getPouvoirPerso()->getPouvoirs() as $pouvoir){
            $i = $pouvoir;
        }*/


        $builder = $this->createFormBuilder($vampire);
        $ficheType = $formBuilder->buildVampireForm($vampire, $builder);
        $ficheForm = $ficheType->getForm();

        $ficheForm->handleRequest($request);
        if($ficheForm->isSubmitted() && $ficheForm->isValid()){

            $this->hydratVampire($vampire->getProgression(), $ficheForm, $entityManager);

            $this->addFlash(
                'success',
                'Fiche modifiée.',
            );
            return $this->redirectToRoute('app_fiche_vampire_modifier_id', ['id'=>$id]);
        }
        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('fiche_vampire/modifier.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'fiche'=> $vampire,
            'ficheForm'=>$ficheForm->createView()
        ]);
    }
    #[Route('/fiche/vampire/supprimer/{id}', name: 'app_fiche_vampire_suppression_id')]
    public function suppression(Request $request, FicheVampireRepository $ficheVampireRepository, $id, EntityManagerInterface $entityManager): Response{
        $fiche = $ficheVampireRepository->findOneBy(['id'=>$id]);
        $entityManager->remove($fiche);
        $entityManager->flush();
        $this->addFlash(
            'success',
            'Fiche supprimée',
        );
        return $this->redirectToRoute('app_profil');
    }
    public function hydratVampire(Progression $progression, $ficheForm, EntityManagerInterface $entityManager){

        foreach ($progression->getAttributs() as $attribut){
            $nomAttribut = str_replace(array('-'),'_',str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$attribut->getAttribut()->getNom()))));
            $niveau = $ficheForm->get($nomAttribut)->getData();
            $attribut->setNiveau($niveau);
            }

        foreach ($progression->getSkills() as $skill){
            $nomSkill = str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$skill->getSkill()->getNom())));
            $niveau = $ficheForm->get($nomSkill)->getData();
            $skill->setNiveau($niveau);
        }
        $pouvoirPerso = $progression->getPouvoirPerso();
        $pouvoirPerso->resetDiscPouv();

        for ($i=1; $i<7 ;$i++){
            $discipline = $ficheForm->get('discipline'.$i)->getData();
            if ($discipline instanceof Discipline){
                $pouvoirPerso->addDiscipline($discipline);
            }
            for($j=1;$j<6;$j++){
                $pouvoir = $ficheForm->get('pouvoir'.$i.$j)->getData();

                if($pouvoir instanceof Pouvoir){
                   $pouvoirPerso->addPouvoir($pouvoir);
                }
            }
        }
        $entityManager->persist($pouvoirPerso);
        $progression->setPouvoirPerso($pouvoirPerso);

        $progression->resetptsCra();

        for ($i = 1;$i<10;$i++){
            $avantage = $ficheForm->get('historique'.$i)->getData();
            $niveau = $ficheForm->get('historique'.$i.'pts')->getData();
            if ($avantage instanceof AvantageInconvenient && $niveau !== null){
                $ptcrea = new PointCreation();
                $ptcrea->setAvantageInconvenient($avantage);
                $ptcrea->setNiveau($niveau);
                $ptcrea->setProgression($progression);
                $entityManager->persist($ptcrea);
                $progression->addPointsCreation($ptcrea);

            }
        }
        $progression->setPredateur($ficheForm->get('predateur')->getData());
        $entityManager->persist($progression);
        $entityManager->flush();
    }

    #[Route('/fiche/affichage/{id}', name: 'app_fiche_affichage_id')]
    public function affichageFiche(FicheVampireRepository $ficheVampireRepository, AttributRepository $attributRepository,  SkillRepository $skillRepository,  PredateurRepository $predateurRepository, EntityManagerInterface $entityManager, $id, Request $request): Response{

        $fiche = $ficheVampireRepository->findOneBy(['id'=>$id]);
        $affiche = new AffichageVampire();

        if (!is_null($fiche)){
            $affiche->convertir($fiche);
            $fiche = $affiche;
        }else{
            $fiche = new FicheVampire();
            $fiche = $this->fichevierge($fiche);
            $fiche->setProgression($this->initialisationVampire($attributRepository,$skillRepository,$predateurRepository,$entityManager));
            $affiche->convertir($fiche);
            $fiche = $affiche;

        }

        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('fiche/affichage.html.twig',[
            'controller_name' => 'MembreController',
            'contexte' => $contexte,
            'fiche'=>$fiche,
        ]);

    }

    protected function fichevierge(FicheVampire $fiche): FicheVampire{
        $fiche->setNom('Nom');
        $fiche->setConcept('Concept');
        $fiche->setAmbition('Ambition');
        $fiche->setHumanite(8);
        $fiche->setDesire('Désir');
        $fiche->setExperience(0);
        $fiche->setGeneration(15);
        return $fiche;
    }

}
