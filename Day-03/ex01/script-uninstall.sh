#!/bin/bash

# Liste des répertoires de sous-projets
projects=(
    "monolog-2.0.0-2.0.2"
    "monolog-2.0.0-2.3.5"
    "monolog-2.1.0-2.2.0"
    "monolog-2.2.0-2.3.5"
    "monolog-2.3.0"
)

# Nom du package à désinstaller
package="monolog/monolog"

# Boucle à travers chaque répertoire de sous-projet
for project in "${projects[@]}"; do
    echo "Désinstallation de $package dans $project..."
    cd "$project" # Naviguer dans le répertoire du sous-projet
    composer remove "$package" # Exécute composer remove pour désinstaller le package
    cd - > /dev/null # Retourner au répertoire parent
done

echo "Désinstallation terminée."
