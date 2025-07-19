<?php

namespace App\E01Bundle\Controller;

use Exception;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class E01Controller extends AbstractController
{
    #[Route('/e01', name: 'e01_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig'); // chemin conseillé pour l'accueil
    }

    #[Route('/e01/sign-in', name: 'e01_sign-in')]
    public function signIn(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/e01/sign-up', name: 'e01_sign-up')]
    public function signUp(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Vérifier si le username existe déjà
                $existingUser = $em->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
                if ($existingUser) {
                    $form->get('username')->addError(new FormError('Ce nom d\'utilisateur est déjà pris.'));
                } else {
                    // Récupère le mot de passe en clair
                    $plainPassword = $form->get('plainPassword')->getData();
                    // Hash le mot de passe avant de le mettre dans l'entité
                    $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                    $user->setPassword($hashedPassword);

                    // Ajoute le rôle de base
                    $user->setRoles(['ROLE_USER']);

                    // Sauvegarde l'utilisateur
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('success', 'Inscription réussie ! Connecte-toi !');
                    // Redirige vers la page de login
                    return $this->redirectToRoute('e01_sign-in');
                }
            } catch (Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
                // Log l'erreur si nécessaire
            }
        }
        return $this->render('sign-up.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/e01/sign-out', name: 'e01_sign-out')]
    public function signOut(): void	{}

    #[Route('/e01/welcome', name: 'e01_welcome')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function welcome(): Response
    {
        return $this->render('welcome.html.twig', [
            'username' => $this->getUser()->getUserIdentifier(),
        ]);
    }

	#[Route('/e01/need-auth', name: 'e01_need_auth')]
	public function needAuth(): Response
	{
		return $this->render('need_auth.html.twig');
	}

}
