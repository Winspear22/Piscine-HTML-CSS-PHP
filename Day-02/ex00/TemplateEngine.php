<?php
define("COLOR_RED", "\033[31m");
define("COLOR_GREEN", "\033[32m");
define("COLOR_YELLOW", "\033[33m");
define("COLOR_BLUE", "\033[34m");
define("COLOR_MAGENTA", "\033[35m");
define("COLOR_CYAN", "\033[36m");
define("COLOR_RESET", "\033[0m");

class TemplateEngine
{
    public function __construct()
    {
        print(COLOR_GREEN . 'Constructor called' . COLOR_RESET . PHP_EOL);
        $this->foo = 42;
    }

    public function __destruct()
    {
        print(COLOR_BLUE . 'Destructor called' . COLOR_RESET . PHP_EOL);
    }

    public function createFile(string $fileName, string $templateName, array $parameters)
    {
        try 
        {
            $file = fopen($fileName, "x+");
            if ($file === false)
                throw new Exception("Unable to open file: $fileName, the file already exists !");

            // J'ouvre et je prends tout le contenu du fichier dans ma variable $tamplateContent
            $templateContent = file_get_contents($templateName);
            foreach ($parameters as $key => $value)
                $templateContent = str_replace("{" . $key . "}", $value, $templateContent);
            fwrite($file, $templateContent);
            fclose($file);
        } 
        catch (Exception $e) 
        {
            echo COLOR_RED . "Error: " . $e->getMessage() . COLOR_RESET . PHP_EOL;
        }
    }
}

?>
