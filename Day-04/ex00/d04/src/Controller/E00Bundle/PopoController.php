<?php

//namespace App\E00Bundle;
namespace App\Controller\E00Bundle;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PopoController extends AbstractController
{
    /**
     * @Route("/annotation", name="annotation")
     */
    #[Route('/annotation', name: 'annotation')]
    public function helloFromAnnotation()
    {
        return new Response('Hello world! From Annotation');
    }

    #[Route('/attribute', name: 'attribute')]
    public function helloFromAttribute()
    {
        return new Response('Hello world! from Attribute');
    }
}

?>