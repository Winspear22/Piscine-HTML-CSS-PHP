#!/bin/bash

set -e

COMPOSER_JSON="./composer.json"
STYLE_CSS="./style.css"

if [ ! -f "$COMPOSER_JSON" ]; then
    echo "Erreur : Le fichier composer.json n'existe pas à la racine."
    exit 1
fi

if [ ! -f "$STYLE_CSS" ]; then
    echo "Erreur : Le fichier style.css n'existe pas à la racine."
    exit 1
fi

for i in $(seq -w 0 14); do
    EX="ex${i}"
    echo "========== Création du projet $EX =========="
    composer create-project symfony/skeleton "$EX"

    cp "$COMPOSER_JSON" "$EX/composer.json"
    mkdir -p "$EX/public"
    cp "$STYLE_CSS" "$EX/public/style.css"

    cd "$EX"

    # Supprime tout lockfile éventuel (généré à l'init ou par erreur)
    rm -f composer.lock

    # Met à jour les dépendances en accord avec le composer.json (génère un lock propre)
    composer update

    # Installe le package spécifique si non inclus dans ton composer.json
    composer require winspear22/php42

    cd ..
    echo
done

echo "✅ Tous les projets exXX ont été recréés, le composer.json et le style.css copiés, et les dépendances installées proprement."

