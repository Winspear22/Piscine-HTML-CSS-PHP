<?php
// src/E00Bundle/Controller/E00Controller.php
namespace App\E00Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class E00Controller
{
    #[Route('/e00/firstpage', name: 'e00_firstpage')]
    public function firstpage(): Response
    {
        return new Response("Hello world!");
    }
}

?>