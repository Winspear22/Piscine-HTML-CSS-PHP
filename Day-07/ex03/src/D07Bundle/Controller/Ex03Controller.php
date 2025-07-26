<?php

namespace App\D07Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class Ex03Controller extends AbstractController
{
    #[Route('/ex03', name: 'ex03')]
    public function extensionAction(): Response
    {
        $text = 'hello world 2025';
        return $this->render('ex03.html.twig', [
            'text' => $text,
        ]);
    }
}
