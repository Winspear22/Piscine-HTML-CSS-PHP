#!/bin/bash

BASE="/home/adnen/Desktop/Day05/Day-05-finale"

for i in $(seq -w 0 12); do
    DIR="$BASE/ex${i}"
    URL="http://localhost:80${i}/ex${i}"
    if [ -d "$DIR" ]; then
        echo "===== Test ex${i} ====="
        cd "$DIR"
        # Démarre le serveur Symfony sur un port unique pour chaque exo
        symfony server:start --port=80${i} -d
        sleep 2 # Laisse le serveur démarrer

        STATUS=$(curl -s -o /dev/null -w "%{http_code}" "$URL")
        echo "  URL $URL : Code HTTP $STATUS"
        if [ "$STATUS" = "200" ]; then
            echo "    ✅ Page OK"
        else
            echo "    ❌ Problème détecté (code $STATUS)"
        fi

        symfony server:stop
        cd "$BASE"
        echo
    fi
done

echo "Vérification HTTP terminée."

