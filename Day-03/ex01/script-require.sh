#!/bin/bash

# Définition des dossiers et des commandes require correspondantes
declare -A commands=(
    ["monolog-2.0.0-2.0.2"]='composer require monolog/monolog:"^2.0.0 <2.0.2"'
    ["monolog-2.0.0-2.3.5"]='composer require monolog/monolog:"^2.2.1 <=2.3.5"'
    ["monolog-2.1.0-2.2.0"]='composer require monolog/monolog:">=2.1.0 <=2.2.0"'
    ["monolog-2.2.0-2.3.5"]='composer require monolog/monolog:">2.0.0 <2.3.5"'
    ["monolog-2.3.0"]='composer require monolog/monolog:"^2.3.1"'
)

# Boucle sur chaque dossier et exécution de la commande require correspondante
for dir in "${!commands[@]}"; do
    echo "Installation de Monolog dans le dossier $dir..."
    (cd "$dir" && eval ${commands[$dir]} && cd - > /dev/null)
done
