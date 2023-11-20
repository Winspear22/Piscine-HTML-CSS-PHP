<?php
function array2hash_sorted($array)
{
    $hash = array();
    $i = -1;
	usort($array, function($a, $b) {
		return strcmp($b[0], $a[0]);
	});    
	while (++$i < count($array))
    {
        if (count($array[$i]) == 2)
            $hash[$array[$i][0]] = $array[$i][1];
    }
    return $hash;
}
?>