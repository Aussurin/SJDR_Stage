<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartieController extends AbstractController
{
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

}
