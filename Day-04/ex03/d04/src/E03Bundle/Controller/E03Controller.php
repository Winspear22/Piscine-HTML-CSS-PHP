<?php

namespace App\E03Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class E03Controller extends AbstractController
{
	/**
	* @Route("/e03", name="e03page")
	*/
    public function index(): Response
    {
		return $this->render('index.html.twig'); 
	}
}
?>