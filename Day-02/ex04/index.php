<?php
require_once 'Elem.php';
require_once 'TemplateEngine.php';

	/*try 
	{
    	// Création de la structure HTML de base
    	$html = new Elem('html', '');
    	$head = new Elem('head', '');
    	$title = new Elem('title', 'Mon site sur Naruto');
    	$head->pushElement($title);
    	$html->pushElement($head);

    	// Création du corps de la page
    	$body = new Elem('body', '');
    	$header = new Elem('h1', 'Naruto - Le Ninja Légendaire');
    	$body->pushElement($header);

    	// Ajout de paragraphes avec des attributs
    	$paragraph1 = new Elem('p', 'Découvrez l\'univers de Naruto Uzumaki.', ['class' => 'introduction']);
    	$body->pushElement($paragraph1);

    	// Ajout d'une liste non ordonnée
    	$ul = new Elem('ul', '');
    	$li1 = new Elem('li', 'Ninja de Konoha');
    	$li2 = new Elem('li', 'Membre du clan Uzumaki');
    	$ul->pushElement($li1);
    	$ul->pushElement($li2);
    	$body->pushElement($ul);

    	// Ajout d'un tableau
    	$table = new Elem('table', '');
    	$tr = new Elem('tr', '');
    	$th = new Elem('th', 'Caractéristiques');
    	$td = new Elem('td', 'Description');
    	$tr->pushElement($th);
    	$tr->pushElement($td);
    	$table->pushElement($tr);
    	$body->pushElement($table);

    	// Ajout d'une image
    	$image = new Elem('img', '', ['src' => 'https://cdn-uploads.gameblog.fr/img/news/436165_64be6a5c80cb0.webp', 'alt' => 'Image de Naruto']);

    	$body->pushElement($image);

    	// Pour tester le lancement de l'exception, décommente la ligne suivante
    	// $testException = new Elem('undefinedElement', 'Ceci devrait lancer une exception.');
    	$html->pushElement($body);

    	// Génération du fichier HTML
    	$templateEngine = new TemplateEngine($html);
    	$templateEngine->createFile("output.html");
	} 
	catch (Exception $e) 
	{
    	echo "Error: " . $e->getMessage();
	}*/

	try {
		$elem = new Elem('html');
		$body = new Elem('body');
		$body->pushElement(new Elem('p', 'Lorem ipsum', ['class' => 'text-muted']));
		$elem->pushElement($body);
		echo $elem->getHTML();
		$elem = new Elem('undefined'); // Leve une exception de type MyException$
	}
catch (Exception $e)
{
	echo "Error: " . $e->getMessage();
}
?>
