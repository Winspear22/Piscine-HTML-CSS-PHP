<?php
include('./array2hash.php');
$adaloui_array = array(
    array("Pierre","30"), 
    array("Mary","28"),
    array("John","25"),
    array("Jane","28"), // Notez que Jane a le même âge que Mary, donc Mary sera remplacée par Jane dans le résultat final
    array("Mark","35"),
    array("Lucy","30"), // Lucy a le même âge que Pierre, Pierre sera remplacé par Lucy dans le résultat final
    array("Paul","20"),
    array("Simon","40"),
    array("Lisa","25") // Notez que Lisa a le même âge que John, donc John sera remplacé par Lisa dans le résultat final
);

print_r(array2hash($adaloui_array));

//EXEMPLE SUJET 42 :
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m--------------42 EXAMPLES--------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
$array = array(array("Pierre","30"), array("Mary","28"));
print_r ( array2hash($array) );

?>

