#!/bin/bash

# Définis la liste des dossiers
directories=("monolog-2.0.0-2.0.2" "monolog-2.0.0-2.3.5" "monolog-2.1.0-2.2.0" "monolog-2.2.0-2.3.5" "monolog-2.3.0")

# Boucle sur chaque dossier
for dir in "${directories[@]}"
do
    echo "Exécution de composer install dans le dossier $dir"
    cd "$dir" # Change dans le dossier
    composer install # Exécute composer install
    cd .. # Retour au dossier parent
done
