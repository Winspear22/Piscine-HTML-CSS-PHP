<?php

namespace App\E03Bundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class E03Controller extends AbstractController
{
    /**
     * @Route("/e03", name="e03_colors")
     */
    public function colors(): Response
    {
        // Récupérer le nombre de nuances
        $numberOfColors = $this->getParameter('e03.number_of_colors');
        if ($numberOfColors > 100 || $numberOfColors <= 0)
        {
            return new Response(
                '<html><body><h1>Wrong number (cannot be higher than 100 or equal or lower than 0).</h1></body></html>',
                Response::HTTP_NOT_FOUND
            );
        }

        // Couleurs cibles en hexadécimal (sans "#")
        $targetColors = [
            'black' => '000000',
            'red' => 'FF0000',
            'blue' => '0000FF',
            'green' => '00FF00'
        ];

        $shades = [];
        
        foreach ($targetColors as $colorName => $hex) {
            // Extraire R, G, B de la couleur cible
            $rTarget = hexdec(substr($hex, 0, 2));
            $gTarget = hexdec(substr($hex, 2, 2));
            $bTarget = hexdec(substr($hex, 4, 2));

            $colorShades = [];
            for ($i = 0; $i < $numberOfColors; $i++) {
                $t = $numberOfColors > 1 ? $i / ($numberOfColors - 1) : 0; 
                // t va de 0 à 1

                $r = (int) round(255 + ($rTarget - 255) * $t);
                $g = (int) round(255 + ($gTarget - 255) * $t);
                $b = (int) round(255 + ($bTarget - 255) * $t);

                // Convertir en hex
                $rHex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
                $gHex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
                $bHex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

                $colorShades[] = "#{$rHex}{$gHex}{$bHex}";
            }

            $shades[$colorName] = $colorShades;
        }

        // Transmettre les données au template
        // $shades est un tableau associatif : clé = couleur, valeur = tableau de hex
        return $this->render('colors.html.twig', [
            'shades' => $shades,
            'colors' => array_keys($shades), // ['black', 'red', 'blue', 'green']
            'number_of_colors' => $numberOfColors,
        ]);
    }
}
?>