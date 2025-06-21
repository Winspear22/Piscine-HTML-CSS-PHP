<?php

namespace App\Ex04Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex04Controller extends AbstractController
{
    /**
     * @Route("/ex04bundle", name="ex04bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex04Controller!");
    }
}
