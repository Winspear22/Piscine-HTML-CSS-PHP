#!/bin/bash

BASE="/home/adnen/Desktop/Day05/Day-05-finale"
SUCCESS=0
FAIL=0

for i in $(seq -w 0 14); do
    DIR="$BASE/ex${i}"
    if [ -d "$DIR" ]; then
        echo "===== Vérification de ex${i} ====="
        cd "$DIR"
        
        # Teste si le projet Symfony répond
        if ! php bin/console about > /dev/null 2>&1; then
            echo "  ❌ Symfony ne démarre pas dans ex${i}"
            ((FAIL++))
            cd "$BASE"
            continue
        fi

        # Vérifie les routes
        echo "  - Routes :"
        php bin/console debug:router | grep ex${i} || echo "    ⚠️ Aucune route ex${i} trouvée"

        # Teste la connexion DB (ignorer l'erreur si pas d'ORM)
        if php bin/console doctrine:database:connect > /dev/null 2>&1; then
            echo "  - Connexion DB OK"
        else
            echo "  - ⚠️ Connexion DB impossible (OK si pas d'ORM sur cet exo)"
        fi

        # Vérifie les migrations si le dossier existe
        if [ -d "migrations" ]; then
            echo "  - Migrations :"
            php bin/console doctrine:migrations:status || echo "    ⚠️ Erreur migration"
        fi

        # (Optionnel) Test HTTP local (si le serveur est lancé sur 8000)
        # symfony server:start -d
        # sleep 2
        # curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/ex${i}
        # symfony server:stop

        ((SUCCESS++))
        cd "$BASE"
        echo
    fi
done

echo "Vérification terminée : $SUCCESS exercices OK, $FAIL erreurs."

