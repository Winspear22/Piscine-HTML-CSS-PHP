<?php
	$a = 10; // Pour forcer à être un entier, il aurait fallu écrire $a = (int) 10; Pareil pour les lignes en bas.
	$b = "10";
    $c = "ten";
    $d = 10.0;
    echo "My first variables:" . PHP_EOL;
    echo "a contains : " . $a . " and has type : " . gettype($a) . PHP_EOL;
    echo "b contains : " . $b . " and has type : " . gettype($b) . PHP_EOL;
    echo "c contains : " . $c . " and has type : " . gettype($c) . PHP_EOL;
    echo "d contains : " . $d . " and has type : " . gettype($d) . PHP_EOL;
?>