<?php

namespace App\E01Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoloController extends AbstractController
{
    /**
     * @Route("/e01", name="e01_main")
     */    
    public function index_ex01(): Response
    {
        return $this->render('E01Bundle/main.html.twig'); 
    }

    /**
    * @Route("/e01/{articleName}", name="e01_article")
    */
    public function article($articleName): Response
    {
        return $this->render("E01Bundle/{$articleName}.html.twig");
    }
}

