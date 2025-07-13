#!/bin/bash

DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"
EXOS="01 03 05 07 09 10 12 13"
MISSING=0

for num in $EXOS; do
    echo "=== Vérification de ex${num} ==="
    OK=1

    for d in Entity Repository Form; do
        dir="$DEST_DIR/ex${num}/src/$d"
        if [ -d "$dir" ]; then
            echo "  [$d] OK"
            ls "$dir"
        else
            echo "  [$d] ❌ Manquant"
            OK=0
        fi
    done

    dir="$DEST_DIR/ex${num}/migrations"
    if [ -d "$dir" ]; then
        echo "  [migrations] OK"
        ls "$dir"
    else
        echo "  [migrations] ❌ Manquant"
        OK=0
    fi

    if [ "$OK" -eq 1 ]; then
        echo "  → ✅ ex${num} complet"
    else
        echo "  → ⚠️  ex${num} incomplet"
        MISSING=1
    fi
    echo
done

if [ "$MISSING" -eq 0 ]; then
    echo "🎉 Tout est complet, aucun dossier important manquant."
else
    echo "❗️ Il manque des dossiers ou fichiers dans un ou plusieurs exos. Vérifie les logs ci-dessus."
fi

