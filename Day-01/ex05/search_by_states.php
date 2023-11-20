<?php 
$states = [
	'Alabama' => 'AL',
	'Alaska' => 'AK',
	'Arizona' => 'AZ',
	'Arkansas' => 'AR',
	'California' => 'CA',
	'Colorado' => 'CO',
	'Connecticut' => 'CT',
	'Delaware' => 'DE',
	'Florida' => 'FL',
	'Georgia' => 'GA',
	'Hawaii' => 'HI',
	'Idaho' => 'ID',
	'Illinois' => 'IL',
	'Indiana' => 'IN',
	'Iowa' => 'IA',
	'Kansas' => 'KS',
	'Kentucky' => 'KY',
	'Louisiana' => 'LA',
	'Maine' => 'ME',
	'Maryland' => 'MD',
	'Massachusetts' => 'MA',
	'Michigan' => 'MI',
	'Minnesota' => 'MN',
	'Mississippi' => 'MS',
	'Missouri' => 'MO',
	'Montana' => 'MT',
	'Nebraska' => 'NE',
	'Nevada' => 'NV',
	'New Hampshire' => 'NH',
	'New Jersey' => 'NJ',
	'New Mexico' => 'NM',
	'New York' => 'NY',
	'North Carolina' => 'NC',
	'North Dakota' => 'ND',
	'Ohio' => 'OH',
	'Oklahoma' => 'OK',
	'Oregon' => 'OR',
	'Pennsylvania' => 'PA',
	'Rhode Island' => 'RI',
	'South Carolina' => 'SC',
	'South Dakota' => 'SD',
	'Tennessee' => 'TN',
	'Texas' => 'TX',
	'Utah' => 'UT',
	'Vermont' => 'VT',
	'Virginia' => 'VA',
	'Washington' => 'WA',
	'West Virginia' => 'WV',
	'Wisconsin' => 'WI',
	'Montana' => 'MT',
	'Nebraska' => 'NE',
	'Nevada' => 'NV',
	'New Hampshire' => 'NH',
	'New Jersey' => 'NJ',
	'New Mexico' => 'NM',
	'New York' => 'NY',
	'North Carolina' => 'NC',
	'North Dakota' => 'ND',
	'Ohio' => 'OH',
	'Oklahoma' => 'OK',
	'Oregon' => 'OR',
	'Pennsylvania' => 'PA',
	'Rhode Island' => 'RI',
	'South Carolina' => 'SC',
	'South Dakota' => 'SD',
	'Tennessee' => 'TN',
	'Texas' => 'TX',
	'Utah' => 'UT',
	'Vermont' => 'VT',
	'Virginia' => 'VA',
	'Washington' => 'WA',
	'West Virginia' => 'WV',
	'Wisconsin' => 'WI',
	'Wyoming' => 'WY',
];

$capitals = [
	'Alabama' => 'Montgomery',
	'Alaska' => 'Juneau',
	'Arizona' => 'Phoenix',
	'Arkansas' => 'Little Rock',
	'California' => 'Sacramento',
	'Colorado' => 'Denver',
	'Connecticut' => 'Hartford',
	'Delaware' => 'Dover',
	'Florida' => 'Tallahassee',
	'Georgia' => 'Atlanta',
	'Hawaii' => 'Honolulu',
	'Idaho' => 'Boise',
	'Illinois' => 'Springfield',
	'Indiana' => '	Indianapolis',
	'Iowa' => 'Des Moines',
	'Kansas' => 'Topeka',
	'Kentucky' => 'Frankfort',
	'Louisiana' => 'Baton Rouge',
	'Maine' => 'Augusta',
	'Maryland' => 'Annapolis',
	'Massachusetts' => 'Boston',
	'Michigan' => 'Lansing',
	'Minnesota' => 'Saint Paul',
	'Mississippi' => 'Jackson',
	'Missouri' => 'Jefferson City',
    'Montana' => 'Helena',
    'Nebraska' => 'Lincoln',
    'Nevada' => 'Carson City',
    'New Hampshire' => 'Concord',
    'New Jersey' => 'Trenton',
    'New Mexico' => 'Santa Fe',
    'New York' => 'Albany',
    'North Carolina' => 'Raleigh',
    'North Dakota' => 'Bismarck',
    'Ohio' => 'Columbus',
    'Oklahoma' => 'Oklahoma City',
    'Oregon' => 'Salem',
    'Pennsylvania' => 'Harrisburg',
    'Rhode Island' => 'Providence',
    'South Carolina' => 'Columbia',
    'South Dakota' => 'Pierre',
    'Tennessee' => 'Nashville',
    'Texas' => 'Austin',
    'Utah' => 'Salt Lake City',
    'Vermont' => 'Montpelier',
    'Virginia' => 'Richmond',
    'Washington' => 'Olympia',
    'West Virginia' => 'Charleston',
    'Wisconsin' => 'Madison',
    'Wyoming' => 'Cheyenne',
];

function search_by_states($userInput)
{
    global $states, $capitals;
    $cleanInput = preg_replace('/\s*,\s*/', ',', trim($userInput));
    $inputs = array_filter(explode(",", $cleanInput), function($value) {
        return $value !== '';
    });

    $inputs = array_map('ucwords', array_map('strtolower', $inputs));

    $i = -1;
    $inputsCount = count($inputs);

    while (++$i < $inputsCount) 
    {
        $input = $inputs[$i];
        $formattedInput = str_replace(' ', '', $input);

        if (isset($capitals[$formattedInput]))
            echo $capitals[$formattedInput] . " is the capital of " . $formattedInput . "." . PHP_EOL;
        else
            echo $formattedInput . " is neither a capital nor a state." . PHP_EOL;
    }
}
?>