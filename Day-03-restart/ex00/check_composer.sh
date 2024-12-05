#!/bin/bash

# Couleurs
GREEN="\033[0;32m"
RED="\033[0;31m"
YELLOW="\033[0;33m"
BLUE="\033[0;34m"
CYAN="\033[0;36m"
RESET="\033[0m"

echo "${CYAN}========================"
echo "Vérification de Composer"
echo "========================${RESET}"

# Vérifie si Composer est installé
if command -v composer >/dev/null 2>&1; then
    echo "${GREEN}✅ Composer est installé globalement.${RESET}"
    echo "${BLUE}Version de Composer :${RESET}"
    echo "${YELLOW}$(composer --version)${RESET}"
    echo "${BLUE}Emplacement de Composer :${RESET}"
    echo "${YELLOW}$(command -v composer)${RESET}"
else
    echo "${RED}❌ Composer n'est pas installé globalement.${RESET}"
fi

echo "${CYAN}======================${RESET}"
