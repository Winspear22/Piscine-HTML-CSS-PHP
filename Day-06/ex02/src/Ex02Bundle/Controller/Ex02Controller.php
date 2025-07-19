<?php

namespace App\Ex02Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex02Controller extends AbstractController
{
    /**
     * @Route("/e02", name="e02_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex02Controller!");
    }
}
