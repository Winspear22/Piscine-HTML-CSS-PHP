<?php

require_once 'HotBeverage.php';

class Coffee extends HotBeverage
{
	private $description;
	private $comment;

    public function __construct(string $name, float $price, int $resistance, string $description, string $comment)
	{
		// On appelle le constructeur de la classe parent, l'appel se fait automatiquement, mais c'est une bonne pratique
        parent::__construct($name, $price, $resistance);
		$this->description = $description;
		$this->comment = $comment;
        print(COLOR_YELLOW . 'Constructor Coffee called' . COLOR_RESET . PHP_EOL);
	}

	public function __destruct()
	{
		// Pareil pour le destructeur
		parent::__destruct();
        print(COLOR_YELLOW . 'Destructor Coffee called' . COLOR_RESET . PHP_EOL);
	}

	// De simples getters
	public function getDescription()
	{
		return $this->description;
	}

	public function getComment()
	{
		return $this->comment;
	}
}

?>