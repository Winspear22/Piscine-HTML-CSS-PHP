<?php
require 'TemplateEngine.php';


$instance = new TemplateEngine();
$tab = [
    'nom' => 'Dune', 
    'auteur' => 'Frank Herbert', 
    'description' => 'Roman de science-fiction', 
    'prix' => '22'
];

$instance->createFile('output1.html', 'book_description.html', $tab);

?>
