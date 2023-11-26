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
    function __construct()
    {
        print(COLOR_GREEN . 'Constructor TemplateEngine called' . COLOR_RESET . PHP_EOL);
    }

    function __destruct()
    {
        print(COLOR_BLUE . 'Destructor TemplateEngine called' . COLOR_RESET . PHP_EOL);
    }

    public function createFile(string $fileName, HotBeverage $beverage)
    {
        try 
        {
            $file = fopen($fileName, "x+");
            if ($file === false) 
			{
                throw new Exception("Unable to open file: $fileName, the file already exists !");
            }
			print(COLOR_CYAN . 'file created' . COLOR_RESET . PHP_EOL);
            $refClass = new ReflectionClass(get_class($beverage));
            //print($refClass);
            $templateContent = file_get_contents('template.html');

            foreach ($refClass->getProperties() as $property)
            {
                //print($property);
                $propertyName = $property->getName();
                $getter = 'get' . ucfirst($propertyName);
                //print($propertyName . PHP_EOL);
               //print($getter . PHP_EOL);
				if (method_exists($beverage, $getter)) 
				{
                    $value = $beverage->$getter();
					print("getter : " . $value . PHP_EOL);
                    $templatePlaceholder = "{" . strtolower($propertyName) . "}";
                    $templateContent = str_replace($templatePlaceholder, $value, $templateContent);
                }
            }
			fwrite($file, $templateContent);
            fclose($file);
        } 
        catch (Exception $e) 
        {
            echo COLOR_RED . "Error: " . $e->getMessage() . COLOR_RESET . PHP_EOL;
        }
    }
}
