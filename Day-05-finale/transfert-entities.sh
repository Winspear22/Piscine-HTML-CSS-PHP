#!/bin/bash

SRC_DIR="/home/adnen/Desktop/Day05/Day-05-restart"
DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"

copy_if_exists() {
    src="$1"
    dest="$2"
    if [ -d "$src" ]; then
        mkdir -p "$dest"
        cp -r "$src/"* "$dest/"
        echo "Copié : $src --> $dest"
    fi
}

# Liste des exos ORM (adapté aux retry/numéro ou pas)
for num in 01 03 05 07 09 10 12 13; do
    # Cherche s'il y a un dossier -retry sinon utilise l'exo normal
    if [ -d "$SRC_DIR/ex${num}-retry/src/Entity" ] || [ -d "$SRC_DIR/ex${num}-retry/migrations" ]; then
        src_path="$SRC_DIR/ex${num}-retry"
    else
        src_path="$SRC_DIR/ex${num}"
    fi
    dest_path="$DEST_DIR/ex${num}"

    copy_if_exists "$src_path/src/Entity" "$dest_path/src/Entity"
    copy_if_exists "$src_path/src/Repository" "$dest_path/src/Repository"
    copy_if_exists "$src_path/src/Form" "$dest_path/src/Form"
    copy_if_exists "$src_path/migrations" "$dest_path/migrations"
done

echo "✅ Transfert Entity, Repository, Form, migrations effectué pour ex01, 03, 05, 07, 09, 10, 12, 13."

