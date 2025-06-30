<?php

namespace App\Ex07Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex07Controller extends AbstractController
{
    /**
     * @Route("/ex07bundle", name="ex07bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex07Controller!");
    }
}
