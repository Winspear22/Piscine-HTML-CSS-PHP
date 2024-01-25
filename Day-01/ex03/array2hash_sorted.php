<?php
function array2hash_sorted($array)
{
    $hash = array();
    $i = -1;
	usort($array, function($a, $b) // usort ne trie pas en lui même les arguments, c'est nous, via la fonction anonyme qui allons le lui indiquer.
    {
		return strcmp($b[0], $a[0]); // Si on nombre négatif est renvoyé en callback, alors usort va inverser les tableaux 
	}); // [0] correspond aux noms et [1] à l'age, c'est pour celaa qu'on met [0]   
	while (++$i < count($array))
    {
        if (count($array[$i]) == 2)
            $hash[$array[$i][0]] = $array[$i][1]; // On inverse l'assignation, c'est l'âge qui est assigné au nom (nom = clé, age = valeur)
    }
    return $hash;
}
?>