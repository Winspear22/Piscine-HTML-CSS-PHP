<?php

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
		<div>
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
	$currentPosition = 0;
	$htmlContent = '<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tableau de Mendeleïev</title>
		<style>
			table 
			{
				border-collapse: separate;
				border-spacing: 5px;
				margin: 20px auto;
			}

			td, th 
			{
				border-radius: 5px;
				box-shadow: 0 0 5px rgba(0,0,0,0.2);
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
		</style>
	</head>
	<body>';
	$htmlContent .= '<table>';
	foreach ($lines as $lineElements)
	{
		if ($currentPosition == 0)
			$htmlContent .= '<tr>';
		$expectedPosition = $lineElements[1];
		while ($currentPosition < $expectedPosition) 
		{
			$htmlContent .= "<td class='emptyElement'></td>";
			$currentPosition++;
		}
		$htmlContent .= getArrayElement($lineElements);
		if ($currentPosition >= 17) 
		{
			$htmlContent .= '</tr>';
			$currentPosition = 0;
		} 
		else 
		{
			$currentPosition++;
		}
	}
	$javascript = "
		<script>
			document.addEventListener('DOMContentLoaded', function () 
			{
    			document.querySelectorAll('.element').forEach(function(element) 
				{
        			var number = element.getAttribute('data-number');
        			if (number) 
					{
            			// Remplacez par votre logique de classification
            			if (number == 3 || number == 11 || number == 19 || number == 37 || number == 55 || number == 87) 
                			element.classList.add('alcalins');
						else if (number == 4 || number == 12 || number == 20 || number == 38 || number == 56 || number == 88)
                			element.classList.add('alcalino-terreux');
						else if ((number >= 21 && number <= 29) || (number >= 39 && number <= 47) || (number >= 72 && number <= 79)
						|| (number >= 104 && number <= 108) || number == 112)
						{
							element.classList.add('métaux-de-transition');
						}

            			// Ajoutez d'autres conditions ici
        			}
    			});
			});
		</script>";
	$htmlContent .= $javascript;
	$htmlContent .= '
			</table>
		</body>
	</html>';
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