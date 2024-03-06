<?php 

function capital_city_from($userInput, $InitialuserInput, $states, $capitals)
{
    // Inverser le tableau des États pour avoir les abréviations comme clés
    $reversedStates = array_flip($states);

    // Vérifier si l'entrée est un nom d'État

    if (isset($states[$userInput])) 
	{
        // Trouver la capitale correspondant à l'État
        $abbreviation = $states[$userInput];
        if (isset($capitals[$abbreviation]))
            echo $capitals[$abbreviation] . " is the capital of " . $InitialuserInput . ".\n";
        else
            echo "No capital found for " . $InitialuserInput . ".\n";
    	// Vérifier si l'entrée est une capitale
    } 
	elseif (in_array($userInput, $capitals))
	{
        // Trouver le nom complet de l'État correspondant à la capitale
        $stateName = array_search($userInput, $capitals);
        if ($stateName !== false) {
            echo $InitialuserInput . " is the capital of " . array_search($stateName, $states) . ".\n";
        } else {
            echo "The state for the capital " . $InitialuserInput . " was not found.\n";
        }
    } 
	elseif (isset($capitals[$userInput])) 
	{
        $stateName = $reversedStates[$userInput];
        echo $capitals[$userInput] . " is the capital of " . $stateName . ".\n";
    }
	else
        echo $InitialuserInput . " is neither a capital nor a state.\n";
}



function search_by_states($userInput)
{
    if (empty($userInput)) 
	{
        echo "No input provided.\n";
        return;
    }

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
		'Wyoming' => 'WY'
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
    
    $cleanInput = preg_replace('/\s*,\s*/', ',', trim($userInput));
    $inputs = array_filter(explode(",", $cleanInput), function($value) {
        return $value !== '';
    });

    foreach ($inputs as $string) 
	{
        if (strlen($string) <= 2) 
            $formattedInput = strtoupper($string);
		else
            $formattedInput = ucfirst($string); // Met la première lettre en majuscule
        capital_city_from($formattedInput, $string, $states, $capitals);
    }
}

?>