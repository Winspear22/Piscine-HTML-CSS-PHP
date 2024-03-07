<?php

include('./search_by_states.php');
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m--------------42 EXAMPLES--------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
search_by_states("Oregon, trenton, Topeka, NewJersey");

echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m------------ADALOUI EXAMPLES------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
search_by_states("Oregon, NJ, topeka, NewJersey, ca, or, New York");
search_by_states("CA, NY, OR, AZ, Dover");

?>