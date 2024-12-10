<?php

namespace App\Ex00Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex00Controller extends AbstractController
{
    #[Route('/ex00', name: 'app_ex00')]
    public function index(): Response
    {
        return new Response(
            '<html><body><h1>SAASUKE</h1></body></html>'
        );
    }

    /**
     * @Route("/ex01", name="ex00-index")
     */    
    public function toto(): Response
    {
        return new Response(
            '<html><body><h1>NARUTO</h1></body></html>'
        );
    }


}

