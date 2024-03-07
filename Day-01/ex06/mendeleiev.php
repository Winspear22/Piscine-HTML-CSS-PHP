<?php
/* TROIS SPLIT
 - le split du =
 - le split de la ,
 - le split de :
pour n'obtenir que les infos et les caractéristiques de la string */
function sort_string($string): array
{
    $parts = explode(" = ", $string);
    $properties = [$parts[0]];
    $propertiesData = explode(", ", $parts[1]);
    $index = -1;
    
    while (++$index < count($propertiesData)) 
    {
        $keyValue = explode(":", $propertiesData[$index]);
        $value = trim($keyValue[1]);
        $properties[] = $value;
    }
    return $properties;
}

/* Permet de construire en HTML une cellule du tableau (td) */

function getArrayElement($lineElements): string
{
	$str;
	$name = $lineElements[0];
	$position = $lineElements[1];
	$number = $lineElements[2];
	$smallName = $lineElements[3];
	$molar = $lineElements[4];
	$electron = $lineElements[5];

	$str = "
	<td class='element' data-number='$number'>
		<div class='table_element'>
			<h4>$name</h4>
				<ul>
					<li>$position</li>
					<li>No $number</li>
					<li>$smallName</li>
					<li>$molar</li>
					<li>$electron</li>
				</ul>
		</div>
	</td>";
	return $str;
}


/* Début du code */
$filename = "ex06.txt";
$file = fopen($filename, "r");// or die("Unable to open file.");
if ($file)
{
    echo "Opening of the file successful !\n";
	$lines = [];
    while (($line = fgets($file)) !== false) 
	{
        $lines[] = sort_string($line);
    }
	fclose($file);
	$currentPosition = 0; // sert à connaître la position de l'élément dans le tableau pour laisser des espaces qd la case est vide
	$htmlContent = '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tableau de Mendeleïev</title>
		<style>
			table 
			{
				border-collapse: collapse;
				border-spacing: 5px;
				margin: 20px auto;
			}

			.emptyElement
			{

				border: 3px dashed black; 
			}

			.element, .emptyElement {
				width: 120px; /* Largeur fixe pour les cellules */
				height: 120px; /* Hauteur fixe pour les cellules */
			}

			.element
			{
				width: 200px;
				border: 3px solid black;
			}

			.table_element h4 
			{
				margin: 0;
				text-align: center; /* Centre horizontalement le titre dans la cellule */

			}

			h4
			{
				margin: 0;
				font-size: 1vw;
			}

			.alcalins
			{
				background-color: #FF6666; 
			}

			.alcalino-terreux
			{
				background-color: #FFDFAF;
			}

			.métaux-de-transition
			{
				background-color: #FFB7C2;
			}

			.métaux-pauvres
			{
				background-color: #D4D4D4;
			}

			.metalloides
			{
				background-color: #CDCD9A;
			}

			.autres-non-metaux
			{
				background-color: #99FB99;
			}

			.halogenes
			{
				background-color: #FFFF9A;
			}

			.gaz-nobles
			{
				background-color: #B0EFEF;
			}

			.non-classes
			{
				background-color: #F5F5F5;
				border: 3px dotted black;

			}

			.gaz h4
			{
				color: #F41A0E
			}

			.liquide h4
			{
				color: #0606FD;
			}

			.gaz-legend
			{
				font-weight: bold;
				color: #F41A0E
			}

			.liquid-legend
			{
				font-weight: bold;
				color: #0606FD
			}

			.solid-legend
			{
				font-weight: bold;
				color: #000;
			}

			ul 
			{
				list-style-type: none; /* Enlève les puces */
			}

			.legend
			{
				text-align: center;
				margin-top: 30px;
				border: 6px solid #000;
			}
						
			.legend-item
			{
				display: inline-block;
				margin: 5px;
				padding: 5px;
				border: 1px solid #000;
				border-radius: 5px;
			}

			.legend-item-non-classé
			{
				display: inline-block;
				margin: 5px;
				padding: 5px;
				border: 1px dotted #000;
				border-radius: 5px;
			}
		</style>
	</head>
	<body>';
	$htmlContent .= '<table>';
	foreach ($lines as $lineElements) // boucle pour parcourir mon tableau contenabnt toutes les infos
	{
		if ($currentPosition == 0)
			$htmlContent .= '<tr>';
		$expectedPosition = $lineElements[1];
		while ($currentPosition < $expectedPosition)  // boucle pour remplir la ligne d'éléments vides tant qu'on a pas atteint un élément
		{
			$htmlContent .= "
			<td class='emptyElement'>
			</td>";
			$currentPosition++;
		}
		$htmlContent .= getArrayElement($lineElements);
		if ($currentPosition >= 17) // La colonne max est 17. Du coup, si on a attenit 17 ou plus, il faut un retour à la ligne
		{
			$htmlContent .= '</tr>';
			$currentPosition = 0;
		} 
		else //Sinon, on progresse
		{
			$currentPosition++;
		}
	} // Colorisation des cases en fonction de l'appartenence familiale et couleur de la police
	$javascript = "
		<script>
			document.addEventListener('DOMContentLoaded', function () 
			{
    			document.querySelectorAll('.element').forEach(function(element) 
				{
        			var number = element.getAttribute('data-number');
        			if (number) 
					{
            			if (number == 3 || number == 11 || number == 19 || number == 37 || number == 55 || number == 87) 
                			element.classList.add('alcalins');
						else if (number == 4 || number == 12 || number == 20 || number == 38 || number == 56 || number == 88)
                			element.classList.add('alcalino-terreux');
						else if ((number >= 21 && number <= 29) || (number >= 39 && number <= 47) || (number >= 72 && number <= 79)
						|| (number >= 104 && number <= 108) || number == 112)
							element.classList.add('métaux-de-transition');
						else if (number == 13 || (number >= 30 && number <= 31) || (number >= 48 && number <= 50) || (number >= 80 && number <= 84))
							element.classList.add('métaux-pauvres');
						else if (number == 5 || number == 14 || (number >= 32 && number <= 33) || (number >= 51 && number <= 52) || number == 85)
							element.classList.add('metalloides');
						else if (number == 1 || (number >= 6 && number <= 8) || (number >= 15 && number <= 16) || number == 34)
							element.classList.add('autres-non-metaux');
						else if (number == 9 || number == 17 || number == 35 || number == 53)
                			element.classList.add('halogenes');
						else if (number == 2 || number == 10 || number == 18 || number == 36 || number == 54 || number == 86) 
                			element.classList.add('gaz-nobles');
						else if ((number >= 109 && number <= 111) || (number >= 113 && number <= 118))
							element.classList.add('non-classes');
						if (number == 1 || number == 2 || (number >= 7 && number <= 10) || number == 17 || number == 18 || number == 36
						|| number == 54 || number == 86)
							element.classList.add('gaz');
						if (number == 35 || number == 80)
							element.classList.add('liquide'); 
        			}
    			});
			});
		</script>";
	$htmlContent .= $javascript; // Inscription de la légende du tableau
	$legend = '
    <div class="legend">
        <h3>Légende</h3>
		<h4>Couleur du background</h4>
        <div class="legend-item alcalins"><span>Alcalins</span></div>
        <div class="legend-item alcalino-terreux"><span>Alcalino-terreux</span></div>
        <div class="legend-item métaux-de-transition"><span>Métaux de transition</span></div>
        <div class="legend-item métaux-pauvres"><span>Métaux pauvres</span></div>
        <div class="legend-item metalloides"><span>Métalloïdes</span></div>
        <div class="legend-item autres-non-metaux"><span>Autres non-métaux</span></div>
        <div class="legend-item halogenes"><span>Halogènes</span></div>
        <div class="legend-item gaz-nobles"><span>Gaz nobles</span></div>
        <div class="legend-item-non-classé non-classes"><span>Non classés</span></div>
		<h4>Couleur de la police</h4>
        <div class="legend-item gaz-legend"><span>Gaz (coloré en bleu)</span></div>
        <div class="legend-item liquid-legend"><span>Liquide (coloré en rouge)</span></div>
        <div class="legend-item solid-legend"><span>Solide (coloré en noir)</span></div>';

$legend .= '
        <h4>Description des informations</h4>
		<ul>
            <li><strong>Position :</strong> Emplacement sur la ligne</li>
        	<li><strong>No :</strong> Numéro atomique</li>
        	<li><strong>Nom court :</strong> Symbole chimique</li>
        	<li><strong>Masse molaire :</strong> Molarité de l\'élément</li>
        	<li><strong>Configuration électronique :</strong> Répartition des électrons</li>
    	</ul>
	</div>';
	$htmlContent .= $legend;
	$htmlContent .= '
			</table>
		</body>
	</html>'; // Fin du de la string, on va maintenant créer un fichier mendeleiev.html et y insérer le tout
	$htmlFile = fopen('mendeleiev.html', 'w');
    if (!$htmlFile) 
    {
        echo "Cannot open file for writing";
        exit;
    }
    fwrite($htmlFile, $htmlContent);
    fclose($htmlFile);
}
else
{
    echo "Error, could not open file ex06.txt.";
}
?>