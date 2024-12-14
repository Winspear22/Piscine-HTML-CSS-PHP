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
        if ($numberOfColors === null || $numberOfColors > 100 || $numberOfColors <= 0) {
            // Retourne une vue d'erreur si le paramètre est invalide
            return $this->render('error.html.twig', [
                'message' => 'Wrong number (cannot be higher than 100 or equal or lower than 0).',
            ]);
        }

        // Couleurs cibles en hexadécimal (sans "#")
        // Clé = nom de la couleur, Valeur = code hexadécimal de la couleur
        $targetColors = [
            'black' => '000000',
            'red' => 'FF0000',
            'blue' => '0000FF',
            'green' => '00FF00'
        ];

        // Tableau pour stocker les nuances générées pour chaque couleur
        $shades = [];

        // Parcourt chaque couleur cible dans le tableau $targetColors
        foreach ($targetColors as $colorName => $hex) 
        {
            // $colorName contient le nom de la couleur (exemple : 'red')
            // $hex contient le code hexadécimal de la couleur (exemple : 'FF0000')

            // Convertit la chaîne hexadécimale en valeurs décimales pour R, G et B
            list($rTarget, $gTarget, $bTarget) = sscanf($hex, "%02x%02x%02x");
        
            // $rTarget : composante rouge cible (exemple : 255 pour 'FF')
            // $gTarget : composante verte cible (exemple : 0 pour '00')
            // $bTarget : composante bleue cible (exemple : 0 pour '00')
        
            // Initialise un tableau pour stocker les nuances calculées pour la couleur actuelle
            $colorShades = [];
        
            // Compteur pour la boucle while
            $i = 0;
        
            // Boucle qui génère les nuances pour la couleur actuelle
            while ($i < $numberOfColors) 
            {
                // $t représente la position actuelle dans le dégradé (de 0 à 1)
                $t = 0;
                if ($numberOfColors > 1) 
                {
                    $t = $i / ($numberOfColors - 1);
                }
            
                // Calcule la composante rouge (R) interpolée entre blanc (255) et $rTarget
                $r = (int) round(255 + ($rTarget - 255) * $t);
            
                // Calcule la composante verte (G) interpolée entre blanc (255) et $gTarget
                $g = (int) round(255 + ($gTarget - 255) * $t);
            
                // Calcule la composante bleue (B) interpolée entre blanc (255) et $bTarget
                $b = (int) round(255 + ($bTarget - 255) * $t);
            
                // Formate les composantes R, G et B en une chaîne hexadécimale
                $colorShades[] = sprintf("#%02x%02x%02x", $r, $g, $b);
            
                // Incrémente le compteur pour passer à la nuance suivante
                $i++;
            }
        
            // Associe le tableau des nuances générées ($colorShades) au nom de la couleur actuelle ($colorName)
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