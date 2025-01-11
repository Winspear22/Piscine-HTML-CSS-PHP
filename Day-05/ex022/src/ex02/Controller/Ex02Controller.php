<?php

namespace App\ex02\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex02Controller extends AbstractController
{
    /**
     * @Route("/ex02", name="ex02_index")
     */
    public function createTable(Connection $req): Response
    {
        $sql = "CREATE TABLE IF NOT EXISTS user(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) UNIQUE NOT NULL,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            enable BOOLEAN NOT NULL,
            birthdate DATETIME NOT NULL,
            address LONGTEXT NOT NULL
        );";
        $affectedRows = $req->executeStatement($sql);
        return new Response("Requête exécutée avec succès, lignes affectées : $affectedRows");

    }
}