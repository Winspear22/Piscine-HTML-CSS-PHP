<?php

namespace App\E01Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class E01Controller extends AbstractController
{
	/**
	* @Route("/e01", name="index")
	*/
    public function index(): Response
    {
		return $this->render('index.html.twig'); 
	}

	/**
    * @Route("/e01/{article}", name="e01_article")
    */
    public function article(string $article): Response
    {
        // Définissez vos articles dans un tableau (idéalement vous pourriez les stocker ailleurs)
        $articles = [
            'goeland' => [
                'title' => 'Les Goélands',
                'content' => 'Les goélands sont des oiseaux marins... (contenu de l\'article sur les goélands)'
            ],
            'mouette' => [
                'title' => 'Les Mouettes',
                'content' => 'Les mouettes sont des oiseaux marins similaires aux goélands...'
            ],
            'dauphin' => [
                'title' => 'Les Dauphins',
                'content' => 'Les dauphins sont des mammifères marins très intelligents...'
            ],
        ];

        // Vérifier si l'article demandé existe
        if (!isset($articles[$article]))
			return $this->render('index.html.twig'); 

        // Récupérer les données de l'article demandé
        $data = $articles[$article];
        // Rendre le template article.html.twig avec les variables
        return $this->render('article.html.twig', [
            'article_title' => $data['title'],
            'article_content' => $data['content'],
        ]);
    }
}

?>