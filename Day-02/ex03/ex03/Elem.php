<?php

require_once 'TemplateEngine.php';

class Elem
{
    public string   	$element;
    public string  		$content;
    private array		$allElements = [];
    private static int 	$indentLevel = 0; // Sert a gerer le niveau d'identation pour gerer les tabulations

    public function __construct(string $element, string $content)
    {
		if (!in_array($element, ['meta', 'img', 'hr', 'br', 'html', 'head', 'body', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div']))
			throw new Exception("Invalid HTML element: $element");
        $this->element = $element;
        $this->content = $content;
        print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
    }

    public function __destruct()
    {
        print(COLOR_YELLOW . 'Constructor Elem called' . COLOR_RESET . PHP_EOL);
    }

    public function pushElement(Elem $newElement)
    {
		$this->allElements[] = $newElement;
    }

	private function getIndentation(): string
    {
        return str_repeat("\t", static::$indentLevel); // Génère l'indentation
    }

	public function getHTML()
	{
		$indent = static::getIndentation(); // On veut savoir le niveau d'identation, avec une string remplie d'identation ou vide
		// On assigne la balise avec le niveau d'identation
		// Pour les balises auto-fermantes, on ne rajoute pas de balise fermante.
		if (in_array($this->element, ['img', 'meta', 'br', 'hr'])) 
		{
			$html = "$indent<$this->element";
			if (!empty($this->content)) 
				$html .= " " . $this->content; // Ajouter le contenu comme attribut pour les balises autofermantes
			$html .= " />\n"; // Fermeture autofermante pour les balises spécifiques
		} 
		else // Ce n'est pas une balise auto-fermante
		{
			$html = "$indent<$this->element>\n"; // Début de la balise pour les autres éléments
			if (!empty($this->content)) 
			{
				$html .= $indent . "\t" . $this->content . "\n"; // Si le contenu de la balise n'est pas vide
			}
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
}

?>