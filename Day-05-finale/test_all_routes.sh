#!/bin/bash

BASE="http://localhost"
PORT_BASE=8000

# Tableau des routes (format : "exo port url méthode")
ROUTES=(
  "ex00 8000 /ex00 GET"
  "ex01 8001 /ex01 GET"
  "ex02 8002 /ex02 GET"
  "ex03 8003 /ex03 GET"
  "ex03 8003 /ex03/create GET"
  "ex04 8004 /ex04 GET"
  "ex05 8005 /ex05 GET"
  "ex05 8005 /ex05/create GET"
  "ex05 8005 /ex05/delete/1 POST"
  "ex06 8006 /ex06 GET"
  "ex07 8007 /ex07 GET"
  "ex07 8007 /ex07/create GET"
  "ex07 8007 /ex07/update/1 GET"
  "ex08 8008 /ex08 GET"
  "ex08 8008 /ex08/create-persons POST"
  "ex08 8008 /ex08/create-address-table POST"
  "ex08 8008 /ex08/create-BankAccount-table POST"
  "ex08 8008 /ex08/add-marital-status POST"
  "ex08 8008 /ex08/add-relation-addresses POST"
  "ex08 8008 /ex08/add-relation-bank-account POST"
  "ex08 8008 /ex08/drop-tables POST"
  "ex09 8009 /ex09 GET"
  "ex09 8009 /ex09/add POST"
  "ex09 8009 /ex09/add-address/1 POST"
  "ex09 8009 /ex09/add-bank-account/1 POST"
  "ex09 8009 /ex09/delete/1 POST"
  "ex10 8010 /ex10 GET"
  "ex10 8010 /ex10/create-sql-table GET"
  "ex10 8010 /ex10/import GET"
  "ex10 8010 /ex10/clear GET"
  "ex11 8011 /ex11 GET"
  "ex11 8011 /ex11/add-test-persons POST"
  "ex11 8011 /ex11/drop-tables POST"
  "ex12 8012 /ex12 GET"
  "ex12 8012 /ex12/add-test-persons POST"
  "ex12 8012 /ex12/drop-all POST"
)

for route in "${ROUTES[@]}"; do
    read exo port url method <<<"$route"
    full_url="$BASE:$port$url"
    # Démarre le serveur Symfony si besoin
    cd "/home/adnen/Desktop/Day05/Day-05-finale/$exo"
    symfony server:start --port=$port -d
    sleep 1

    if [ "$method" = "GET" ]; then
        code=$(curl -s -o /dev/null -w "%{http_code}" "$full_url")
    else
        code=$(curl -s -o /dev/null -w "%{http_code}" -X POST "$full_url")
    fi

    if [ "$code" = "200" ] || [ "$code" = "302" ]; then
        echo "✅ [$exo] $method $url → $code"
    else
        echo "❌ [$exo] $method $url → $code"
    fi

    symfony server:stop
done

