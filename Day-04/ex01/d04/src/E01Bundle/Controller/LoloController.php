<?php

namespace App\E01Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoloController extends AbstractController
{
    /**
     * @Route("/e01/secondpage", name="second_page")
     */     
    public function helloFromAnnotationEx01(): Response
    {
        return new Response('Hello world ex01!');
    }
}

