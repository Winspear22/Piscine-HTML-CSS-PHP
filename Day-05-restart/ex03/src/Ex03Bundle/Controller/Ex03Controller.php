<?php

namespace App\Ex03Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex03Controller extends AbstractController
{
    /**
     * @Route("/ex03bundle", name="ex03bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex03Controller!");
    }
}
