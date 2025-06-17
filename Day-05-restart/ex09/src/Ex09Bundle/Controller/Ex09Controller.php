<?php

namespace App\Ex09Bundle\Controller;

use App\Entity\Address;
use App\Entity\BankAccount;
use App\Entity\Person;
use App\Form\AddressTypeForm;
use App\Form\BankAccountTypeForm;
use App\Form\PersonTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex09Controller extends AbstractController
{
    /**
     * @Route("/ex09", name="ex09_index")
     */
    public function index(EntityManagerInterface $em): Response
    {
        // Liste toutes les personnes
        $persons = $em->getRepository(Person::class)->findAll();

        return $this->render('index.html.twig', [
            'persons' => $persons,
        ]);
    }

    /**
     * @Route("/ex09/createPerson", name="ex09_createPerson")
     */
    public function createPerson(Request $request, EntityManagerInterface $em): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonTypeForm::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('ex09_index');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ex09/update/{id}", name="ex09_update")
     */
    public function updatePerson(Request $request, Person $person, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PersonTypeForm::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            return $this->redirectToRoute('ex09_index');
        }

        return $this->render('update.html.twig', [
            'form' => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/ex09/delete/{id}", name="ex09_delete")
     */
    public function deletePerson(Person $person, EntityManagerInterface $em): Response
    {
        $em->remove($person);
        $em->flush();

        return $this->redirectToRoute('ex09_index');
    }

	/**
     * @Route("/ex09/create_ba", name="ex09_create_ba")
     */
	public function createBankAccount(Request $request, EntityManagerInterface $em): Response
	{
		$bankAccount = new BankAccount();
		$form = $this->createForm(BankAccountTypeForm::class, $bankAccount);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($bankAccount);
            $em->flush();

            return $this->redirectToRoute('ex09_index');
        }
		return $this->render('ex09_index.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
     * @Route("/ex09/create_address", name="ex09_create_address")
     */
	public function createAddress(Request $request, EntityManagerInterface $em): Response
	{
		$address = new Address();
		$form = $this->createForm(AddressTypeForm::class, $address);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('ex09_index');
        }
		return $this->render('ex09_index.html.twig', [
			'form' => $form->createView(),
		]);
	}

	
}
