<?php

namespace App\Ex04Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Ex04Controller extends AbstractController
{

    const SUCCESS = 0;
	const FAILURE = 1;
	const DOES_NOT_EXIST = 2;
    /**
     * @Route("/ex04", name="ex04_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex04Controller!");
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
            return ['status' => self::SUCCESS, 'message' => "La table '$tableName' a été créée avec succès."];
        } 
        catch (\Exception $e) 
        {
            return ['status' => self::FAILURE, 'message' => "Erreur lors de la création de la table '$tableName' : " . $e->getMessage()];
        }
    }
	private function tableExistenceCheck(string $tableName, Connection $connection): array
    {
        try 
        {
            $doesTableExists = $connection->executeQuery("SHOW TABLES LIKE '$tableName'")->rowCount();
            if ($doesTableExists > 0)
                return ['status' => self::SUCCESS, 'message' => "La table $tableName existe déjà."];
            return ['status' => self::DOES_NOT_EXIST, 'message' => "La table $tableName n'existe pas... "];
        }
        catch (\Exception $e) 
        {
            return ['status' => self::FAILURE, 'message' => "Erreur lors de la RECHERCHE de la table '$tableName' : " . $e->getMessage()];
        }
    }
	
	/*========================================================================================*/
	/*--------------------------------------- GETTER -----------------------------------------*/
	/*========================================================================================*/
	
	private function getAllPersons(Connection $connection, string $tableName): array
	{
		try 
		{
			$sql = "SELECT * FROM `$tableName` ORDER BY id DESC";
			return $connection->fetchAllAssociative($sql);
		} 
		catch (\Exception $e) 
		{
			return [];
		}
	}

    private function getPersonById(Connection $connection, string $tableName, int $id): ?array
    {
        try {
            $sql = "SELECT * FROM `$tableName` WHERE id = :id";
            $person = $connection->fetchAssociative($sql, ['id' => $id]);
            return $person ?: null;
        } catch (\Exception $e) {
            return null;
        }
    }

	/*========================================================================================*/
	/*--------------------------------------- DELETE -----------------------------------------*/
	/*========================================================================================*/

	/**
	 * @Route("/ex04/delete/{id}", name="ex04_delete", methods={"POST"})
	 */
	private function delete(Connection $connection, Request $request)
	{
		try
		{
		}
		catch (\Exception $e)
		{
            return ['status' => self::FAILURE, 'message' => 'Erreur lors de la suppression : ' . $e->getMessage()];
		}
	}
}
