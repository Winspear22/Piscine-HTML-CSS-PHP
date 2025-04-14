<?php

namespace App\Ex00Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex00Controller extends AbstractController
{
    /**
     * Méthode privée qui contient la logique de création
     */
    private function createTableLogic(Connection $connection): string
    {
        $message = "";
        try 
        {
            $tableExists = $connection->executeQuery("SHOW TABLES LIKE 'users'")->rowCount();
            if ($tableExists > 0) 
                $message = "La table 'users' existe déjà.";
            else 
            {
                $sql = "CREATE TABLE users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) UNIQUE NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    enable BOOLEAN NOT NULL,
                    birthdate DATETIME NOT NULL,
                    address LONGTEXT NOT NULL
                )";
                $connection->executeStatement($sql);
                $message = "Table 'users' créée avec succès.";
            }
        } 
        catch (\Exception $e) 
        {
            $message = "Erreur lors de la création de la table : " . $e->getMessage();
        }

        return $message;
    }

    /**
     * @Route("/ex00", name="ex00_index")
     */
    public function index(Connection $connection, Request $request): Response
    {
        $message = null;

        if ($request->query->has('create'))
            $message = $this->createTableLogic($connection);

        return $this->render('create_table.html.twig', [
            'message' => $message
        ]);
    }
}
