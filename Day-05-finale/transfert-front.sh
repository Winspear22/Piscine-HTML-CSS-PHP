#!/bin/bash

SRC_DIR="/home/adnen/Desktop/Day05/Day-05-restart"
DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"

# Fonction pour copier les templates sauf le dossier bundles
copy_templates_sans_bundles() {
    local src_templates="$1"
    local dest_templates="$2"
    mkdir -p "$dest_templates"
    # Copie tous les fichiers sauf le dossier 'bundles'
    find "$src_templates" -maxdepth 1 -mindepth 1 ! -name 'bundles' -exec cp -r {} "$dest_templates" \;
}

# Cas particuliers
# ex04-retry2 -> ex04
if [ -d "$SRC_DIR/ex04-retry2/templates" ]; then
    copy_templates_sans_bundles "$SRC_DIR/ex04-retry2/templates" "$DEST_DIR/ex04/templates"
    echo "Templates copiés de ex04-retry2 vers ex04"
fi

# ex04-retry -> ex06
if [ -d "$SRC_DIR/ex04-retry/templates" ]; then
    copy_templates_sans_bundles "$SRC_DIR/ex04-retry/templates" "$DEST_DIR/ex06/templates"
    echo "Templates copiés de ex04-retry vers ex06"
fi

# Pour tous les autres exXX-retry classiques
for old in $(ls $SRC_DIR | grep -E '^ex[0-9]{2}-retry$'); do
    if [[ "$old" =~ ex([0-9]{2})-retry ]]; then
        num=${BASH_REMATCH[1]}
        new="ex${num}"
        if [ -d "$SRC_DIR/$old/templates" ]; then
            copy_templates_sans_bundles "$SRC_DIR/$old/templates" "$DEST_DIR/$new/templates"
            echo "Templates copiés de $old vers $new"
        fi
    fi
done

# Pour ex10, ex11, ex12, ex13 (si tu veux les traiter aussi)
for ex in ex10 ex11 ex12 ex13; do
    if [ -d "$SRC_DIR/$ex/templates" ]; then
        copy_templates_sans_bundles "$SRC_DIR/$ex/templates" "$DEST_DIR/$ex/templates"
        echo "Templates copiés de $ex vers $ex"
    fi
done

echo "✅ Tous les templates ont été copiés (hors dossier bundles)."

