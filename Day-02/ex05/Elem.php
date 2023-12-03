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
        //print("Element : $element");
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
        //$this->displayAllElements();
        foreach ($this->allElements as $childElement) {
            $html .= $childElement->getHTML($indentLevel + 1); // Appel récursif avec un niveau d'indentation supérieur
        }
        if ($this->element != "meta")
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

	public function validPage(): bool
	{
		if ($this->element != 'html' || count($this->allElements) != 2) {
			return false;
		}
	
		if ($this->allElements[0]->element != 'head' || $this->allElements[1]->element != 'body') {
			return false;
		}
		$head = $this->allElements[0];
		$body = $this->allElements[1];
		$metaCount = 0;
		$titleCount = 0;
		$elseCount = 0;
	
		foreach ($head->allElements as $child) {
			if ($child->element == 'meta') {
				$metaCount++;
			} else if ($child->element == 'title') {
				$titleCount++;
			} else {
				$elseCount++;
			}
		}
	
		foreach ($body->allElements as $child) 
		{
			if ($child->element == 'p') 
			{
				foreach ($child->allElements as $pChild) 
				{
					if ($pChild instanceof Elem) 
						return false; // Balise <p> ne devrait contenir que du texte
				}
			}
	
			if (in_array($child->element, ["tr", "th", "td"])) 
			{
				return false; // Ces balises ne doivent pas être directement dans body
			}
	
			if ($child->element == "table") 
			{
				foreach ($child->allElements as $tableChild) 
				{
					if ($tableChild->element != "tr")
						return false; // Les enfants de table doivent être des tr
					foreach ($tableChild->allElements as $trChild) 
					{
						if (!($trChild->element == "th" || $trChild->element == "td"))
							return false; // Les enfants de tr doivent être des th ou td
					}
				}
			}

			if ($child->element == "ul" || $child->element == "ol")
			{
				foreach ($child->allElements as $listChild)
				{
					if ($listChild->element != "li")
						return false;
				}
			}
		}
	
		if ($metaCount != 1 || $titleCount != 1 || $elseCount != 0) {
			return false;
		}
		return true;
	}
	

    public function displayAllElements() {
        foreach ($this->allElements as $childElement) {
            echo "Element: " . $childElement->element . ", Content: " . $childElement->content . "\n";
            // Affiche également les attributs s'il y en a
            if (!empty($childElement->attributes)) {
                echo "Attributes: ";
                foreach ($childElement->attributes as $key => $value) {
                    echo "$key=\"$value\" ";
                }
                echo "\n";
            }
            // Appel récursif pour afficher les enfants des enfants
            $childElement->displayAllElements();
        }
    }
}

?>