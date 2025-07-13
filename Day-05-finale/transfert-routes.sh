#!/bin/bash

SRC_DIR="/home/adnen/Desktop/Day05/Day-05-restart"
DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"

# Cas particuliers
# ex04-retry2 -> ex04
if [ -f "$SRC_DIR/ex04-retry2/config/routes.yaml" ]; then
    mkdir -p "$DEST_DIR/ex04/config"
    cp "$SRC_DIR/ex04-retry2/config/routes.yaml" "$DEST_DIR/ex04/config/routes.yaml"
    echo "routes.yaml copié de ex04-retry2 vers ex04"
fi

# ex04-retry -> ex06
if [ -f "$SRC_DIR/ex04-retry/config/routes.yaml" ]; then
    mkdir -p "$DEST_DIR/ex06/config"
    cp "$SRC_DIR/ex04-retry/config/routes.yaml" "$DEST_DIR/ex06/config/routes.yaml"
    echo "routes.yaml copié de ex04-retry vers ex06"
fi

# Tous les exXX-retry
for old in $(ls $SRC_DIR | grep -E '^ex[0-9]{2}-retry$'); do
    if [[ "$old" =~ ex([0-9]{2})-retry ]]; then
        num=${BASH_REMATCH[1]}
        new="ex${num}"
        src_routes="$SRC_DIR/$old/config/routes.yaml"
        dest_routes="$DEST_DIR/$new/config/routes.yaml"
        if [ -f "$src_routes" ]; then
            mkdir -p "$(dirname "$dest_routes")"
            cp "$src_routes" "$dest_routes"
            echo "routes.yaml copié de $old vers $new"
        fi
    fi
done

# Pour ex10, ex11, ex12, ex13 (anciens projets non -retry)
for ex in ex10 ex11 ex12 ex13; do
    src_routes="$SRC_DIR/$ex/config/routes.yaml"
    dest_routes="$DEST_DIR/$ex/config/routes.yaml"
    if [ -f "$src_routes" ]; then
        mkdir -p "$(dirname "$dest_routes")"
        cp "$src_routes" "$dest_routes"
        echo "routes.yaml copié de $ex vers $ex"
    fi
done

echo "✅ Tous les fichiers routes.yaml ont été déplacés."

