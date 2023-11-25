<?php
require_once 'Text.php';
require_once 'TemplateEngine.php';

$text = new Text(["Ceci est la première ligne", "Ceci est la deuxième ligne"]);
$text->append("Ceci est une ligne ajoutée");

$templateEngine = new TemplateEngine();
$templateEngine->createFile("output.html", $text);

?>
