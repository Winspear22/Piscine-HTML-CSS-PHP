<?php

namespace App\Ex06Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex06Controller extends AbstractController
{
    /**
     * @Route("/ex06", name="ex06bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex06Controller!");
    }
}
