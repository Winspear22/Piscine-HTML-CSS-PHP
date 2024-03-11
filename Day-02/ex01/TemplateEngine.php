<?php
define("COLOR_RED", "\033[31m");
define("COLOR_GREEN", "\033[32m");
define("COLOR_YELLOW", "\033[33m");
define("COLOR_BLUE", "\033[34m");
define("COLOR_MAGENTA", "\033[35m");
define("COLOR_CYAN", "\033[36m");
define("COLOR_RESET", "\033[0m");

require_once 'Text.php';

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

	public function createFile(string $fileName, Text $text)
	{
		try
		{
			$file = fopen($fileName, "x+");
			if ($file === false)
				throw new Exception("Unable to open file: $fileName, the file already exists !");
			$fileContent = $text->readData();
			fwrite($file, $fileContent);
			fclose($file);
 
		}
		catch (Exception $e)
		{
            echo COLOR_RED . "Error: " . $e->getMessage() . COLOR_RESET . PHP_EOL;
		}
	}

}


?>
