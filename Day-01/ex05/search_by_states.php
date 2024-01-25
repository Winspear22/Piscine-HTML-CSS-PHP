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
		'AL' => 'Montgomery',
		'AK' => 'Juneau',
		'AZ' => 'Phoenix',
		'AR' => 'Little Rock',
		'CA' => 'Sacramento',
		'CO' => 'Denver',
		'CT' => 'Hartford',
		'DE' => 'Dover',
		'FL' => 'Tallahassee',
		'GA' => 'Atlanta',
		'HI' => 'Honolulu',
		'ID' => 'Boise',
		'IL' => 'Springfield',
		'IN' => 'Indianapolis',
		'IA' => 'Des Moines',
		'KS' => 'Topeka',
		'KY' => 'Frankfort',
		'LA' => 'Baton Rouge',
		'ME' => 'Augusta',
		'MD' => 'Annapolis',
		'MA' => 'Boston',
		'MI' => 'Lansing',
		'MN' => 'Saint Paul',
		'MS' => 'Jackson',
		'MO' => 'Jefferson City',
		'MT' => 'Helena',
		'NE' => 'Lincoln',
		'NV' => 'Carson City',
		'NH' => 'Concord',
		'NJ' => 'Trenton',
		'NM' => 'Santa Fe',
		'NY' => 'Albany',
		'NC' => 'Raleigh',
		'ND' => 'Bismarck',
		'OH' => 'Columbus',
		'OK' => 'Oklahoma City',
		'OR' => 'Salem',
		'PA' => 'Harrisburg',
		'RI' => 'Providence',
		'SC' => 'Columbia',
		'SD' => 'Pierre',
		'TN' => 'Nashville',
		'TX' => 'Austin',
		'UT' => 'Salt Lake City',
		'VT' => 'Montpelier',
		'VA' => 'Richmond',
		'WA' => 'Olympia',
		'WV' => 'Charleston',
		'WI' => 'Madison',
		'WY' => 'Cheyenne'
	];

function capital_letters($array): array
{
    $final_strings = [];

    foreach ($array as $input) 
	{
        $final_string = strtolower($input);
        $final_string = ucfirst($final_string);
        $final_strings[] = $final_string;
    }
	return $final_strings;
}

function capital_city_from($userInput)
{
	global $states, $capitals;
	if (isset($states[$userInput]))
	{
		$abbreviation = $states[$userInput];
		if (isset($capitals[$abbreviation]))
			echo $capitals[$abbreviation] . " is the capital of " . $userInput . "." . PHP_EOL;
	}
	else if (isset($capitals[$userInput]))
		return $capitals[$userInput] . "\n";
	else
		echo $userInput . " is neither a capital nor a state." . PHP_EOL;
}

function search_by_states($userInput)
{
    $cleanInput = preg_replace('/\s*,\s*/', ',', trim($userInput));
    $inputs = array_filter(explode(",", $cleanInput), function($value) {
        return $value !== '';
    });
	$userInputsArray = capital_letters($inputs);

    $i = -1;
    $inputsCount = count($userInputsArray);

	foreach ($userInputsArray as $string)
	{
		$formattedInput = str_replace(' ', '', $string);
		capital_city_from($formattedInput);
		/*if (isset($capitals[$formattedInput]))
			echo $capitals[$formattedInput] . " is the capital of " . $formattedInput . "." . PHP_EOL;
		else
			echo $formattedInput . " is neither a capital nor a state." . PHP_EOL;*/
	}
}
?>