<?php

namespace App\Ex11Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex11Controller extends AbstractController
{
    /**
     * @Route("/ex11", name="ex11_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex11Controller!");
    }
}
