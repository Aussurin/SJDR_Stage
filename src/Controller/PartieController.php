<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Entity\Membre;
use App\Form\CampagneType;
use App\Form\ModifCampagneType;
use App\Repository\CampagneRepository;
use App\Repository\MembreRepository;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isInstanceOf;

class PartieController extends AbstractController
{
    public function __construct(private readonly RecuperateurContexte $recuperateurContexte)
    {

    }
    #[Route('/partie', name: 'app_partie')]
    public function index(): Response
    {
        return $this->render('partie/index.html.twig', [
            'controller_name' => 'PartieController',
        ]);
    }
    #[Route('/partie/rejoindre', name: 'rejoindre_partie')]
    public function rejoindre(Request $request): Response
    {
        //récupération du code demandé dans la page d'accueil pour rejoindre une partie

        return $this->redirectToRoute('app_accueil');
    }

    #[Route('/campagne/creer', name: 'campagne_creer')]
    public function creerCampagne(Request $request, MembreRepository $membreRepository, EntityManagerInterface $entityManager,CampagneRepository $campagneRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $campagne = new Campagne();
        $campagneForm = $this->createForm(CampagneType::class,$campagne);
        $campagneForm->handleRequest($request);

        if($campagneForm->isSubmitted()){
            $test = 1;
            $rand = null;
            while($test != null){
                $rand = $this->generateRandomString();
                $test = $campagneRepository->findOneBy(['random'=>$rand]);
            }

            $campagne->setRandom($rand);
            $campagne->setMaitreDeJeu($this->getUser());

            foreach ($request->get('campagne') as $champ) {
                if (is_array($champ)) {
                    $joueurs = $request->get('campagne')['joueurs'];
                    foreach ($joueurs as $joueur) {
                        $campagne->addJoueur($membreRepository->findOneBy(['pseudo' => $joueur]));
                    }
                }
            }

            $entityManager->persist($campagne);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Campagne crée avec succés.',
            );
            return $this->redirectToRoute('app_profil');
        }

        $membres = $membreRepository->findAll();
        $pseudos = [];
        foreach ($membres as $membre){
            $pseudo = $membre->getPseudo();
            if ($pseudo != $this->getUser()->getPseudo()){
                $pseudos[] = $pseudo;
            }


        }


        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('campagne/creer.html.twig', [
            'controller_name' => 'MembreController',
            'contexte' => $contexte,
            'campagneForm'=>$campagneForm->createView(),
            'pseudos'=>$pseudos,

        ]);
    }

    #[Route('/campagne/{random}', name: 'campagne_consulter')]
    public function consulterCampagne(Request $request, CampagneRepository $campagneRepository, EntityManagerInterface $entityManager, $random): Response{

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $campagne = $campagneRepository->findOneBy(['random'=>$random]);
        if(!$campagne){
            return $this->redirectToRoute('app_accueil');
        }


        $participants[] = $campagne->getMaitreDeJeu()->getPseudo();
        foreach ($campagne->getJoueurs() as $joueur){
            $participants[] = $joueur->getPseudo();
        }
        $user = $this->getUser();
        assert($user instanceof Membre);
        if (!in_array($user->getPseudo(), $participants)){
            $campagne->addJoueur($user);
            $entityManager->persist($campagne);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Vous avez rejoids la campagne.',
            );
        }


        $campagneForm = $this->createForm(ModifCampagneType::class,$campagne);
        $campagneForm->handleRequest($request);

        if ($campagneForm->isSubmitted() && $campagneForm->isValid()){

            $entityManager->persist($campagne);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Campagne modifiée',
            );

        }

        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('campagne/modifier.html.twig', [
            'controller_name' => 'MembreController',
            'contexte' => $contexte,
            'campagneForm'=>$campagneForm->createView(),
        ]);
    }

    #[Route('/campagne/supprimer/{id}', name: 'campagne_supprimer')]
    public function supprimerCampagne(Request $request, CampagneRepository $campagneRepository, EntityManagerInterface $entityManager, $id): Response{
        $campagne = $campagneRepository->findOneBy(['id'=>$id]);
        $user = $this->getUser();
        assert($user instanceof Membre);
        if ($campagne->getMaitreDeJeu()->getPseudo() == $user->getPseudo()){
            $entityManager->remove($campagne);
            $entityManager->flush();
        }else{
            foreach ($user->getCampagnes() as $campagne){
                if ($campagne->getId() == $id){
                    $user->removeCampagne($campagne);
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
            }
        }

        return $this->redirectToRoute('app_profil');
    }


    public function generateRandomString() : string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



}
