<?php
$dsn = 'mysql:host=127.0.0.1;dbname=ex00db';
$user = 'admin';
$password = 'adminadmin';

try {
    $pdo = new PDO($dsn, $user, $password);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
