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
	public function index(Connection $connection)
	{
		// Préparer des tableaux vides par défaut
		$persons = [];
		$addresses = [];
		$bankAccounts = [];
		$message = "";

		// Tenter de récupérer les données de chaque table si elle existe
		try 
		{
			// Persons
			$tableExists = $connection->executeQuery("SHOW TABLES LIKE 'persons'")->rowCount();
			if ($tableExists > 0)
				$persons = $connection->fetchAllAssociative('SELECT * FROM persons');
			// Addresses
			$addrExists = $connection->executeQuery("SHOW TABLES LIKE 'addresses'")->rowCount();
			if ($addrExists > 0)
				$addresses = $connection->fetchAllAssociative('SELECT * FROM addresses');
			// Bank Accounts
			$bankExists = $connection->executeQuery("SHOW TABLES LIKE 'bank_accounts'")->rowCount();
			if ($bankExists > 0)
				$bankAccounts = $connection->fetchAllAssociative('SELECT * FROM bank_accounts');
		} 
		catch (\Exception $e)
		{
			$message = "Erreur lors de la récupération des données : " . $e->getMessage();
		}

		return $this->render('display_all.html.twig', [
			'persons' => $persons,
			'addresses' => $addresses,
			'bankAccounts' => $bankAccounts,
			'message' => $message
		]);
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
				{
					$message = "La colonne 'marital_status' existe déjà !";
					$this->addFlash('notice', $message);
					return $this->redirectToRoute('ex08_create_persons');
				}
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
     * @Route("/ex08/create-address-table", name="ex08_create_address_tables")
     */
	public function createAddressesTable(Connection $connection) 
	{
		$message = "";
		try
		{
			$addressExists = $connection->executeQuery("SHOW TABLES LIKE 'addresses'")->rowCount();
			if ($addressExists == 0)
			{
				$sql = "CREATE TABLE addresses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				street VARCHAR(255) NOT NULL,
				city VARCHAR(255) NOT NULL,
				country VARCHAR(255) NOT NULL
				)";
				$connection->executeStatement($sql);
				$message = "Création de la table 'addresses' faite avec succès.";
			}
		}
		catch (\Exception $e)
		{
			$message = "Erreur lors de la création de la table 'addresses', code erreur : " . $e;
		}
		return $this->render('create_extra_table.html.twig', ['message' => $message]);
	}

	/**
     * @Route("/ex08/create-BankAccount-table", name="ex08_create_BankAccount_tables")
     */
	public function createBankAccountsTable(Connection $connection)
	{
		$message = "";
		try
		{
			$bankExists = $connection->executeQuery("SHOW TABLES LIKE 'bank_accounts'")->rowCount();
			if ($bankExists == 0)
			{
				$sql = "CREATE TABLE bank_accounts (
					id INT AUTO_INCREMENT PRIMARY KEY,
					iban VARCHAR(34) NOT NULL,
					bank_name VARCHAR(255) NOT NULL
				)";
				$connection->executeStatement($sql);
				$message = "Création de la table 'addresses' faite avec succès.";
			}
		}
		catch (\Exception $e)
		{
			$message = "Erreur lors de la création de la table 'bank_accounts', code erreur : " . $e;
		}
		return $this->render('create_extra_table.html.twig', ['message' => $message]);
	}


    /**
     * @Route("/ex08/add-relations", name="ex08_add_relations")
     */
    public function addRelations(Connection $connection)
    {

    }
}
