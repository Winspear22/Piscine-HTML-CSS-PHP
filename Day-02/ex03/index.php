<?php

require_once "Elem.php";
require_once "TemplateEngine.php";
try {


    $html = new Elem('html', '');

    // Ajout de l'élément head avec un titre
    $head = new Elem('head', '');
    $title = new Elem('title', 'Mon site Naruto');
    $head->pushElement($title);
    $html->pushElement($head);

    // Création du corps de la page
    $body = new Elem('body', '');

    // Ajout d'un en-tête
    $header = new Elem('h1', 'Naruto Website');
    $body->pushElement($header);

    // Ajout de quelques paragraphes
    $paragraph1 = new Elem('p', 'Bienvenue sur un site spécialement dédié à Naruto et à son univers.');
    $body->pushElement($paragraph1);

    $paragraph2 = new Elem('p', 'Ce site a été crée par adaloui.');
    $body->pushElement($paragraph2);

    // Ajout d'une image
    $image = new Elem('img', 'src="https://cdn-uploads.gameblog.fr/img/news/436165_64be6a5c80cb0.webp" alt="Naruto image"');
    $body->pushElement($image);

    // Ajout d'un pied de page
    //$footer = new Elem('footer', 'Pied de page de mon site Web');
    //$body->pushElement($footer);

    $html->pushElement($body);

$templateEngine = new TemplateEngine($html);
$templateEngine->createFile("output.html");
}
catch (Exception $e)
{
    echo "popo " . $e->getMessage();
}

?>