<?php

namespace App\Ex01Bundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex01Controller extends AbstractController
{
    /**
     * @Route("/ex01", name="ex01_create_table")
     */
    public function createTable(EntityManagerInterface $entityManager): Response
    {
        $message = null;

        try 
		{
            // Vérifie si la table existe via les métadonnées de Doctrine
            $schemaManager = $entityManager->getConnection()->createSchemaManager();
            $tableExists = $schemaManager->tablesExist(['user']);

            if ($tableExists)
                $message = "La table 'user' existe déjà.";
            else
                $message = "Table 'user' créée avec succès via Doctrine."; // Doctrine gère déjà la création via les migrations
        } 
		catch (\Exception $e) 
		{
            $message = "Erreur lors de la vérification ou création de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @Route("/ex01/delete", name="ex01_delete_table")
     */
    public function deleteTable(EntityManagerInterface $entityManager): Response
    {
        $message = null;

        try 
		{
            $entityManager->getConnection()->executeStatement("DROP TABLE IF EXISTS user");
            $message = "Table 'user' supprimée avec succès.";
        } 
		catch (\Exception $e) 
		{
            $message = "Erreur lors de la suppression de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
    }
}



?>