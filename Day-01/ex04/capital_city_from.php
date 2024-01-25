<?php 
function capital_city_from($userInput)
{
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
	if (isset($states[$userInput]))
	{
		$abreviation = $states[$userInput];
		if (isset($capitals[$abreviation]))
			return $capitals[$abreviation] . "\n";
	}
	else if (isset($capitals[$userInput]))
		return $capitals[$userInput] . "\n";
	else
		return "Unknown\n";
}
?>
