<?php

namespace App\E07Bundle\Controller;

use Exception;
use Throwable;
use App\Entity\User;
use App\Form\UserFormType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception as DoctrineDBALException;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class E07Controller extends AbstractController
{
    #[Route('/e07', name: 'e07_index')]
    public function index(EntityManagerInterface $em): Response
    {
        try
		{
            return $this->render('index.html.twig');
        }
		catch (DoctrineDBALException $e)
		{
            $this->addFlash('error', 'La base de données est indisponible.');
            return $this->render('error_db.html.twig');
        }
		catch (Exception $e)
		{
return $this->render('error_db_others.html.twig', [
    'error_message' => 'Erreur inattendue : ' . $e->getMessage(),
    'exception_message' => $e::class,
]);

        }
    }

    #[Route('/e07/need-auth', name: 'e07_need_auth')]
    public function needAuth(): Response
    {
        return $this->render('need_auth.html.twig');
    }

    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/e07/sign_out', name: 'e07_sign_out')]
    public function signOut(): void {}

    #[Route('/e07/sign_in', name: 'e07_sign_in')]
    public function signIn(): Response
    {
        try
        {
            return $this->render('security/login.html.twig');
        }
        catch (DoctrineDBALException $e) 
        {
            $this->addFlash('error', 'La base de données est indisponible.');
            return $this->render('error_db.html.twig');
        }
        catch (Exception $e)
        {
            $this->addFlash('error', 'Erreur inattendue : ' . $e->getMessage());
            return $this->render('error_db_others.html.twig');
        }
    }

    #[Route('/e07/sign_up', name: 'e07_sign_up')]
    public function createUser(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try
            {
                if ($em->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]))
                    $form->get('username')->addError(new FormError('Ce nom d\'utilisateur est déjà pris.'));
                else
                {
                    $user->setPassword($passwordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
                    $user->setRoles(['ROLE_USER']);
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('success', 'Inscription réussie ! Connecte-toi !');
                    return $this->redirectToRoute('e07_sign_in');
                }
            }
            catch (Throwable $e)
            {
                $this->addFlash('error', 'Erreur lors de la création de l\'utilisateur.');
                return $this->redirectToRoute('e07_index');
            }
        }

        return $this->render('sign_up.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/e07/welcome', name: 'e07_welcome')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[IsGranted(attribute: 'ROLE_USER')]
    public function welcome(): Response
    {
        try
        {
            return $this->render('welcome.html.twig', [
            'username' => $this->getUser()->getUserIdentifier(),
            ]);
        }
        catch (Exception $e)
        {
            $this->addFlash('error', 'Une erreur est survenue lors de l\'affichage de la page de bienvenue.');
            return $this->redirectToRoute('e07_index');
        }
    }
}
