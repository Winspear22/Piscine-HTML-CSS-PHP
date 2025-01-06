<?php

namespace App\Ex02Bundle\Controller;

use Doctrine\DBAL\Connection;
use App\Ex02Bundle\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex02Controller extends AbstractController
{
	/**
	 * @Route("/ex02", name="ex02_create_table")
	 */
	public function createTable(Connection $connection): Response
	{
		$message = null;
		try
		{
			$checkTable = $connection->executeQuery("SHOW TABLES LIKE 'user'")->rowCount();
			if ($checkTable > 0) 
                $message = "La table 'user' existe déjà.";
			else 
			{
                // Création de la table si elle n'existe pas
                $sql = "CREATE TABLE IF NOT EXISTS user (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) UNIQUE NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    enable BOOLEAN NOT NULL,
                    birthdate DATETIME NOT NULL,
                    address LONGTEXT NOT NULL
                )";
                $connection->executeStatement($sql);
                $message = "Table 'user' créée avec succès !";
            }
        }
		catch (\Exception $e) 
		{
            $message = "Erreur lors de la création de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
	}

	/**
     * @Route("/ex02/delete", name="ex02_delete_table")
     */
    public function deleteTable(Connection $connection): Response
    {
        $message = null;

        try 
		{
            $connection->executeStatement("DROP TABLE IF EXISTS user");
            $message = "Table 'user' supprimée avec succès !";
        } 
		catch (\Exception $e) 
		{
            $message = "Erreur lors de la suppression de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
    }

	/**
	 * @Route("/ex02/form", name="ex02_show_form")
	*/
	public function showForm(Request $request,
		Connection $connection): Response
	{
	    $form = $this->createForm(UserType::class);

	    // Gérer la soumission
	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
	        $data = $form->getData();

	        try {
	            $sql = "INSERT INTO user (username, name, email, enable, birthdate, address) VALUES 
	                (:username, :name, :email, :enable, :birthdate, :address)";
	            $connection->executeStatement($sql, [
	                'username' => $data['username'],
	                'name' => $data['name'],
	                'email' => $data['email'],
	                'enable' => $data['enable'],
	                'birthdate' => $data['birthdate']->format('Y-m-d H:i:s'),
	                'address' => $data['address'],
	            ]);
	            $message = "Utilisateur ajouté avec succès !";
	        } catch (\Exception $e) {
	            $message = "Erreur lors de l'insertion des données : " . $e->getMessage();
	        }
	    } else {
	        $message = null;
	    }

	    return $this->render('form.html.twig', [
	        'form' => $form->createView(),
	        'message' => $message,
	    ]);
	}
	/**
	 * @Route("/ex02/show", name="ex02_show_data")
	 */
	public function showData(Connection $connection): Response
	{
	    try {
	        $users = $connection->fetchAllAssociative("SELECT * FROM user");
	    } catch (\Exception $e) {
	        $users = [];
	        $error = "Erreur lors de la récupération des données : " . $e->getMessage();
	    }
	
	    return $this->render('show_data.html.twig', [
	        'users' => $users,
	        'error' => $error ?? null,
	    ]);
	}

}

?>