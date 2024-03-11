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
    function __construct()
    {
        print(COLOR_GREEN . 'Constructor called' . COLOR_RESET . PHP_EOL);
    }

    function __destruct()
    {
        print(COLOR_BLUE . 'Destructor called' . COLOR_RESET . PHP_EOL);
    }

    public function createFile(string $fileName, string $templateName, array $parameters)
    {
        try 
        {
            // Ouverture du fichier
            $file = fopen($fileName, "x+");
            if ($file === false)
                throw new Exception("Unable to open file: $fileName, the file already exists !");

            // Traitement du fichier
            // Je get tout le contenu du fichier
            $templateContent = file_get_contents($templateName);
            // Je prends chaque element du tableau associatif et je remplace avec str_replace tout ce qui est entre {} par la value
            foreach ($parameters as $key => $value)
                $templateContent = str_replace("{" . $key . "}", $value, $templateContent);
            // Je cree un file avec le contenu de templateContent
            fwrite($file, $templateContent);
            fclose($file);
        } 
        catch (Exception $e) 
        {
            echo COLOR_RED . "Error: " . $e->getMessage() . COLOR_RESET . PHP_EOL;
        }
    }
}
