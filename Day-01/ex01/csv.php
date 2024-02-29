<?php
$filename = "ex01.txt";
$file = fopen($filename, "r");
    if ($file)
    {
        $i = -1;
        $content = fread($file, filesize($filename));
        $result = explode(",", $content);
        while (++$i < count($result)) 
        {
            $resultTrimmed = trim($result[$i]); // Supprime les espaces blancs autour de la chaîne
            if (!empty($resultTrimmed)) // Vérifie si la chaîne est non vide
                echo $resultTrimmed . PHP_EOL;
        }
        fclose($file);
    }
    else
        echo "Error, could not open file ex01.txt.";
?>