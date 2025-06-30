<?php

namespace App\Ex03Bundle\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex03Controller extends AbstractController
{
    /**
     * @Route("/ex03", name="ex03_index")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {
		$users = $em->getRepository(User::class)->findAll();
		return $this->render('index.html.twig',
			['users' => $users]);
    }

	/**
	 * @Route("/ex03/create", name="ex03_create")
	 */
	public function create(Request $request, EntityManagerInterface $em): Response
	{
			$user = new User();
			$form = $this->createForm(UserType::class, $user);
			$form->handleRequest($request);

			if ($form->isSubmitted() && $form->isValid())
			{
				try 
				{
					$em->persist($user);
					$em->flush();
					$this->addFlash('success', 'Utilisateur créé avec succès.');
					return $this->redirectToRoute('ex03_index');
				}
				catch (\Exception $e)
				{
					$this->addFlash('error', 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage());
				}
			}
		return $this->render('create.html.twig',
			['form' => $form->createView()]);
	}
}
