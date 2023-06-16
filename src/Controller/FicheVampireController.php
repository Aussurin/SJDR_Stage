<?php

namespace App\Controller;

use App\Entity\AttributPersonnage;
use App\Entity\FicheVampire;
use App\Entity\Membre;
use App\Entity\Progression;
use App\Entity\SkillPersonnage;
use App\Form\FicheVampireType;
use App\Form\ProgressionType;
use App\Repository\AttributRepository;
use App\Repository\FicheVampireRepository;
use App\Repository\PredateurRepository;
use App\Repository\SkillRepository;
use App\Service\InitialisateurProgression;
use App\Service\ModifierFicheFormBuilder;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isNull;
use function Sodium\add;

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
            $fiche->setMembre($this->getUser());

            $entityManager->persist($fiche);
            $entityManager->flush();
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
        $progression->setPredateur($predateur);

        $entityManager->persist($progression);


        return $progression;
    }

    #[Route('/fiche/vampire/modifier/{id}', name: 'app_fiche_vampire_modifier_id')]
    public function progression(Request $request, $id, ModifierFicheFormBuilder $formBuilder, EntityManagerInterface $entityManager): Response{
        $vampire = 0;
        $membre = $this->getUser();
        assert($membre instanceof Membre);
        $fiches = $membre->getFiches();
        foreach ($fiches as $fiche){
            if ($fiche->getId()==$id){
                $vampire = $fiche;
                break;
            }
        }
        if($vampire === 0){
            return $this->redirectToRoute('app_profil');
        }
        $builder = $this->createFormBuilder($vampire);
        $ficheType = $formBuilder->buildVampireForm($fiche, $builder);
        $ficheForm = $ficheType->getForm();

        $ficheForm->handleRequest($request);
        if($ficheForm->isSubmitted() && $ficheForm->isValid()){
            dd($ficheForm);

            $progression = $this->hydratVampire($vampire->getProgression(), $ficheForm);

            $entityManager->persist($progression);
            $entityManager->flush();
            return $this->redirectToRoute('app_fiche_vampire_modifier_id', ['id'=>$id]);
        }
        dump($fiche->getProgression()->getPredateur());
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

        return $this->redirectToRoute('app_profil');
    }
    public function hydratVampire(Progression $progression, $ficheForm) : Progression  {
        $array = array();

        foreach ($progression->getAttributs() as $attribut){
            $nomAttribut = str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$attribut->getAttribut()->getNom())));
            $niveau = $ficheForm->get($nomAttribut)->getData();
            $attribut->setNiveau($niveau);
            }

        foreach ($progression->getSkills() as $skill){
            $nomSkill = str_replace(array(' '), '_',str_replace(array('à','â'), 'a',str_replace(array('é','è','ê'), 'e',$skill->getSkill()->getNom())));
            $niveau = $ficheForm->get($nomSkill)->getData();
            $skill->setNiveau($niveau);
        }
        $progression->setPredateur($ficheForm->get('predateur')->getData());

        return $progression;
    }

}
