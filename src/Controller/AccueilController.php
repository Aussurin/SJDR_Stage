<?php

namespace App\Controller;

use App\Service\RecuperateurContexte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{

    public function __construct(private readonly RecuperateurContexte $recuperateurContexte)
    {

    }

    #[Route('/', name: 'app_accueil')]
    public function index(Request $request): Response
    {
        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'contexte' => $contexte,
            'jeuchoisi' => 'vampire',
            'ismobile' => $ismobile
        ]);
    }

    #[Route('/accueil/{jeu}', name: 'app_accueil_jeu')]
    public function indexJeu($jeu, Request $request): Response
    {
        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'jeuchoisi' => $jeu,
            'contexte' => $contexte,
            'ismobile' => $ismobile
        ]);
    }



}