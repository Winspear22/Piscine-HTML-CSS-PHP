<?php

require_once 'TemplateEngine.php';

class MyException extends Exception 
{
    function __construct($message = "Message par défaut.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        print(COLOR_RED . 'Constructor MyException called' . COLOR_RESET . PHP_EOL);
    }

    function __destruct() 
	{
        print(COLOR_RED . 'Destructor MyException called' . COLOR_RESET . PHP_EOL);
    }
}


?>