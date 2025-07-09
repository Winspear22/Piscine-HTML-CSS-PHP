<?php

namespace App\Ex13Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Ex13Controller extends AbstractController
{
    /**
     * @Route("/ex13bundle", name="ex13bundle_index")
     */
    public function index(): Response
    {
        return new Response("Hello from Ex13Controller!");
    }
}
