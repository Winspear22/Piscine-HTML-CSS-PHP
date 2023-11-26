<?php

require_once 'TemplateEngine.php';

class Elem
{

	private $allElements = [];

    function __construct(
        public string $element,
        public string $content,
    )
	{
		if (!in_array($element, ['meta', 'img', 'hr', 'br', 'html', 'head', 'body', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div'])) 
		{
            throw new Exception("Invalid HTML element: $element");
        }

        $this->element = $element;
        $this->content = $content;
		print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);

	}

	function __destruct()
	{
		print(COLOR_YELLOW . 'Destructor Elem called' . COLOR_RESET . PHP_EOL);
	}

	public function pushElement(Elem $elemPart)
	{
		$this->allElements[] = $elemPart;
	}

    public function getHTML(): string
    {
        $html = "<$this->element>";
        if ($this->content) {
            $html .= $this->content;
        }

        foreach ($this->allElements as $childElement) {
            $html .= $childElement->getHTML();
        }

        $html .= "</$this->element>";
        return $html;
    }

}

?>