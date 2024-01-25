<?php
function array2hash($array)
{
    $hash = array(); // Il s'agit d'un tableau associatif, chaque clé (lâge) doit être unique, sinon, la valeur sera remplacée par l'itération qui aura le même âge
    //exemple : Pierre, 30 et Mary, 30, le tableau ne contiendra que Mary, 30 a lieu de Pierre et Mary
    $i = -1;
    while (++$i < count($array))
    {
        if (count($array[$i]) == 2)
            $hash[$array[$i][1]] = $array[$i][0]; // Assignation du nom à l'âge. $array[$i][0] est le name et $array[$i][1] est l'âge. On met le tout dans un tableau.
    } // age = clé et name = valeur
    return $hash;
}
?>