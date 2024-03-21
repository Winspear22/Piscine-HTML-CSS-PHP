<?php

namespace App\E00Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PopoController extends AbstractController
{
    /**
    * @Route("/e00/firstpage", name="first_page")
    */  
    public function helloFromAnnotation()
    {
        return new Response('Hello world!');
    }

    /**
    * @Route("/{url}", requirements={"url"=".+"})
    */
    public function index(): Response
    {
        return new Response(
            '<html><body><h1>Error 404 - PHP04 : adaloui</h1></body></html>',
            Response::HTTP_NOT_FOUND
        );
    }

    
    #[Route('/e00/firstpageAttribute', name: 'first_pageAttribute')]
    public function helloFromAttribute()
    {
        return new Response('Hello world! from Attribute');
    }
}
