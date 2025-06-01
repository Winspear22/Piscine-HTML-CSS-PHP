<?php

namespace App\Ex08Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex08Controller extends AbstractController
{
    /**
     * @Route("/ex08", name="ex08_index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('ex08_create_persons');
    }

    /**
     * @Route("/ex08/create-persons", name="ex08_create_persons")
     */
    public function createPersonsTable(Connection $connection)
    {
        $message = "";
		try
		{
			$tableExists = $connection->executeQuery("SHOW TABLES LIKE 'persons'")->rowCount();
			if ($tableExists == 0)
			{
				$sql = "CREATE TABLE persons (
					id INT AUTO_INCREMENT PRIMARY KEY,
					username VARCHAR(255) UNIQUE NOT NULL,
					name VARCHAR(255) NOT NULL,
					email VARCHAR(255) UNIQUE NOT NULL,
					enable BOOLEAN NOT NULL,
					birthdate DATETIME NOT NULL
				)";
				$connection->executeStatement($sql);
				$message = "Table 'persons' créée avec succès.";
			}
			else
				$message = "La table 'persons' existe déjà.";
		}
		catch (\Exception $e)
		{
			$message = "Erreur lors de la création de la table : " . $e->getMessage();
		}
		return $this->render('create_persons.html.twig', ['message' => $message]);
    }

    /**
     * @Route("/ex08/add-marital-status", name="ex08_add_marital_status")
     */
    public function addMaritalStatusColumn(Connection $connection)
    {
		try
		{
			$tableExists = $connection->executeQuery("SHOW TABLES LIKE 'persons'")->rowCount();
			if ($tableExists == 0)
			{
				$message = "Erreur lors l'ajout du statut marital : la table 'persons' n'existe pas.";
				$this->addFlash('notice', $message);
				return $this->redirectToRoute('ex08_create_persons');
							}
			else
			{
				$columnExists = $connection->executeQuery("SHOW COLUMNS FROM persons LIKE 'marital_status'")->rowCount();
				if ($columnExists > 0)
					$message = "La colonne 'marital_status' existe déjà !";
				else
				{
					$sql = "ALTER TABLE persons 
					ADD COLUMN marital_status ENUM('single','married','widower') NOT NULL DEFAULT 'single';";
					$connection->executeStatement($sql);
					$message = "Requête exécutée avec succès : la colonne situation maritale a été ajoutée avec succès.";
				}
			}
		}
		catch (\Exception $e)
		{
			$message = "Erreur lors l'ajout du statut marital : " . $e->getMessage();
		}
		return $this->render('add_marital_status.html.twig', ['message' => $message]);
    }

    /**
     * @Route("/ex08/create-extra-tables", name="ex08_create_extra_tables")
     */
    public function createExtraTables(Connection $connection)
    {

    }

    /**
     * @Route("/ex08/add-relations", name="ex08_add_relations")
     */
    public function addRelations(Connection $connection)
    {

    }
}
