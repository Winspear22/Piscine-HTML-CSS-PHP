#!/bin/bash

# Définition des dossiers et des commandes require correspondantes avec --no-update
declare -A commands=(
    ["monolog-2.0.0-2.0.2"]='composer require monolog/monolog:"^2.0.0 <2.0.2" --no-update'
    ["monolog-2.0.0-2.3.5"]='composer require monolog/monolog:"^2.2.1 <=2.3.5" --no-update'
    ["monolog-2.1.0-2.2.0"]='composer require monolog/monolog:">=2.1.0 <=2.2.0" --no-update'
    ["monolog-2.2.0-2.3.5"]='composer require monolog/monolog:">2.0.0 <2.3.5" --no-update'
    ["monolog-2.3.0"]='composer require monolog/monolog:"^2.3.1" --no-update'
)

# Boucle sur chaque dossier et exécution de la commande require correspondante
for dir in "${!commands[@]}"; do
    echo "Ajout de Monolog au fichier composer.json dans le dossier $dir sans installer..."
    (cd "$dir" && eval ${commands[$dir]} && cd - > /dev/null)
done
