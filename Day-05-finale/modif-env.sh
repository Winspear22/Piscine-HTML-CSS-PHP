#!/bin/bash

# À lancer depuis la racine où se trouvent tous les dossiers ex00 à ex14
for i in $(seq -w 0 14); do
    EX="ex${i}"
    ENV_FILE="$EX/.env"
    if [ -f "$ENV_FILE" ]; then
        echo "Mise à jour du fichier .env dans $EX"
        cat > "$ENV_FILE" <<EOL
APP_ENV=dev
APP_SECRET=16abccbdabaad9214bb4f25c29cd410d
DATABASE_URL="mysql://admin:adminadmin@127.0.0.1:3306/ex${i}db"
EOL
    else
        echo "⚠️ Pas de fichier .env trouvé dans $EX"
    fi
done
echo "✅ Tous les .env ont été mis à jour."

