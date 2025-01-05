<?php

namespace App\Ex01Bundle\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex01Controller extends AbstractController
{

	/**
	*	@Route("/ex01", name="ex01_create_table")
	*/
	public function createTable(): Response
	{
		return new Response('hello world');
	}

}


?>