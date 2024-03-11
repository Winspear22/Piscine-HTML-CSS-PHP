<?php
require_once 'Elem.php';
require_once 'TemplateEngine.php';

	try 
	{
    	// Création de la structure HTML de base
    	$html = new Elem('html', '');
    	$head = new Elem('head', '');
    	$title = new Elem('title', 'Mon site sur Naruto');
		$metaCharset = new Elem('meta', '', ['charset' => 'UTF-8']);
		//$popo = new Elem('p', 'popopololo');

		$head->pushElement($metaCharset);
		$head->pushElement($title);
		//$head->pushElement($popo);

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

		/*****************************************/
		/* AJOUTER UNE BALISE DANS UNE BALISE <P>*/
		/*****************************************/
		/*$pElem = new Elem('p', '');
		// Création de l'élément interne, par exemple <span>
		$spanElem = new Elem('br', 'Texte dans span');

		// Ajout de l'élément <span> à l'intérieur de l'élément <p>
		$pElem->pushElement($spanElem);
		$body->pushElement($pElem);*/
		/*****************************************/

		/*****************************************/
		/*********FAIRE UN TABLEAU MAUVAIS********/
		/*****************************************/
		/*$tableIncorrect = new Elem('table', '');
		$trIncorrect = new Elem('tr', '');
		$pIncorrect = new Elem('p', 'Paragraphe dans tr');
		$trIncorrect->pushElement($pIncorrect);
		$tableIncorrect->pushElement($trIncorrect);
		$body->pushElement($tableIncorrect);*/

		// Table contenant directement une balise th sans tr
		//$tableWithTh = new Elem('table', '');
		//$thDirect = new Elem('th', 'Caractéristiques Directes');
		//$tableWithTh->pushElement($thDirect);
		//$body->pushElement($tableWithTh);
		//---------------------------------------------------

		// Table avec tr contenant une balise p
		//$tableWithP = new Elem('table', '');
		//$trWithP = new Elem('tr', '');
		//$pInTr = new Elem('p', 'Paragraphe dans tr');
		//$trWithP->pushElement($pInTr);
		//$tableWithP->pushElement($trWithP);
		//$body->pushElement($tableWithP);
		//--------------------------------------------------

		// Table sans aucune balise tr à l'intérieur MARCHAIS
		//$emptyTable = new Elem('table', '');
		//$body->pushElement($emptyTable);
		//--------------------------------------------------

		// Tr placé directement dans le body et non dans une table MARCHE
		//$trOutsideTable = new Elem('tr', '');
		//$thForTr = new Elem('th', 'TH en dehors de Table');
		//$trOutsideTable->pushElement($thForTr);
		//$body->pushElement($trOutsideTable);
		//--------------------------------------------------

		// Tr contenant à la fois th et une balise incorrecte comme div
		//$tableWithMixedContent = new Elem('table', '');
		//$trMixed = new Elem('tr', '');
		//$thMixed = new Elem('th', 'TH Mixte');
		//$divInTr = new Elem('div', 'DIV dans TR');
		//$trMixed->pushElement($thMixed);
		//$trMixed->pushElement($divInTr);
		//$tableWithMixedContent->pushElement($trMixed);
		//$body->pushElement($tableWithMixedContent);

		/*****************************************/

		/*****************************************/
		/*************FAIRE UNE LI NULLE**********/
		/*****************************************/
		//$ul = new Elem('ul', '');
		//$li = new Elem('li', 'Item 1');
		//$p = new Elem('p', 'Ceci n\'est pas autorisé ici');
		//$ul->pushElement($li);
		//$ul->pushElement($p); // Ceci est incorrect
		//$body->pushElement($ul);
		

		/*****************************************/
    	// Pour tester le lancement de l'exception, décommente la ligne suivante
    	// $testException = new Elem('undefinedElement', 'Ceci devrait lancer une exception.');
    	$html->pushElement($body);
		$html->displayAllElements();
    	// Génération du fichier HTML

		if ($html->validPage()) {
			$templateEngine = new TemplateEngine($html);
			$templateEngine->createFile("output.html");
		} else {
			echo "La structure HTML n'est pas valide.";
		}
	} 
	catch (Exception $e) 
	{
    	echo "Error: " . $e->getMessage();
	}
?>
