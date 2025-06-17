<?php

namespace App\Ex09Bundle\Controller;

use App\Entity\Person;
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
     * @Route("/ex09/new", name="ex09_new")
     */
    public function new(Request $request, EntityManagerInterface $em): Response
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
     * @Route("/ex09/edit/{id}", name="ex09_edit")
     */
    public function edit(Request $request, Person $person, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PersonTypeForm::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $em->flush();

            return $this->redirectToRoute('ex09_index');
        }

        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
            'person' => $person,
        ]);
    }

    /**
     * @Route("/ex09/delete/{id}", name="ex09_delete")
     */
    public function delete(Person $person, EntityManagerInterface $em): Response
    {
        $em->remove($person);
        $em->flush();

        return $this->redirectToRoute('ex09_index');
    }
}
