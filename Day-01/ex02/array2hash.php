<?php
function array2hash($array)
{
    $hash = array();
    $i = -1;
    while (++$i < count($array))
    {
        if (count($array[$i]) == 2)
            $hash[$array[$i][1]] = $array[$i][0];
    }
    return $hash;
}
?>