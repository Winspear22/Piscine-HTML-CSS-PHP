<?php

require_once 'HotBeverage.php';

class Tea extends HotBeverage
{
	private $description;
	private $comment;

    public function __construct(string $name, float $price, int $resistance, string $description, string $comment)
	{
        parent::__construct($name, $price, $resistance);
		$this->description = $description;
		$this->comment = $comment;
        print(COLOR_CYAN . 'Constructor Tea called' . COLOR_RESET . PHP_EOL);
	}

	public function __destruct()
	{
		parent::__destruct();
        print(COLOR_CYAN . 'Destructor Tea called' . COLOR_RESET . PHP_EOL);
	}

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