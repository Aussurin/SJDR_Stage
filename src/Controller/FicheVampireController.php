<?php

namespace App\Controller;

use App\Entity\AttributPersonnage;
use App\Entity\FicheVampire;
use App\Entity\Progression;
use App\Entity\SkillPersonnage;
use App\Form\FicheVampireType;
use App\Repository\AttributRepository;
use App\Repository\PredateurRepository;
use App\Repository\SkillRepository;
use App\Service\InitialisateurProgression;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheVampireController extends AbstractController
{
    public function __construct(private RecuperateurContexte $recuperateurContexte)
    {
    }

    #[Route('/fiche/vampire/creer', name: 'app_fiche_vampire_creer')]
    public function creer(Request $request, EntityManagerInterface $entityManager,AttributRepository $attributRepository,  SkillRepository $skillRepository,  PredateurRepository $predateurRepository): Response
    {
        $fiche = new FicheVampire();

        $ficheform = $this->createForm(FicheVampireType::class,$fiche);
        $ficheform->handleRequest($request);


        if ($ficheform->isSubmitted() && $ficheform->isValid()){

            $progression = $this->initialisationVampire($attributRepository,$skillRepository,$predateurRepository,$entityManager);
            $fiche->setProgression($progression);

            $entityManager->persist($fiche);
            $entityManager->flush();
            return $this->redirectToRoute('app_fiche_vampire_progression_id', array('id'=>$progression->getId()));
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
        $progression->setPredateur($predateur);

        $entityManager->persist($progression);


        return $progression;
    }

    #[Route('/fiche/vampire/progression/{id}', name: 'app_fiche_vampire_progression_id')]
    public function progression(Request $request): Response
    {



        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('fiche_vampire/progression.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
        ]);
    }
}
