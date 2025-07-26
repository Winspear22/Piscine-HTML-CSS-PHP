<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex02Controller extends AbstractController
{
    #[Route('/{_locale}/ex02/{count}', name: 'ex02', requirements: ['_locale' => 'en|fr', 'count' => '\d'], defaults: ['count' => 0])]
    public function translationsAction(int $count): Response
    {
        $number = $this->getParameter('d07.number');

        return $this->render('ex02.html.twig', [
            'number' => $number,
            'count' => $count,
        ]);
    }
}
