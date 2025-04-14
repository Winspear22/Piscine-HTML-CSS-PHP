<?php

namespace App\Ex00Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex00Controller extends AbstractController
{
    /**
     * @Route("/createTable", name="createTable")
     */
    public function createTable(): Response
    {
        
    }
    /**
     * @Route("/ex00bundle", name="ex00bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex00Controller!");
    }
}
