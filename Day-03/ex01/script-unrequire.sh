#!/bin/bash

# Définition des dossiers
directories=("monolog-2.0.0-2.0.2" "monolog-2.0.0-2.3.5" "monolog-2.1.0-2.2.0" "monolog-2.2.0-2.3.5" "monolog-2.3.0")

# Boucle sur chaque dossier et exécution de la commande remove
for dir in "${directories[@]}"; do
    echo "Désinstallation de Monolog dans le dossier $dir..."
    (cd "$dir" && composer remove monolog/monolog && cd - > /dev/null)
done
