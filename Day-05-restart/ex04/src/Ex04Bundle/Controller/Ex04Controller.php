<?php

namespace App\Ex04Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex04Controller extends AbstractController
{
    /**
     * @Route("/ex04", name="ex04bundle_index")
     */
    public function index(): Response
    {
        // Redirige directement vers la liste des utilisateurs
        return $this->redirectToRoute('ex04bundle_select');
    }

    /**
     * @Route("/ex04/create", name="ex04_create_table")
     */
    public function createDataInTable(Connection $connection): Response
    {
        $message = "";
        try 
        {
            $tableExists = $connection->executeQuery("SHOW TABLES LIKE 'users_ex04'")->rowCount();
            if ($tableExists == 0)
			{
                // Création de la table
                $sql = "CREATE TABLE users_ex04 (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) UNIQUE NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    enable BOOLEAN NOT NULL,
                    birthdate DATETIME NOT NULL,
                    address LONGTEXT NOT NULL
                )";
                $connection->executeStatement($sql);
				// Remplissage initial de 10 utilisateurs
				$insertSql = "INSERT INTO users_ex04 (username, name, email, enable, birthdate, address) VALUES
				('user1', 'Nom1', 'user1@example.com', 1, '1990-01-01 00:00:00', 'Adresse 1'),
				('user2', 'Nom2', 'user2@example.com', 1, '1991-02-02 00:00:00', 'Adresse 2'),
				('user3', 'Nom3', 'user3@example.com', 0, '1992-03-03 00:00:00', 'Adresse 3'),
				('user4', 'Nom4', 'user4@example.com', 1, '1993-04-04 00:00:00', 'Adresse 4'),
				('user5', 'Nom5', 'user5@example.com', 1, '1994-05-05 00:00:00', 'Adresse 5'),
				('user6', 'Nom6', 'user6@example.com', 1, '1995-06-06 00:00:00', 'Adresse 6'),
				('user7', 'Nom7', 'user7@example.com', 0, '1996-07-07 00:00:00', 'Adresse 7'),
				('user8', 'Nom8', 'user8@example.com', 1, '1997-08-08 00:00:00', 'Adresse 8'),
				('user9', 'Nom9', 'user9@example.com', 1, '1998-09-09 00:00:00', 'Adresse 9'),
				('user10', 'Nom10', 'user10@example.com', 1, '1999-10-10 00:00:00', 'Adresse 10')";
				$connection->executeStatement($insertSql);

				$message = "Table 'users_ex04' créée et remplie avec succès.";
			}
            else // Supprime et reremplie la table users
            {
				$connection->executeStatement("DELETE FROM users_ex04");
				$insertSql = "INSERT INTO users_ex04 (username, name, email, enable, birthdate, address) VALUES
				('user1', 'Nom1', 'user1@example.com', 1, '1990-01-01 00:00:00', 'Adresse 1'),
				('user2', 'Nom2', 'user2@example.com', 1, '1991-02-02 00:00:00', 'Adresse 2'),
				('user3', 'Nom3', 'user3@example.com', 0, '1992-03-03 00:00:00', 'Adresse 3'),
				('user4', 'Nom4', 'user4@example.com', 1, '1993-04-04 00:00:00', 'Adresse 4'),
				('user5', 'Nom5', 'user5@example.com', 1, '1994-05-05 00:00:00', 'Adresse 5'),
				('user6', 'Nom6', 'user6@example.com', 1, '1995-06-06 00:00:00', 'Adresse 6'),
				('user7', 'Nom7', 'user7@example.com', 0, '1996-07-07 00:00:00', 'Adresse 7'),
				('user8', 'Nom8', 'user8@example.com', 1, '1997-08-08 00:00:00', 'Adresse 8'),
				('user9', 'Nom9', 'user9@example.com', 1, '1998-09-09 00:00:00', 'Adresse 9'),
				('user10', 'Nom10', 'user10@example.com', 1, '1999-10-10 00:00:00', 'Adresse 10')";
				$connection->executeStatement($insertSql);
				$message = "Table 'users_ex04' a été (re)remplie avec les 10 utilisateurs de base.";
		}
		}
        catch (\Exception $e) 
        {
            $message = "Erreur lors de la création de la table ou de l’insertion : " . $e->getMessage();
        }
        return $this->render('create_table.html.twig', ['message' => $message]);
    }

    /**
     * @Route("/ex04/select", name="ex04bundle_select")
     */
    public function selectTableContent(Connection $connection): Response
    {
        $users = [];
        try 
		{
            $users = $connection->fetchAllAssociative('SELECT * FROM users_ex04');
        } 
		catch (\Exception $e) 
		{
            $this->addFlash('notice', "Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
        }
        return $this->render('select.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/ex04/delete/{id}", name="ex04_delete_data")
     */
    public function deleteTableContent(Connection $connection, int $id): Response
    {
        $message = '';

        try
        {
            $user = $connection->fetchAssociative('SELECT * FROM users_ex04 WHERE id = ?', [$id]);
            if (!$user)
                $message = "Cet utilisateur avec l'id " . $id . " n'existe pas ! Essayez avec un autre.";
            else
            {
                $connection->executeStatement('DELETE FROM users_ex04 WHERE id = ?', [$id]);
                $message = "L'utilisateur avec l'id " . $id . " a été supprimé avec succès !";
            }
        }
        catch (\Exception $e)
        {
            $message = "Erreur lors de la suppression du contenu de la table. Numéro d'erreur : " . $e->getMessage();
        }
        $this->addFlash('notice', $message);
        return $this->redirectToRoute('ex04bundle_select');
    }

    /**
     * @Route("/{wildcard}", requirements={"wildcard"=".*"})
     */
    public function notFound(): Response
    {
        return $this->render('error404.html.twig', [], new Response('', 404));
    }
}
