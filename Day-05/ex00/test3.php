<?php

use Doctrine\DBAL\DriverManager;

require 'vendor/autoload.php';

$connectionParams = [
    'dbname' => 'ex00db',
    'user' => 'admin',
    'password' => 'adminadmin',
    'host' => '127.0.0.1',
    'driver' => 'pdo_mysql',
];

try {
    $conn = DriverManager::getConnection($connectionParams);
    //$conn->connect(); // Supprimons cette ligne
    echo "Connexion réussie avec Doctrine DBAL !";
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
