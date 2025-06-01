<?php

namespace App\Ex08Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex08Controller extends AbstractController
{
    /**
     * @Route("/ex08", name="ex08bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex08Controller!");
    }

    /**
     * @Route("/ex08/create-persons", name="ex08_create_persons")
     */
    public function createPersonsTable(Connection $connection)
    {
        
    }

    /**
     * @Route("/ex08/add-marital-status", name="ex08_add_marital_status")
     */
    public function addMaritalStatusColumn(Connection $connection)
    {

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
