<?php
include('./capital_city_from.php');
$states = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia',
    'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa',
    'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri',
    'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey',
    'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio',
    'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina',
    'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];

$fictitious_states = [
    "Atlantida",
    "Eldorado",
    "New Atlantis",
    "Pacifica",
    "Utopia",
    "Zephyria",
    "Avalonia",
    "Perdida",
    "Quivira",
    "Terra Nova"
];

// Boucle pour appeler capital_city_from pour chaque État
foreach ($states as $state) {
    echo $state . ': ' . capital_city_from($state) . PHP_EOL;
}
foreach ($fictitious_states as $fstate)
{
    echo $fstate . ': ' . capital_city_from($fstate) . PHP_EOL;
}
?>
