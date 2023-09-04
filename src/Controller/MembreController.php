<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\ImgProfilType;
use App\Form\MembreType;
use App\Form\ModifierMembreType;
use App\Repository\FicheVampireRepository;
use App\Service\RecuperateurContexte;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
            $this->addFlash(
                'success',
                'Compte créé, vous pouvez maintenant vous y connecter.',
            );
            return $this->redirectToRoute('app_connecter');
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

    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request): Response
    {
        return $this->redirectToRoute('app_profil_jeu', array('jeu'=>'vampire'));
    }
    #[Route('/profil/{jeu}', name: 'app_profil_jeu')]
    public function profilJeu(Request $request, $jeu): Response
    {
        $membre = $this->getUser();

        $modifierMembreForm = $this->createForm(ModifierMembreType::class, $membre);
        $modifierMembreForm->handleRequest($request);
        $imgForm = $this->createForm(ImgProfilType::class,$membre);
        $imgForm->handleRequest($request);

        if ($modifierMembreForm->isSubmitted() && $modifierMembreForm->isValid()){

            $this->entityManager->persist($membre);
            $this->entityManager->flush();
        }
        if ($imgForm->isSubmitted() && $imgForm->isValid()){

            $this->entityManager->persist($membre);
            $this->entityManager->flush();
            // $imageOptimizer = new ImageOptimizer();
            // $imageOptimizer->resize($membre->getImageName());
        }
        $membre->setImageFile(null);

        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('membre/profil.html.twig', [
            'controller_name' => 'MembreController',
            'jeuchoisi' => $jeu,
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'modifierMembreForm' => $modifierMembreForm->createView(),
            'imgform'=> $imgForm->createView(),
        ]);
    }

    #[Route('/modifiermdp', name: 'app_modifiermdp')]
    public function modifiermdp(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $membre = $this->getUser();
        $form = $this->createFormBuilder($membre)
            ->add('password', RepeatedType::class,[
                'type'=> PasswordType::class,
                'invalid_message'=>'Les deux champs doivent être identiques',
                'options'=>['attr'=>['class'=>'password-field']],
                'required'=>true,
                'first_options'=>[
                    'label'=>false
                ],
                'second_options'=>[
                    'label'=>false
                ],
            ])->getForm();
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){


            $membre->setPassword($hasher->hashPassword(
                $membre,
                $membre->getPassword()
            ));


            $this->entityManager->persist($membre);
            $this->entityManager->flush();

        }

        $ismobile = $this->recuperateurContexte->isMobile($request);
        $contexte = $this->recuperateurContexte->recupContexte($request);
        return $this->render('membre/modifiermdp.html.twig', [
            'controller_name' => 'MembreController',
            'ismobile' => $ismobile,
            'contexte' => $contexte,
            'form' => $form->createView(),
        ]);
    }

}
