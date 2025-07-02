<?php

namespace App\Ex10Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex10Controller extends AbstractController
{
    const SUCCESS = 0;
	const FAILURE = 1;
	const DOES_NOT_EXIST = 2;
    /**
     * @Route("/ex10", name="ex10")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex10Controller!");
    }

    /**
     * @Route("/ex10/create-sql-table", name="ex10_create_sql_table")
     */
    public function createSqlTable(Connection $connection): Response
    {
        $sql = "CREATE TABLE IF NOT EXISTS ex10_sql_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            value VARCHAR(255) NOT NULL
        )";
        $connection->executeStatement($sql);

        return new Response("Table SQL créée (ou déjà existante)");
    }
}
