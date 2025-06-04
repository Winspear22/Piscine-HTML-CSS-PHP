<?php

namespace App\Ex07Bundle\Controller;

use App\Repository\UserEx07Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex07Controller extends AbstractController
{
/**
 * @Route("/ex07", name="ex07_index")
 */
public function index(UserEx07Repository $repo): Response
{
    $users = $repo->findAll();
    return $this->render('displayAllUsers.html.twig', ['users' => $users]);
}

/**
 * @Route("/ex07/create", name="ex07_create")
 */
public function createRandomUsers(\Doctrine\ORM\EntityManagerInterface $em, \App\Repository\UserEx07Repository $repo)
{
    try {
        // Supprime tous les users existants (nettoyage avant remplissage)
        foreach ($repo->findAll() as $user) {
            $em->remove($user);
        }
        $em->flush();

        // Génère 10 nouveaux users
        for ($i = 1; $i <= 10; $i++) {
            $user = new \App\Entity\UserEx07();
            $user->setUsername('user'.$i);
            $user->setName('Nom'.$i);
            $user->setEmail("user$i@example.com");
            $user->setEnable($i % 3 != 0); // Inactif pour i=3,6,9
            $user->setBirthdate(new \DateTime(sprintf('199%d-%02d-%02d', $i-1, $i, $i)));
            $user->setAddress('Adresse '.$i);
            $em->persist($user);
        }
        $em->flush();

        $this->addFlash('success', "10 utilisateurs générés avec succès.");
    } catch (\Exception $e) {
        $this->addFlash('error', "Erreur lors de la génération : ".$e->getMessage());
    }

    return $this->redirectToRoute('ex07_index');
}


/**
 * @Route("/ex07/edit/{id}", name="ex07_edit")
 */
public function editUser($id,Request $request, UserEx07Repository $repo, EntityManagerInterface $em) 
{
    $user = $repo->find($id);
    if (!$user) 
    {
        $this->addFlash('error', "Utilisateur inexistant.");
        return $this->redirectToRoute('ex07_index');
    }

    // Formulaire généré dans le contrôleur (consigne !)
    $form = $this->createFormBuilder($user)
        ->add('username')
        ->add('name')
        ->add('email')
        ->add('enable')
        ->add('birthdate')
        ->add('address')
        ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();
        $this->addFlash('success', "Utilisateur modifié avec succès !");
        return $this->redirectToRoute('ex07_index');
    }

    return $this->render('editUser.html.twig', [
        'form' => $form->createView(),
        'user' => $user,
    ]);
}


}
