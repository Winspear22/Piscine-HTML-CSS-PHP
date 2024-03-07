<?php
include('./capital_city_from.php');
$states = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia',
    'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa',
    'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'NY'
];

$fictitious_states = [
    "Atlantida",
    "Eldorado",
    "New Atlantis",
    "Pacifica",
    "Utopia"
];

// Boucle pour appeler capital_city_from pour chaque État
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m------------ADALOUI EXAMPLES------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;

foreach ($states as $state) {
    echo $state . ': ' . capital_city_from($state) . PHP_EOL;
}

echo "\033[1;33m=============================================\033[0m" . PHP_EOL;
echo "\033[1;32m------------ADALOUI FAKE EXAMPLES------------\033[0m" . PHP_EOL;
echo "\033[1;33m=============================================\033[0m" . PHP_EOL;


foreach ($fictitious_states as $fstate) {
    echo $fstate . ': ' . capital_city_from($fstate) . PHP_EOL;
}

echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo "\033[1;32m--------------42 EXAMPLES--------------\033[0m" . PHP_EOL;
echo "\033[1;33m=======================================\033[0m" . PHP_EOL;
echo capital_city_from('Oregon');
echo capital_city_from('Origan');
?>
