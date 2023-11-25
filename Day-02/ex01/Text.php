<?php

class Text
{
	private $string = [];
    function __construct(array $kwargs)
    {
        print(COLOR_GREEN . 'Constructor Text called' . COLOR_RESET . PHP_EOL);
		$this->string = $kwargs;
	}

    function __destruct()
    {
        print(COLOR_BLUE . 'Destructor Text called' . COLOR_RESET . PHP_EOL);
    }

	public function append(string $appendString)
	{
		$this->string[] = $appendString;
	}

	public function readData()
	{
		$html = '';
        foreach ($this->string as $stringElement)
            $html .= "<p>$stringElement</p>";
        return $html;
	}
}

?>