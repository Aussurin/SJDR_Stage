<?php

namespace App\Controller;

use App\Entity\Campagne;
use App\Form\CampagneType;
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
    public function creerCampagne(Request $request, MembreRepository $membreRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        $campagne = new Campagne();
        $campagneForm = $this->createForm(CampagneType::class,$campagne);
        $campagneForm->handleRequest($request);

        if($campagneForm->isSubmitted()){

            $rand = $this->generateRandomString();
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

            $pseudos[] = $membre->getPseudo();
        }


        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('campagne/creer.html.twig', [
            'controller_name' => 'MembreController',
            'contexte' => $contexte,
            'campagneForm'=>$campagneForm->createView(),
            'pseudos'=>$pseudos,

        ]);
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
