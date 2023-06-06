<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MembreController extends AbstractController
{
    public function __construct(private readonly RecuperateurContexte $recuperateurContexte, private readonly EntityManagerInterface $entityManager, private UserPasswordHasherInterface $userPasswordHasher)
    {

    }
    #[Route('/enregistrer', name: 'app_enregistrer')]
    public function enregistrer(Request $request): Response
    {
        $membre = new Membre();
        $membre->setRoles(['ROLE_USER']);
        $creerMembreForm = $this->createForm(MembreType::class, $membre);
        $creerMembreForm->handleRequest($request);


        if ($creerMembreForm->isSubmitted() && $creerMembreForm->isValid()){
            $membre->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $membre,
                    $creerMembreForm->get('password')->getData()
                )
            );

            $this->entityManager->persist($membre);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_accueil');
        }

        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('membre/enregistrement.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'creermembreForm'=> $creerMembreForm->createView(),

        ]);
    }
    #[Route('/connection', name: 'app_connecter')]
    public function connecter(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('membre/connection.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }
    #[Route('/deconnexion', name: 'app_deconnecter')]
    public function deconnecter(Request $request): Response
    {

       return $this->redirectToRoute('app_accueil');
    }
}