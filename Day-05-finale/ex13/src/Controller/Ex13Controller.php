<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex13Controller extends AbstractController
{
	/**
	 * @Route("/ex13", name="ex13_index")
	 */
	public function index(EntityManagerInterface $em): Response
	{
		try 
		{
			$employees = $em->getRepository(Employee::class)->findAll();
		} 
		catch (\Exception $e) 
		{
			$this->addFlash('error', "Erreur d'accès à la base de données : " . $e->getMessage());
			$employees = [];
		}
		return $this->render('index.html.twig', 
		['employees' => $employees,]);
	}

	/**
	 * @Route("/ex13/create", name="ex13_create")
	 */
	public function create(EntityManagerInterface $em, Request $request): Response
	{
		$employee = new Employee();
		$form = $this->createForm(EmployeeFormType::class, $employee);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) 
		{
			try 
			{
				$em->persist($employee);
				$em->flush();
				$this->addFlash('success', 'Employé créé avec succès.');
				return $this->redirectToRoute('ex13_index');
			} 
			catch (\Exception $e) 
			{
				$this->addFlash('error', 'Erreur lors de la création : '.$e->getMessage());
			}
		}
		return $this->render('ex13/create.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/ex13/update/{id}", name="ex13_update")
	 */
	public function update(Request $request, EntityManagerInterface $em, int $id): Response
	{
		try
        {
            $employee = $em->getRepository(Employee::class)->find($id);
            if (!$employee)
            {
                $this->addFlash('error', 'Utilisateur avec l\'id ' . $id . ' non trouvé.');
                return $this->redirectToRoute('ex13_index');
            }

            $form = $this->createForm(EmployeeFormType::class, $employee);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                try
                {
                    $em->flush();
                    $this->addFlash('success', 'Utilisateur modifié avec succès.');
                    return $this->redirectToRoute('ex13_index');
                }
                catch (\Exception $e)
                {
                    $this->addFlash('error', 'Erreur lors de la mise à jour de l\'utilisateur : ' . $e->getMessage());
                }
            }
        }
        catch (\Exception $e)
        {
            $this->addFlash('error', "Erreur d'accès à la base de données : " . $e->getMessage());
            return $this->redirectToRoute('ex13_index');
        }

        return $this->render('update.html.twig', [
            'form' => isset($form) ? $form->createView() : null,
            'employee' => isset($employee) ? $employee : null
        ]);
	}

	/**
	 * @Route("/ex13/delete/{id}", name="ex13_delete", methods={"POST"})
	 */
	public function delete(EntityManagerInterface $em, $id)
	{
        try
        {
            $employee = $em->getRepository(Employee::class)->find($id);
            if ($employee)
            {
                    $em->remove($employee);
                    $em->flush();
                    $this->addFlash('success', "Suppression effectuée avec succès.");
            }
            else
                $this->addFlash('error', 'Le employee avec l\'id ' . $id . ' non trouvé.');
        }
        catch (\Exception $e)
        {
            $this->addFlash('error', 'Erreur lors de la suppression du employee : ' . $id . ' ' . $e->getMessage());
        }
        return $this->redirectToRoute('ex13_index');
	}
}

?>