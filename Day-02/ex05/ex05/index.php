<?php

require_once "Elem.php";
require_once "TemplateEngine.php";


try 
{
    $html = new Elem('html');
    $head = new Elem('head');
    $head->pushElement(new Elem('meta', '', ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']));
    $head->pushElement(new Elem('title', 'Test avec Attributs'));

    $body = new Elem('body', '', ['style' => 'background-color: #f0f0f0;']);
    $body->pushElement(new Elem('h1', 'Titre principal', ['style' => 'color: blue;']));
    $body->pushElement(new Elem('h2', 'Sous-titre', ['style' => 'color: green;']));
    $body->pushElement(new Elem('p', 'Paragraphe avec style.', ['style' => 'color: #333; font-size: 16px;']));

    $img = new Elem('img', '', ['src' => 'https://cdn-uploads.gameblog.fr/img/news/436165_64be6a5c80cb0.webp', 'alt' => 'Image de Naruto', 'style' => 'width: 200px;']);
    $body->pushElement($img);

    $body->pushElement(new Elem('hr', '', ['style' => 'margin-top: 20px;']));

    $list = new Elem('ul');
    $list->pushElement(new Elem('li', 'Item 1'));
    $list->pushElement(new Elem('li', 'Item 2'));
    $body->pushElement($list);

    $table = new Elem('table', '', ['border' => '1', 'style' => 'border-collapse: collapse;']);
    $tr = new Elem('tr');
    $tr->pushElement(new Elem('th', 'Entête 1'));
    $tr->pushElement(new Elem('th', 'Entête 2'));
    $table->pushElement($tr);

    $tr = new Elem('tr');
    $tr->pushElement(new Elem('td', 'Donnée 1', ['style' => 'text-align: center;']));
    $tr->pushElement(new Elem('td', 'Donnée 2', ['style' => 'text-align: center;']));
    $table->pushElement($tr);
    $body->pushElement($table);

    $body->pushElement(new Elem('br'));
    $body->pushElement(new Elem('p', 'Paragraphe après un saut de ligne.', ['class' => 'text-muted']));

    $html->pushElement($head);
    $html->pushElement($body);

    //echo $html->getHTML();
    $res = $html->validPage();
    //echo $res . "\n";
    $templateEngine = new TemplateEngine($html);
    $templateEngine->createFile("output.html");
} 
catch (Exception $e) 
{
    echo "Error: " . $e->errorMessage();
}


?>