<?php

namespace App\Ex02Bundle\Controller;

use Exception;
use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\DBAL\Exception as DoctrineDBALException;


class Ex02Controller extends AbstractController
{
    #[Route('/e02', name: 'e02_index')]
    public function index(): Response
    {
        return new Response("Hello from Ex02Controller!");
    }

    #[Route('/e02/create_user', name: 'e02_create_user')]
    public function createManyUsers(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $i = 0;
        try 
        {
            $checkUsersExistence = $em->getRepository(User::class)->findAll();
            if (count($checkUsersExistence) > 0)
            {
                foreach ($checkUsersExistence as $users)
                    $em->remove($users);
                $em->flush();
            }
            while ($i < 10)
            {
                $user = new User();
                $user->setUsername('user' . $i);
				$hashedPassword = $passwordHasher->hashPassword($user, '123');
				$user->setPassword($hashedPassword);
				$user->setRoles(['ROLE_USER']);
				$em->persist($user);
				$i++;
			}
			$em->flush();
            $this->addFlash('success', '10 users créés avec succès.');
		} 
		catch (Exception $e) 
		{
			$this->addFlash('error', 'Erreur lors de la création des users : ' . $e->getMessage());
		}
		return $this->redirectToRoute('e02_index');
    }

	#[Route('/e02/create_admin', name: 'e02_create_admin')]
	public function createAdmin(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
	{
		$user = new User();
		$form = $this->createForm(UserFormType::class, $user);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid())
		{
			try
			{
				$checkUserExistence = $em->getRepository(User::class)->findOneBy(['username' => $user->getUsername()]);
				if ($checkUserExistence)
					$form->get('username')->addError(new FormError('Ce nom d\'utilisateur est déjà pris.'));
				else
				{
					$plainPassword = $form->get('plainPassword')->getData();
                    $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
                    $user->setPassword($hashedPassword);
					$user->setRoles(['ROLE_ADMIN']);
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('success', 'Inscription réussie ! Connecte-toi !');
                    return $this->redirectToRoute('e01_sign-in');
				}
			}
			catch (Exception $e)
			{
				$this->addFlash('error', 'Erreur lors de la création de l\'admin : ' . $e->getMessage());
				return $this->redirectToRoute('e02_index');
			}
		}
		return $this->render('create_admin.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
	}
	
	#[Route('/e02/sign_in', name: 'e02_sign_in')]
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
	
	#[Route('/e02/sign_up', name: 'e02_sign_up')]
	#[IsGranted('ROLE_ADMIN')]
	public function admin(UserRepository $userRepository): Response
	{
		try
		{
			$users = $userRepository->findAll();
		}
		catch (Exception $e)
		{
			$this->addFlash('error', 'Erreur lors de l\'affichage des utilisateurs : ' . $e->getMessage());
		}
		return $this->render('admin/index.html.twig', ['users' => $users]);
	}

}
