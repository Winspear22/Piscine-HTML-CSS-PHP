<?php
require_once 'Tea.php';
require_once 'Coffee.php';
require_once 'TemplateEngine.php';

$Tea = new Tea("Tea", 1.5, 1, "Sweet Tea", "Very good tea, i loved it");
$Coffee = new Coffee("Coffee", 2, 5, "Sweet Coffee", "Very good Coffee, i loved it");

$templateEngine = new TemplateEngine();
$templateEngine->createFile($Tea);
$templateEngine->createFile($Coffee);

?>
