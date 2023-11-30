<?php

require_once 'HotBeverage.php';

class Tea extends HotBeverage
{
	function __construct(
        private string $description,
        private string $comment,
    ) 
    {
		parent::__construct('Tea', 2.5, 1);

        print(COLOR_YELLOW . 'Constructor Tea called' . COLOR_RESET . PHP_EOL);
		$this->description = $description;
        $this->comment = $comment;
	}

	function __destruct()
    {
        print(COLOR_YELLOW . 'Destructor Tea called' . COLOR_RESET . PHP_EOL);
		parent::__destruct();

    }

	public function getdescription()
	{
		return $this->description;
	}

	public function getcomment()
	{
		return $this->comment;
	}
}

?>