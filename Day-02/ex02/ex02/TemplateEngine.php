<?php
define("COLOR_RED", "\033[31m");
define("COLOR_GREEN", "\033[32m");
define("COLOR_YELLOW", "\033[33m");
define("COLOR_BLUE", "\033[34m");
define("COLOR_MAGENTA", "\033[35m");
define("COLOR_CYAN", "\033[36m");
define("COLOR_RESET", "\033[0m");

require_once 'HotBeverage.php';

class TemplateEngine
{
    public function __construct()
    {
        print(COLOR_GREEN . 'Constructor TemplateEngine called' . COLOR_RESET . PHP_EOL);
    }

    public function __destruct()
    {
		print(COLOR_BLUE . 'Destructor TemplateEngine called' . COLOR_RESET . PHP_EOL);  
    }

	public function createFile(HotBeverage $text)
	{
		try
		{
			$templateContent = file_get_contents('template.html');
			if ($templateContent === false)
                throw new Exception("Unable to read template.html");
			$reflectionClass = new ReflectionClass(get_class($text));
			//echo $reflectionClass->getProperties();
			foreach ($reflectionClass->getProperties() as $properties)
				echo $properties;
			/*$ret = file_put_contents("HotBeverage.html", $templateContent); 
			if ($ret === false)
				throw new Exception("Unable to write to HotBeverage.html");
		*/
		}
		catch (Exception $e)
		{
            echo COLOR_RED . "Error: " . $e->getMessage() . COLOR_RESET . PHP_EOL;
		}
	}

}
?>
