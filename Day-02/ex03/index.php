<?php
require_once 'Elem.php';
require_once 'TemplateEngine.php';

try {
    $html = new Elem('html', '');

    // Ajout de l'élément head avec un titre
    $head = new Elem('head', '');
    $title = new Elem('title', 'Ma Page Web');
    $head->pushElement($title);
    $html->pushElement($head);

    // Création du corps de la page
    $body = new Elem('body', '');

    // Ajout d'un en-tête
    $header = new Elem('h1', 'Bienvenue sur Ma Page Web');
    $body->pushElement($header);

    // Ajout de quelques paragraphes
    $paragraph1 = new Elem('p', 'Ceci est un exemple de paragraphe.');
    $body->pushElement($paragraph1);

    $paragraph2 = new Elem('p', 'Voici un autre paragraphe pour démontrer comment cela fonctionne.');
    $body->pushElement($paragraph2);

    // Ajout d'une image
    $image = new Elem('img', '');
    $image->element = 'img src="https://example.com/image.jpg" alt="Exemple Image"';
    $body->pushElement($image);

    // Ajout d'un pied de page
    //$footer = new Elem('footer', 'Pied de page de mon site Web');
    //$body->pushElement($footer);

    $html->pushElement($body);

    // Utilisation de TemplateEngine pour générer le fichier HTML
    $templateEngine = new TemplateEngine($html);
    $templateEngine->createFile("output.html");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
