<?php

namespace App\Ex01Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use App\Entity\User;

class Ex01Controller extends AbstractController
{
    /**
     * @Route("/ex01", name="ex01_index")
     */
    public function index(): Response
    {
        return $this->render('create_table.html.twig');
    }

    /**
     * @Route("/ex01/create", name="ex01_create_table")
     */
    public function createTable(EntityManagerInterface $entityManager): Response
    {
        $message = "";

        try {
            $schemaTool = new SchemaTool($entityManager);
            $metadata = [$entityManager->getClassMetadata(User::class)];

            // Vérifie si la table existe
            $schemaManager = $entityManager->getConnection()->createSchemaManager();
            if ($schemaManager->tablesExist(['user'])) {
                $message = "La table 'user' existe déjà.";
            } else {
                $schemaTool->createSchema($metadata);
                $message = "La table 'user' a été créée avec succès.";
            }
        } catch (\Exception $e) {
            $message = "Erreur : " . $e->getMessage();
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
    $message = "";

    try {
        $schemaManager = $entityManager->getConnection()->createSchemaManager();

        if (!$schemaManager->tablesExist(['user'])) {
            $message = "La table 'user' n'existe pas.";
        } else {
            $connection = $entityManager->getConnection();
            $connection->executeStatement('DROP TABLE user');
            $message = "La table 'user' a été supprimée avec succès.";
        }
    } catch (\Exception $e) {
        $message = "Erreur lors de la suppression de la table : " . $e->getMessage();
    }

    return $this->render('create_table.html.twig', [
        'message' => $message,
    ]);
}

}
