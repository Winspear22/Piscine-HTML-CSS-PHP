<?php

namespace App\Ex01Bundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
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
        $schemaTool = new SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $message = null;

        try {
            if (empty($metadata)) {
                throw new \Exception('Aucune entité définie. Impossible de créer des tables.');
            }

            // Vérifie si la table existe déjà
            $schemaManager = $entityManager->getConnection()->createSchemaManager();
            if ($schemaManager->tablesExist(['user'])) {
                $message = "La table 'user' existe déjà.";
            } else {
                $schemaTool->createSchema($metadata);
                $message = "Table 'user' créée avec succès !";
            }
        } catch (\Exception $e) {
            $message = "Erreur lors de la création de la table : " . $e->getMessage();
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
        $schemaTool = new SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $message = null;

        try {
            if (empty($metadata)) {
                throw new \Exception('Aucune entité définie. Impossible de supprimer des tables.');
            }

            $schemaTool->dropSchema($metadata);
            $message = "Table 'user' supprimée avec succès.";
        } catch (\Exception $e) {
            $message = "Erreur lors de la suppression de la table : " . $e->getMessage();
        }

        return $this->render('create_table.html.twig', [
            'message' => $message,
        ]);
    }
}

?>