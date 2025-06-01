<?php

namespace App\Ex08Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex08Controller extends AbstractController
{
    /**
     * @Route("/ex08bundle", name="ex08bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex08Controller!");
    }
}
