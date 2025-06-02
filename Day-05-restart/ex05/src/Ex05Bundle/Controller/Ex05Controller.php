<?php

namespace App\Ex05Bundle\Controller;

use App\Repository\UserEx05Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex05Controller extends AbstractController
{
    /**
     * @Route("/ex05", name="ex05_index")
     */
    public function index(UserEx05Repository $repo): Response
    {
		$users = $repo->findAll();

        return $this->render("displayAllUsers.html.twig", ["users" => $users]);
    }

	/**
	 * @Route("/ex05/create", name="ex05_create")
	 */
	public function createRandomUsers(EntityManagerInterface $em, UserEx05Repository $repo)
	{
		try 
		{
			// Supprime tous les users existants (attention, méthode ORM !)
			foreach ($repo->findAll() as $user) 
			{
				$em->remove($user);
			}
			$em->flush();

			// Génère 10 nouveaux users
			for ($i = 1; $i <= 10; $i++) 
			{
				$user = new \App\Entity\UserEx05();
				$user->setUsername('user'.$i);
				$user->setName('Nom'.$i);
				$user->setEmail("user$i@example.com");
				$user->setEnable($i % 3 != 0); // Par exemple, certains inactifs
				$user->setBirthdate(new \DateTime(sprintf('199%d-%02d-%02d', $i-1, $i, $i)));
				$user->setAddress('Adresse '.$i);
				$em->persist($user);
			}
			$em->flush();

			$this->addFlash('success', "10 utilisateurs générés avec succès.");
		} 
		catch (\Exception $e) 
		{
			$this->addFlash('error', "Erreur lors de la génération : ".$e->getMessage());
		}
		return $this->redirectToRoute('ex05_index');
	}


	/**
	 * @Route("/ex05/delete/{id}", name="ex05_delete")
	 */
	public function deleteUser($id, UserEx05Repository $repo, EntityManagerInterface $em)
	{
		try
		{
			$user = $repo->find($id);
			if (!$user)
				$this->addFlash('error', "L'utilisateur avec l'id $id n'existe pas.");
			else 
			{
				$em->remove($user);
				$em->flush();
				$this->addFlash('success', "Utilisateur supprimé avec succès.");
			}
		}
		catch (\Exception $e)
		{
			$this->addFlash('error', "Erreur lors de la suppression : " . $e->getMessage());
		}
		return $this->redirectToRoute('ex05_index');
	}
}
