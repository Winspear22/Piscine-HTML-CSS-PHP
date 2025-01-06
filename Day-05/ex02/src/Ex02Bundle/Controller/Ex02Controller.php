<?php

namespace App\Ex02Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex02Controller extends AbstractController
{
	/**
	 * @Route("/ex02", name="ex02_route")
	 */
	public function helloWorld(): Response
	{
		return new Response('hello');
	}
}

?>