<?php

require_once 'TemplateEngine.php';
require_once 'MyException.php';

class Elem
{

	private $allElements = [];

    function __construct(
        public string $element = "",
        public string $content = "",
		public array $attributes = [],
    )
	{
		if (!in_array($element, ['meta', 'img', 'hr', 'br', 'html', 'head', 'body', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div',
		'table', 'tr', 'th', 'td', 'ul', 'ol', 'li'])) 
		{
            throw new MyException("Invalid HTML element: $element\n");
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

    public function getHTML($indentLevel = 0): string
    {
        $indent = str_repeat("\t", $indentLevel); // Crée une chaîne de tabulations en fonction du niveau d'indentation
        $html = "$indent<{$this->element}{$this->getAttributeString()}>\n"; // Ajoute une tabulation avant la balise et un saut de ligne après

        if ($this->content) {
            $html .= "$indent\t$this->content\n"; // Ajoute une tabulation supplémentaire pour le contenu
        }

        foreach ($this->allElements as $childElement) {
            $html .= $childElement->getHTML($indentLevel + 1); // Appel récursif avec un niveau d'indentation supérieur
        }

        $html .= "$indent</$this->element>\n"; // Ferme la balise avec le même niveau d'indentation
        return $html;
    }

	private function getAttributeString(): string {
        $attrString = '';
        foreach ($this->attributes as $key => $value) {
            $attrString .= " $key=\"$value\"";
        }
        return $attrString;
    }
}

?>