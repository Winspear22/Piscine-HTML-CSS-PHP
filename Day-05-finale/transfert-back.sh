#!/bin/bash

SRC_DIR="/home/adnen/Desktop/Day05/Day-05-restart"
DEST_DIR="/home/adnen/Desktop/Day05/Day-05-finale"

copy_controller() {
    local src_ctrl="$1"
    local dest_ctrl="$2"
    mkdir -p "$(dirname "$dest_ctrl")"
    cp "$src_ctrl" "$dest_ctrl"
    echo "Contrôleur copié : $src_ctrl → $dest_ctrl"
}

# Cas particuliers
# ex04-retry2 -> ex04
if [ -f "$SRC_DIR/ex04-retry2/src/Ex04Bundle/Controller/Ex04Controller.php" ]; then
    copy_controller "$SRC_DIR/ex04-retry2/src/Ex04Bundle/Controller/Ex04Controller.php" "$DEST_DIR/ex04/src/Controller/Ex04Controller.php"
fi

# ex04-retry -> ex06
if [ -f "$SRC_DIR/ex04-retry/src/Ex04Bundle/Controller/Ex04Controller.php" ]; then
    copy_controller "$SRC_DIR/ex04-retry/src/Ex04Bundle/Controller/Ex04Controller.php" "$DEST_DIR/ex06/src/Controller/Ex06Controller.php"
fi

# Tous les exXX-retry normaux
for old in $(ls $SRC_DIR | grep -E '^ex[0-9]{2}-retry$'); do
    if [[ "$old" =~ ex([0-9]{2})-retry ]]; then
        num=${BASH_REMATCH[1]}
        new="ex${num}"
        src_ctrl="$SRC_DIR/$old/src/Ex${num}Bundle/Controller/Ex${num}Controller.php"
        dest_ctrl="$DEST_DIR/$new/src/Controller/Ex${num}Controller.php"
        if [ -f "$src_ctrl" ]; then
            copy_controller "$src_ctrl" "$dest_ctrl"
        fi
    fi
done

# Pour ex10, ex11, ex12, ex13 (si présent dans l'ancien format)
for ex in ex10 ex11 ex12 ex13; do
    num=${ex:2:2}
    src_ctrl="$SRC_DIR/$ex/src/Ex${num}Bundle/Controller/Ex${num}Controller.php"
    dest_ctrl="$DEST_DIR/$ex/src/Controller/Ex${num}Controller.php"
    if [ -f "$src_ctrl" ]; then
        copy_controller "$src_ctrl" "$dest_ctrl"
    fi
done

echo "✅ Tous les contrôleurs ont été copiés."

