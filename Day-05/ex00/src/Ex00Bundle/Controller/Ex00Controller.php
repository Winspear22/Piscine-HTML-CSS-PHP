<?php

namespace App\Ex00Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

class Ex00Controller extends AbstractController
{
    /**
     * @Route("/ex00", name="ex00_create_table")
     */
    public function createTable(Connection $connection): Response
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) UNIQUE NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            enable BOOLEAN NOT NULL,
            birthdate DATETIME NOT NULL,
            address LONGTEXT NOT NULL
        )";

        try {
            $connection->executeStatement($sql);
            $message = "Table 'users' créée avec succès !";
        } catch (\Exception $e) {
            $message = "Erreur lors de la création de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
    }
}
