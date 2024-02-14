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
	<td class='element'>
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
    echo "Opening of the file successful !";
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