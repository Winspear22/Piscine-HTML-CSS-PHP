<?php
require 'TemplateEngine.php';


$instance = new TemplateEngine();

$instance->createFile(
    'output1.html', 
    'book_description.html', 
    ['nom' => 'Dune', 'auteur' => 'Frank Herbert', 'description' => 'Roman de science-fiction', 'prix' => '22']
);

?>
