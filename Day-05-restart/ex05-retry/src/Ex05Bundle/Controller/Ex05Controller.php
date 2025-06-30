<?php

namespace App\Ex05Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex05Controller extends AbstractController
{
    /**
     * @Route("/ex05bundle", name="ex05bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex05Controller!");
    }
}
