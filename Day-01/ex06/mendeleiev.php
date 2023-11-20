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

$filename = "ex06.txt";
$file = fopen($filename, "r") or die("Unable to open file.");
if ($file)
{
    $elements = [];
    while (($line = fgets($file)) !== false) 
    {
        $elements[] = sort_string($line);
    }
    fclose($file);
    
    $htmlContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Mendeleïev</title>
    <style>
        .titre {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        .periodic-table {
            display: grid;
            grid-template-columns: repeat(18, 70px);
            grid-template-rows: repeat(7, 70px);
            gap: 2px;
            margin-bottom: 20px;
        }

        .element {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 70px;
            height: 70px;
            border: 1px solid #000;
            font-size: 0.8em;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h4 class="titre">Le tableau de Mendeleïev</h4>
    <div class="periodic-table">';

    foreach ($elements as $element) {
        $position = $element[1]; // Assuming the second item is the 'position'
        $htmlContent .= '<div class="element" style="grid-column: ' . $position . ';">
        ';
        $htmlContent .= '<div>' . $element[0] . '</div>
        '; // Name of the element
        $htmlContent .= '<div>No ' . $element[2] . '</div>
        '; // Number
        $htmlContent .= '<div>' . $element[3] . '</div>
        '; // Symbol
        $htmlContent .= '<div>' . $element[4] . '</div>'; // Molar mass
        $htmlContent .= '</div>';
    }

    $htmlContent .= '
    </div>
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
