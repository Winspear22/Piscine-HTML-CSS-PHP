<?php

namespace App\E01Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoloController extends AbstractController
{
    private $articles = ['goeland', 'mouette', 'pelican'];

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
        if (!in_array($articleName, $this->articles)) {
            // Si l'article n'existe pas, affiche la page principale
            return $this->render('E01Bundle/main.html.twig');
        }
        
        // Si l'article existe, affiche l'article
        return $this->render("E01Bundle/{$articleName}.html.twig");
    }
}

