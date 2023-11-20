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
            echo $result[$i];
            if ($i <= count($result) - 2)
                echo PHP_EOL;
        }
        fclose($file);
    }
    else
        echo "Error, could not open file ex01.txt.";
?>