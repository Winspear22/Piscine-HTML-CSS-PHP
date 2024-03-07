<?php
require_once 'Text.php';
require_once 'TemplateEngine.php';

$text = new Text(["Ceci est la première ligne", "Ceci est la deuxième ligne"]);
$text->append("Ceci est une ligne ajoutée");
$text->append("Ceci est une ligne ajoutée 2");
$text->append("Ceci est une ligne ajoutée 3");
$text->append("Ceci est une ligne ajoutée 4");
$text->append("Ceci est une ligne ajoutée 5");
$text->append("Ceci est une ligne ajoutée 6");


$templateEngine = new TemplateEngine();
$templateEngine->createFile("output.html", $text);

?>
