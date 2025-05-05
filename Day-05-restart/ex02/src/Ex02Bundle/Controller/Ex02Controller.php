<?php

namespace App\Ex02Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
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

    private function createTableIfNotExists(Connection $connection): void
    {
        try
        {
            $message = "";
            $tableExists = $connection->executeQuery("SHOW TABLES LIKE 'users_ex02'")->rowCount();
            if ($tableExists === 0) 
            {
                $sql = "CREATE TABLE users_ex02 (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) UNIQUE NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    enable BOOLEAN NOT NULL,
                    birthdate DATETIME NOT NULL,
                    address LONGTEXT NOT NULL
                )";
                $connection->executeStatement($sql);
            }
        }
        catch (\Exception $e)
        {
            $message = "Erreur lors de la creation de la table users_ex02.";
        }
    }

    /**
     * @Route("/ex02/insert", name="ex02insert")
     */
    public function insert(Request $request, Connection $connection): Response
    {
        $message = "";
        try
        {
            $this->createTableIfNotExists($connection); // ← APPEL ICI
            $form = $this->createFormBuilder(null, [
                'method' => 'POST',
            ])
                ->add('username', TextType::class)
                ->add('name', TextType::class)
                ->add('email', EmailType::class)
                ->add('enable', CheckboxType::class, ['required' => false])
                ->add('birthdate', DateType::class, ['widget' => 'single_text'])
                ->add('address', TextareaType::class)
                ->add('submit', SubmitType::class, ['label' => 'Ajouter l’utilisateur'])
                ->getForm();
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) 
                {
                    $data = $form->getData();
                    try 
                    {
                        $connection->insert('users_ex02', [
                            'username' => $data['username'],
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'enable' => $data['enable'] ? 1 : 0,
                            'birthdate' => $data['birthdate']->format('Y-m-d H:i:s'),
                            'address' => $data['address'],
                        ]);
                        $message = "Utilisateur ajouté avec succès.";
                    } 
                    catch (\Exception $e) 
                    {
                        $message = "Erreur liee a la base de donnees : " . $e->getMessage();
                    }
                }
        }
        catch (\Exception $e)
        {
            $message = "Erreur lors de l'usage de la commande INSERT : " . $e->getMessage();
        }
        return $this->render('insert.html.twig', ['form' => $form->createView(), 'message' => $message]);
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
