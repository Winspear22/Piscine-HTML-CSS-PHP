<?php

require_once 'HotBeverage.php';

class Coffee extends HotBeverage
{
	function __construct(
        private string $description,
        private string $comment,
    ) 
    {
		parent::__construct('Coffee', 3.0, 3);

        print(COLOR_MAGENTA . 'Constructor Coffee called' . COLOR_RESET . PHP_EOL);
		$this->description = $description;
        $this->comment = $comment;
	}

	function __destruct()
    {

        print(COLOR_MAGENTA . 'Destructor Coffee called' . COLOR_RESET . PHP_EOL);
		parent::__destruct();

    }


	public function setDescription(string $descriptionSet)
	{
		$this->description = $descriptionSet;
	}

	public function getdescription()
	{
		return $this->description;
	}


	public function setComment(string $commentSet)
	{
		$this->comment = $commentSet;
	}

	public function getcomment()
	{
		return $this->comment;
	}
}

?>