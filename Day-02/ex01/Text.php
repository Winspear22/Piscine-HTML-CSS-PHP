<?php

class Text
{
	// Tableau qui va conserver l'integralite des strings que l'on va append
	private $savedStrings = [];
	public function __construct(array $Tab)
	{
		$this->savedStrings = $Tab;
		print(COLOR_GREEN . 'Constructor Text called' . COLOR_RESET . PHP_EOL);
	}

	public function __destruct()
	{
		print(COLOR_BLUE . 'Destructor Text called' . COLOR_RESET . PHP_EOL);  
	}

	// Une simple methode setArrays, mais la consigne impose que l'on nomme ca append
	public function append(string $addedString)
	{
		$this->savedStrings[] = $addedString;
	}

	// Une simple methode ou l'on doit inserer le contenu de savedStrings entre deux balises <p></p>
	public function readData()
	{
		$html = '';
		foreach ($this->savedStrings as $string)
			$html .= '<p>' . $string . '</p>';
		return $html;
	}
}

?>