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

    public function getHTML($indentLevel = 0): string
    {
        $indent = str_repeat("\t", $indentLevel); // Crée une chaîne de tabulations en fonction du niveau d'indentation
        $html = "$indent<$this->element>\n"; // Ajoute une tabulation avant la balise et un saut de ligne après
    
        if ($this->content) {
            $html .= "$indent\t$this->content\n"; // Ajoute une tabulation supplémentaire pour le contenu
        }
    
        foreach ($this->allElements as $childElement) {
            $html .= $childElement->getHTML($indentLevel + 1); // Appel récursif avec un niveau d'indentation supérieur
        }
    
        $html .= "$indent</$this->element>\n"; // Ferme la balise avec le même niveau d'indentation
        return $html;
    }
    

}

?>