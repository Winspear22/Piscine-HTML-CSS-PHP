<?php
include('./array2hash_sorted.php');

// Votre tableau avec les données
$adaloui_array = array(
    array("Pierre","30"), 
    array("Mary","28"),
    array("John","25"),
    array("Jane","28"), // Jane remplacera Mary
    array("Mark","35"),
    array("Lucy","30"), // Lucy remplacera Pierre
    array("Paul","20"),
    array("Simon","40"),
    array("Lisa","25"), // Lisa remplacera John
    array("Nelly", "22") // Ajout de Nelly
);

// Affichage avec couleurs des titres et des résultats
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m------------ADALOUI EXAMPLES------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;

// Appel de votre fonction sur le tableau et affichage du résultat
print_r(array2hash_sorted($adaloui_array));

// S'il y a besoin d'autres exemples ou d'une séparation visuelle
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m--------------42 EXAMPLES--------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;

// Autre appel de fonction pour démonstration ou comparaison
$array = array(array("Pierre","30"), array("Mary","28"), array("Nelly", "22"));
print_r(array2hash_sorted($array));
?>
