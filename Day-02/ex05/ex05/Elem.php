<?php

require_once 'TemplateEngine.php';
require_once 'MyException.php';

class Elem
{
    public string   	$element;
    public string  		$content;
	public array		$attributes;
    private array		$allElements = [];
    private static int 	$indentLevel = 0; // Sert a gerer le niveau d'identation pour gerer les tabulations

    public function __construct(string $element = "", string $content = "", array $attributes = [])
    {
		if (!in_array($element, ['meta', 'img', 'hr', 'br', 'html', 'head', 
		'body', 'title', 'h1', 'h2', 'h3', 'h4', 
		'h5', 'h6', 'p', 'span', 'div', 'table', 'tr', 'th', 'td',
		'ul', 'ol', 'li']))
			throw new MyException($element, $content);
        $this->element = $element;
        $this->content = $content;
		$this->attributes = $attributes;
        //print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
    }

    public function __destruct()
    {
        //print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
    }

    public function pushElement(Elem $newElement)
    {
		$this->allElements[] = $newElement;
    }

	private function getIndentation(): string
    {
        return str_repeat("\t", static::$indentLevel); // Génère l'indentation
    }

	private function getAttributesAsString(): string
	{
		$attributesString = '';
		foreach ($this->attributes as $key => $value) {
			$attributesString .= $key . '="' . htmlspecialchars($value) . '" ';
		}
		return rtrim($attributesString);
	}

	public function getHTML()
	{
		//print_r($this->getAttributes());
		$indent = static::getIndentation(); // Get le niveau d'identation
		if (in_array($this->element, ['img', 'meta', 'br', 'hr'])) // POUR LES BALISES AUTO-FERMANTES
		{
			$html = "$indent<$this->element"; // Assignation du lvl d'identation + balise
			if (!empty($this->attributes))
				$html .= " " . $this->getAttributesAsString();
			if (!empty($this->content))
				$html .= " " . $this->content; // Ajouter le contenu comme attribut pour les balises autofermantes
			$html .= " />\n"; // Fermeture autofermante pour les balises spécifiques
		} 
		else // POUR LES BALISES A CONTENU
		{
			if (!empty($this->attributes))
			{
				$thisAttributes = $this->getAttributesAsString();
				$html = "$indent<$this->element $thisAttributes>\n";  // Assignation du lvl d'identation + balise
			}
			else
				$html = "$indent<$this->element>\n";  // Assignation du lvl d'identation + balise


			if (!empty($this->content)) 
				$html .= $indent . "\t" . $this->content . "\n"; // Ajouter le contenu comme attribut pour les balises a contenu en ajoutant le lvl d'identation
			foreach ($this->allElements as $childElement) 
			{
				static::$indentLevel++; // Augmenter le niveau d'indentation pour les enfants
				$html .= $childElement->getHTML();
				static::$indentLevel--; // Diminuer le niveau d'indentation après avoir traité l'enfant
			}
			$html .= "$indent</$this->element>\n"; // Balise fermante
		}
		return $html;
	}

	public function validPage(): bool
	{
		$headNumber = 0;
		$bodyNumber = 0;
		$htmlNumber = 0;
		$titleNumber = 0;
		$metaNumber = 0;
		if ($this->element !== 'html')
			return false;
		$htmlNumber = 1;
		foreach ($this->allElements as $elem) 
		{
			if (in_array($elem->element, ['html']))
				$htmlNumber++;
			if (in_array($elem->element, ['head']))
				$headNumber++;
			if (in_array($elem->element, ['body']))
				$bodyNumber++;
		}
		if ($htmlNumber != 1 || $headNumber != 1 || $bodyNumber != 1)
			return false;
		foreach ($this->allElements as $elem)
		{
			if (in_array($elem->element, ['head']))
			{
				foreach ($elem->allElements as $childElement)
				{
					if (in_array($childElement->element, ['title']))
						$titleNumber++;
					if (in_array($childElement->element, ['meta']))
						$metaNumber++;
				}
			}
			if (in_array($elem->element, ['body']))
			{
				foreach ($elem->allElements as $childElement)
				{
					if (in_array($childElement->element, ['title']))
						return false;
					if (in_array($childElement->element, ['meta']))
						return false;
				}
			}
		}
		if ($titleNumber != 1 || $metaNumber != 1)
			return false;
		// VERIFICATION DE P TABLE TR TD TH, UL OL ET LI
		foreach ($this->allElements as $elem)
		{
			if (in_array($elem->element, ['p']))
			{
				foreach ($elem->allElements as $childElement)
				{
					if ($pChild instanceof Elem) 
						return false; // Balise <p> ne devrait contenir que du texte
				}
			}
			if (in_array($elem->element, ["tr", "th", "td"])) 
				return false; // Ces balises ne doivent pas être directement dans body
			if (in_array($elem->element, ["table"]))
			{
				foreach ($elem->allElements as $childElement)
				{
					if ($childElement->element != "tr")
						return false;
					foreach ($childElement->allElements as $grandChildElement)
					{
						if (!($grandChildElement->element == "th" || $grandChildElement->element == "td"))
							return false; // Les enfants de tr doivent être des th ou td
					}
				}
			}
			if (in_array($elem->element, ["ul", "ol"]))
			{
				foreach ($elem->allElements as $childElement)
				{
					if ($childElement != "li")
						return false; // les enfants de ul et ol doivent etre li
				}
			}
		
		} 
		echo $htmlNumber . ' ' . $headNumber . ' ' . $bodyNumber . "\n";
		echo $titleNumber . ' ' . $metaNumber . ' ' . "\n";
		return true;
	}
}

?>