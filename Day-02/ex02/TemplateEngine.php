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
			// Protection pour le nom du ficher pour ne pas qu'ils s'ecrasent et creer un fichier pour Tea et COffee
			$fileNameBase = "HotBeverage";
			$fileName = $fileNameBase . ".html";
			$counter = 0;
			// Vérifie si le fichier existe déjà et incrémente le compteur jusqu'à trouver un nom disponible
			while (file_exists($fileName) && $counter <= 9) 
			{
				$fileName = $fileNameBase . $counter . ".html";
				$counter++;
			}
			// Si le compteur depasse 9, gestion d'une erreur personnalisee
			if ($counter > 9)
				throw new Exception("Maximum file limit reached.");

			// Utilisation de reflexion class pour voir le contenu de la class Tea et Coffee
			$reflectionClass = new ReflectionClass(get_class($text));
			// Avec getProperties j'obtiens toutes les proprietes de Coffee et Tea, donc $description, $comment, $nom, $price et $resistance 
			foreach ($reflectionClass->getProperties() as $properties)
			{
				// J'obtiens le nom de la propriete : $comment
				$propertyName = $properties->getName();
				// Je cree une string pour creer le nom de de mes fonctions getters : 'getComment'
				$getter = 'get' . ucfirst($propertyName);
				// Je verifie si la methode existe au sein de ma classe : est-ce que getComment existe ? Si oui j'entre dans le if
				if (method_exists($text, $getter))
				{
					$value = $text->$getter(); // Si la methode existe, j'obtiens le return de la fonction getComment dans $value voir exemple dans echo en dessous
					// echo $getter . " : " . $value . PHP_EOL;
					// Comme pour l'exo precedent, je mets le nom de ma variable comment entre {} pour pouvoir la remplacer avec str_replace en dessous
					$templatePlaceholder = "{" . strtolower($propertyName) . "}";
                    $templateContent = str_replace($templatePlaceholder, $value, $templateContent); // Cherche $templatePlaceholder, remplace le par $value dans la variable $templateContent
				}
			}

			// Je cree le fichier $file avec le $filename personnalise.
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
