<?php

namespace App\Ex03Bundle\Controller;

use App\Entity\User;
use App\Form\UserTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex03Controller extends AbstractController
{
    /**
     * @Route("/ex03", name="ex03bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex03index!");
    }

    /**
     * @Route("/ex03/insert", name="ex03bundle_insert")
     */
    public function insert(Request $request, EntityManagerInterface $em)
    {
        $user = new User();
        $form = $this->createForm(UserTypeForm::class, $user);

        $form->handleRequest($request);
        $message = "";

        if ($form->isSubmitted() && $form->isValid()) 
        {
            try 
            {
                $em->persist($user);
                $em->flush();
                $message = "Utilisateur enregistré avec succès.";
            } 
            catch (\Exception $e) 
            {
                $message = "Erreur lors de l’enregistrement : " . $e->getMessage();
            }
        }
        return $this->render('insert.html.twig', [
            'form' => $form->createView(),
            'message' => $message
        ]);
    }

    /**
     * @Route("/ex03/select", name="ex03bundle_select")
     */
    public function select(EntityManagerInterface $em)
    {
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('select.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/ex03/delete", name="ex03bundle_delete")
     */
    public function delete(): Response
    {
        return new Response("Hello from Ex03delete!");
    }
}
