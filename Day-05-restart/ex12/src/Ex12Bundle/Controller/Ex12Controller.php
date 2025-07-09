<?php

namespace App\Ex12Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex12Controller extends AbstractController
{
    /**
     * @Route("/ex12bundle", name="ex12bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex12Controller!");
    }
}
