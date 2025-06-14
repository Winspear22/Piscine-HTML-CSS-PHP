<?php

namespace App\Ex03Bundle\Controller;

use App\Entity\User;
use App\Form\UserTypeForm;
use App\Ex03Bundle\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex03Controller extends AbstractController
{
    /**
     * @Route("/ex03", name="ex03_index")
     */
    public function index(): Response
    {
        return $this->render('select.html.twig');
    }

    /**
     * @Route("/ex03/insert", name="ex03_insert")
     */
    public function insert(Request $request, UserService $userManager)
    {
        $user = new User();
        $form = $this->createForm(UserTypeForm::class, $user);
        $form->handleRequest($request);
        $message = "";

        if ($form->isSubmitted() && $form->isValid()) 
        {
            try 
            {
                $userManager->save($user); // Utilisation du service !
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
     * @Route("/ex03/select", name="ex03_select")
     */
    public function select(UserService $userManager)
    {
        $users = $userManager->getAll();

        return $this->render('select.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/ex03/delete", name="ex03_delete")
     */
    public function delete(UserService $userManager, Request $request): Response
    {
        $userManager->deleteAll();
        $this->addFlash('success', 'Tous les utilisateurs ont été supprimés.');
        return $this->redirectToRoute('ex03_select');    
    }
}
