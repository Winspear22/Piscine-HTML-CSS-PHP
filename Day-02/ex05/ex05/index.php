<?php

require_once "Elem.php";
require_once "TemplateEngine.php";

$testNumber = 0;

// ESSAIE VALIDE 
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

    if ($html->validPage()) 
        echo "TEST $testNumber : Page HTML valide.\n";
    else 
        echo "TEST $testNumber : Page HTML non valide.\n";
    $templateEngine = new TemplateEngine($html);
    $templateEngine->createFile("output.html");
} 
catch (Exception $e) 
{
    echo "Error: " . $e->errorMessage();
}

// ESSAIS INVALIDES : 

// Essai avec plusieurs HTML TEST 1
$testNumber++;
try 
{
    $html = new Elem('html');
    $html->pushElement(new Elem('html')); // Invalide : ajout d'un deuxième élément html

    if ($html->validPage())
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : plusieurs éléments <html>.\n";
} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}

$testNumber++;

// Essai avec p contenant une balise TEST 2
try 
{
    $html = new Elem('html');
    $body = new Elem('body');
    $paragraph = new Elem('p');
    $paragraph->pushElement(new Elem('span', 'Ceci ne devrait pas être valide')); // Invalide : <p> contient une balise
    $body->pushElement($paragraph);
    $html->pushElement($body);

    if ($html->validPage())
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : <p> contient une balise.\n";

} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}

$testNumber++;
// Essai avec une structure de table incorrecte TEST 3
try 
{
    $html = new Elem('html');
    $body = new Elem('body');
    $table = new Elem('table');
    $tr = new Elem('tr');
    $tr->pushElement(new Elem('p', 'Ceci ne devrait pas être valide')); // Invalide : <tr> contient une balise <p>
    $table->pushElement($tr);
    $body->pushElement($table);
    $html->pushElement($body);

    if ($html->validPage())
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : structure de table incorrecte.\n";
} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}

$testNumber++;
// Essai avec plusieurs title dans head TEST 4
try 
{
    $html = new Elem('html');
    $head = new Elem('head');
    $head->pushElement(new Elem('title', 'Premier titre'));
    $head->pushElement(new Elem('title', 'Deuxième titre')); // Invalide : deuxième élément title
    $body = new Elem('body');
    $html->pushElement($head);
    $html->pushElement($body);

    if ($html->validPage())
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : plusieurs éléments <title>.\n";
} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}

$testNumber++;
//Échec avec plusieurs <meta charset> dans <head> TEST 5

try 
{
    $html = new Elem('html');
    $head = new Elem('head');
    $head->pushElement(new Elem('title', 'Titre unique'));
    $head->pushElement(new Elem('meta', '', ['charset' => 'UTF-8']));
    $head->pushElement(new Elem('meta', '', ['charset' => 'ISO-8859-1'])); // Invalide : deuxième élément meta charset
    $body = new Elem('body');
    $html->pushElement($head);
    $html->pushElement($body);

    if ($html->validPage())
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : plusieurs éléments <meta charset>.\n";
} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}


$testNumber++;
//Echec une structure valide pour <ul> et <ol> TEST 6
try 
{
    $html = new Elem('html');
    $body = new Elem('body');
    $ul = new Elem('ul');
    $ul->pushElement(new Elem('li', 'Premier élément'));
    $ul->pushElement(new Elem('li', 'Deuxième élément'));
    $ol = new Elem('ol');
    $ol->pushElement(new Elem('p', 'Premier élément ordonné'));
    $ol->pushElement(new Elem('li', 'Deuxième élément ordonné'));
    $body->pushElement($ul);
    $body->pushElement($ol);
    $html->pushElement($body);

    if ($html->validPage()) 
        echo "TEST $testNumber : Page HTML valide.\n";
    else
        echo "TEST $testNumber : Page HTML non valide : éléments interdits dans la liste\n";
} 
catch (Exception $e) 
{
    echo "Erreur : " . $e->getMessage() . "\n";
}





?>