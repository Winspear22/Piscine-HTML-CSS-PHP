<?php

namespace App\Ex02Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex02Controller extends AbstractController
{
    /**
     * @Route("/ex02", name="ex02bundle_index")
     */
    public function index(): Response
    {
        //return new Response("Hello from ex02insert!");
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/ex02/insert", name="ex02insert")
     */
    public function insert(): Response
    {
        $message = "";
        try
        {
            $form = $this->createFormBuilder()
                ->add('username', TextType::class)
                ->add('name', TextType::class)
                ->add('email', EmailType::class)
                ->add('enable', CheckboxType::class, ['required' => false])
                ->add('birthdate', DateType::class, ['widget' => 'single_text'])
                ->add('address', TextareaType::class)
                ->add('submit', SubmitType::class, ['label' => 'Ajouter l’utilisateur'])
                ->getForm();
        }
        catch (\Exception $e)
        {
            $message = "Erreur lors de l'usage de la commande INSERT : " . $e->getMessage();
        }
        return $this->render('insert.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/ex02/select", name="ex02select")
     */
    public function select(): Response
    {
        $message = "";
        try
        {

        }
        catch (\Exception $e)
        {
            $message = "Erreur lors de l'usage de la commande SELECT : " . $e->getMessage();
        }
        //return new Response("Hello from ex02select!");
    }
}
