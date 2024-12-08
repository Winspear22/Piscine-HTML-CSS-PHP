<?php
// src/E00Bundle/Controller/FallbackController.php
namespace App\E00Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FallbackController extends AbstractController
{
    /**
     * Route de fallback qui va matcher toutes les URLs sauf /e00/firstpage
     */
    #[Route('/{catchall}', name: 'fallback', requirements: ['catchall' => '.*'])]
    public function fallback(): Response
    {
        // On force une 404 manuellement
        return new Response("404 Error, page not found!");
    }
}
?>