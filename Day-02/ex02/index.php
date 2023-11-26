<?php
require_once 'HotBeverage.php';
require_once 'TemplateEngine.php';
require_once 'Coffee.php';
require_once 'Tea.php';

$coffee = new Coffee("Rich Espresso", "Strong and invigorating");
$tea = new Tea("Green Tea", "Refreshing and calming");

$engine = new TemplateEngine();
$engine->createFile("Coffee.html", $coffee);
$engine->createFile("Tea.html", $tea);
?>
