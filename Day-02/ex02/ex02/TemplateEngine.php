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
			// Protection pour le nom du ficher pour ne pas qu'ils s'ecrasent
			$fileNameBase = "HotBeverage";
			$fileName = $fileNameBase . ".html";
			$counter = 0;
			// Vérifie si le fichier existe déjà et incrémente le compteur jusqu'à trouver un nom disponible
			while (file_exists($fileName) && $counter <= 9) 
			{
				$fileName = $fileNameBase . $counter . ".html";
				$counter++;
			}
			// Si le compteur dépasse 9, gestion d'une erreur personnalisée
			if ($counter > 9)
				throw new Exception("Maximum file limit reached.");

			// Utilisation de reflexion class pour voir le contenu de la class Tea et Coffee
			$reflectionClass = new ReflectionClass(get_class($text));
			foreach ($reflectionClass->getProperties() as $properties)
			{
				$propertyName = $properties->getName();
				$getter = 'get' . ucfirst($propertyName);
				if (method_exists($text, $getter))
				{
					$value = $text->$getter();
					echo $getter . " : " . $value . PHP_EOL;
					$templatePlaceholder = "{" . strtolower($propertyName) . "}";
                    $templateContent = str_replace($templatePlaceholder, $value, $templateContent);
				}
			}
			$file = fopen($fileName, "w");
			if ($file === false)
				throw new Exception("Unable to open or create $fileName");
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
