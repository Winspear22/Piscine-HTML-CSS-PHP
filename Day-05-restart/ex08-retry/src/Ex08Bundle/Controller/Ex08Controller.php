<?php

namespace App\Ex08Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex08Controller extends AbstractController
{

    const SUCCESS = 0;
	const FAILURE = 1;
	const DOES_NOT_EXIST = 2;
    /**
     * @Route("/ex08", name="ex08_index")
     */
    public function index(Connection $connection): Response
    {
        return new Response("Hello from Ex08Controller!");
    }
    
	/*========================================================================================*/
	/*--------------------------------------- CREATE TABLES -----------------------------------------*/
	/*========================================================================================*/

		/**
	 * @Route("/ex08/create-persons", name="ex08_create_persons")
	 */
	public function createPersonsTable(Connection $connection)
	{
		$tableName = 'persons';
		$result = $this->createPersonsHelper($tableName, $connection);
		$this->addFlash('notice', $result['message']);
		return $this->redirectToRoute('ex08_index');
	}

    private function createPersonsHelper(string $tableName, Connection $connection): array
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
            ) ENGINE=InnoDB;";
            $connection->executeStatement($sql);
            return ['status' => self::SUCCESS, 'message' => "La table '$tableName' a été créée avec succès."];
        } 
        catch (\Exception $e) 
        {
            return ['status' => self::FAILURE, 'message' => "Erreur lors de la création de la table '$tableName' : " . $e->getMessage()];
        }
    }
	
	/**
	 * @Route("/ex08/create-address-table", name="ex08_create_address_tables")
	 */
	public function createAddressesTable(Connection $connection)
	{
		$tableName = 'addresses';
		$result = $this->createAddressesHelper($tableName, $connection);
		$this->addFlash('notice', $result['message']);
		return $this->redirectToRoute('ex08_index');
	}
	private function createAddressesHelper(string $tableName, Connection $connection): array
	{
		try
		{
			$exists = $this->tableExistenceCheck($tableName, $connection);
			if ($exists['status'] === self::DOES_NOT_EXIST)
			{
				$sql = "CREATE TABLE `$tableName` (
					id INT AUTO_INCREMENT PRIMARY KEY,
					street VARCHAR(255) NOT NULL,
					city VARCHAR(255) NOT NULL,
					country VARCHAR(255) NOT NULL
				)";
				$connection->executeStatement($sql);
				return ['status' => self::SUCCESS, 'message' => "La table '$tableName' a été créée avec succès."];
			}
			return ['status' => self::SUCCESS, 'message' => "La table '$tableName' existe déjà."];
		}
		catch (\Exception $e)
		{
			return ['status' => self::FAILURE, 'message' => "Erreur lors de la création de la table '$tableName' : " . $e->getMessage()];
		}
	}

	/**
     * @Route("/ex08/create-BankAccount-table", name="ex08_create_BankAccount_tables")
     */
	public function createBankAccountsTable(Connection $connection)
	{
		$tableName = 'bank_accounts';
		$result = $this->createBankAccountsHelper($tableName, $connection);
		$this->addFlash('notice', $result['message']);
		return $this->redirectToRoute('ex08_index');
	}

	private function createBankAccountsHelper(string $tableName, Connection $connection): array
	{
		try
		{
			$exists = $this->tableExistenceCheck($tableName, $connection);
			if ($exists['status'] === self::DOES_NOT_EXIST)
			{
				$sql = "CREATE TABLE `$tableName` (
					id INT AUTO_INCREMENT PRIMARY KEY,
					iban VARCHAR(34) NOT NULL UNIQUE,
					bank_name VARCHAR(255) NOT NULL
					)";
				$connection->executeStatement($sql);
				return ['status' => self::SUCCESS, 'message' => "La table '$tableName' a été créée avec succès."];
			}
			return ['status' => self::SUCCESS, 'message' => "La table '$tableName' existe déjà."];
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
	/*--------------------------------- ADD MARITAL STATUS -----------------------------------*/
	/*========================================================================================*/


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
        try 
		{
            $sql = "SELECT * FROM `$tableName` WHERE id = :id";
            $person = $connection->fetchAssociative($sql, ['id' => $id]);
            return $person ?: null;
        } 
		catch (\Exception $e) 
		{
            return null;
        }
    }

	/*========================================================================================*/
	/*------------------------------------ DROP TABLES ---------------------------------------*/
	/*========================================================================================*/

	/**
	 * @Route("/ex08/drop-tables", name="ex08_drop_tables")
	 */
	public function dropTables(Connection $connection)
	{
		$message = "";
		try 
		{
			$bankSql = "DROP TABLE IF EXISTS bank_accounts";
			$addrSql = "DROP TABLE IF EXISTS addresses";
			$persSql = "DROP TABLE IF EXISTS persons";
			$connection->executeStatement($bankSql);
			$connection->executeStatement($addrSql);
			$connection->executeStatement($persSql);
			$message = "Les tables bank_accounts, addresses et persons ont bien été supprimées (si elles existaient) !";
		} 
		catch (\Exception $e)
		{
			$message = "Erreur lors de la suppression des tables : " . $e->getMessage();
		}
		return $this->render('drop_tables.html.twig', ['message' => $message]);
	}
}
