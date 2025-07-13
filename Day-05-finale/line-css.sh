#!/bin/bash

for i in $(seq -w 0 14); do
    BASE="ex${i}/templates/base.html.twig"
    if [ -f "$BASE" ]; then
        # Vérifie si le lien n'est pas déjà présent
        if ! grep -q '<link rel="stylesheet" href="/style.css">' "$BASE"; then
            # Insère la ligne après le début du block stylesheets
            sed -i '/{% block stylesheets %}/a \ \ \ \ <link rel="stylesheet" href="/style.css">' "$BASE"
            echo "Ajout du style dans $BASE"
        else
            echo "Déjà présent dans $BASE"
        fi
    else
        echo "Fichier non trouvé : $BASE"
    fi
done

echo "✅ Ajout du lien vers style.css terminé dans tous les base.html.twig."
