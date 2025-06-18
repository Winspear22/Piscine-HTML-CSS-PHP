<?php

namespace App\Ex00Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex00Controller extends AbstractController
{
	const SUCCESS = 0;
	const FAILURE = 1;
	const DOES_NOT_EXIST = 2;

    /**
     * @Route("/ex00", name="ex00_index")
     */
    public function index(): Response
    {
		return $this->render('index.html.twig');
    }

    private function tableExistenceCheck(string $tableName, Connection $connection): array
    {
		try
		{
			$doesTableExists = $connection->executeQuery("SHOW TABLES LIKE '$tableName'")->rowCount();
			if ($doesTableExists > 0)
				return (['status' => self::SUCCESS, 'message' => "La table $tableName existe déjà."]); // La table existe.
			return (['status' => self::DOES_NOT_EXIST, 'message' => "La table $tableName n'existe pas."]); // La table n'existe pas.
		}
		catch (\Exception $e)
		{
        	return ['status' => self::FAILURE, 'message' => "Erreur lors de la RECHERCHE de la table '$tableName', code erreur : " . $e->getMessage()];
		}
	}

	private function createTable(string $tableName, Connection $connection): array
	{
		try 
		{
			$sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
				id INT AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(255) UNIQUE,
				name VARCHAR(255),
				email VARCHAR(255) UNIQUE,
				enable BOOLEAN,
				birthdate DATETIME,
				address LONGTEXT
			) ENGINE=InnoDB;";
			$connection->executeStatement($sql);
			return ['status' => self::SUCCESS, 'message' => "La table '$tableName' a été créée avec succès (ou déjà existante)."];
		} 
		catch (\Exception $e) 
		{
			return ['status' => self::FAILURE, 'message' => "Erreur lors de la CREATION de la table '$tableName', code erreur : " . $e->getMessage()];
		}
	}

    /**
     * @Route("/ex00/create", name="ex00_create")
     */
    public function create(Connection $connection): Response
    {
		$tableName = "persons";
		$messages = [];

		$doesTableExists = $this->tableExistenceCheck($tableName, $connection);
		$messages[] = $doesTableExists['message'];

		if ($doesTableExists['status'] === self::DOES_NOT_EXIST) 
		{
			$createTable = $this->createTable($tableName, $connection);
			$messages[] = $createTable['message'];
		}

		return $this->render('index.html.twig', [
			'messages' => $messages,
			'tableName' => $tableName
		]);
    }
}
