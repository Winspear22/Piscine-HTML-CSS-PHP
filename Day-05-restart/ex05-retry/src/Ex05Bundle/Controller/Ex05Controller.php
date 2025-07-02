<?php

namespace App\Ex05Bundle\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex05Controller extends AbstractController
{
    /**
     * @Route("/ex05", name="ex05_index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('index.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/ex05/create", name="ex05_create")
     */
    public function createRandomUsers(EntityManagerInterface $em)
    {
        $i = 0;
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
            $user->setName('Nom' . $i);
            $user->setEmail('user' . $i . '@mail.com');
            $user->setEnable(rand(0, 1) === 1);
            $user->setBirthdate(new \DateTime('-' . rand(18, 40) . ' years'));
            $user->setAddress('Adresse ' . $i . ' avenue Testville');
            $em->persist($user);
            $i++;
        }
        try 
        {
            $em->flush();
            $this->addFlash('success', 'Utilisateur ' . $i . ' créé avec succès.');
        } 
        catch (\Exception $e) 
        {
            $this->addFlash('error', 'Erreur lors de la création de l\'utilisateur ' . $i . ': ' . $e->getMessage());
        }
        return $this->redirectToRoute('ex05_index');
    }

	/**
	 * @Route("/ex05/delete/{id}", name="ex05_delete", methods={"POST"})
	 */
	public function delete(EntityManagerInterface $em, $id)
	{
		$user = $em->getRepository(User::class)->find($id);
		if ($user)
		{
			try
			{
				$userUsername = $user->getUsername();
				$em->remove($user);
				$em->flush();
				$this->addFlash('success', 'Utilisateur ' . $userUsername . ' dont l\'id est ' . $id . ' a été supprimé avec succès.');
			}
			catch (\Exception $e)
			{
				$this->addFlash('error', 'Erreur lors de la suppression de l\'utilisateur : ' . $id . ' ' . $e->getMessage());
			}
		}
		else
			$this->addFlash('error', 'Utilisateur avec l\'id ' . $id . ' non trouvé.');
		return $this->redirectToRoute('ex05_index');
	}
}
