#!/bin/bash

SRC="/home/adnen/Desktop/Day05/Day-05-restart/ex09-retry2"
DEST="/home/adnen/Desktop/Day05/Day-05-finale/ex09"

# Liste des dossiers importants à remplacer/copier
for d in src templates config migrations; do
    if [ -d "$SRC/$d" ]; then
        rm -rf "$DEST/$d"
        cp -r "$SRC/$d" "$DEST/$d"
        echo "Copié $d de ex09-retry2 vers ex09"
    fi
done

echo "✅ ex09 a bien été remplacé par le contenu de ex09-retry2."

