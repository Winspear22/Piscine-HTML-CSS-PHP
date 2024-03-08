<?php

require_once 'TemplateEngine.php';

class HotBeverage
{
	protected $nom;
	protected $price;
	protected $resistance;

    public function __construct(string $name, float $price, int $resistance)
	{
		$this->nom = $name;
        $this->price = $price;
        $this->resistance = $resistance;
        print(COLOR_MAGENTA . 'Constructor HotBeverage called' . COLOR_RESET . PHP_EOL);
	}

	public function __destruct()
	{
        print(COLOR_MAGENTA . 'Destructor HotBeverage called' . COLOR_RESET . PHP_EOL);
	}

	public function getNom()
	{
		return $this->nom;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getResistance()
	{
		return $this->resistance;
	}
}

?>