#!/bin/bash

SRC_DIR="/home/adnen/Desktop/Day05/Day-05-restart"
DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"

# ex04-retry2 → ex04
if [ -d "$SRC_DIR/ex04-retry2/templates/bundles" ]; then
    mkdir -p "$DEST_DIR/ex04/templates/"
    cp -r "$SRC_DIR/ex04-retry2/templates/bundles" "$DEST_DIR/ex04/templates/"
    echo "bundles copié de ex04-retry2 vers ex04"
fi

# ex04-retry → ex06
if [ -d "$SRC_DIR/ex04-retry/templates/bundles" ]; then
    mkdir -p "$DEST_DIR/ex06/templates/"
    cp -r "$SRC_DIR/ex04-retry/templates/bundles" "$DEST_DIR/ex06/templates/"
    echo "bundles copié de ex04-retry vers ex06"
fi

# Pour ex10, ex11, ex12, ex13 et tous les exXX-retry normaux
for ex in ex10 ex11 ex12 ex13 $(ls $SRC_DIR | grep -E '^ex[0-9]{2}-retry$'); do
    # Détermination du numéro cible pour le dossier final
    if [[ "$ex" =~ ex([0-9]{2})-retry ]]; then
        TARGET="ex${BASH_REMATCH[1]}"
    else
        TARGET="$ex"
    fi

    SRC_BUNDLES="$SRC_DIR/$ex/templates/bundles"
    DEST_TEMPLATES="$DEST_DIR/$TARGET/templates/"

    if [ -d "$SRC_BUNDLES" ]; then
        mkdir -p "$DEST_TEMPLATES"
        cp -r "$SRC_BUNDLES" "$DEST_TEMPLATES"
        echo "bundles copié de $ex vers $TARGET"
    else
        echo "Pas de bundles à copier dans $ex"
    fi
done

echo "✅ Copie terminée pour tous les bundles."

