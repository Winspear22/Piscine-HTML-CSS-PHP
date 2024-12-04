#!/bin/bash

# Couleurs
GREEN="\033[0;32m"
RED="\033[0;31m"
YELLOW="\033[0;33m"
BLUE="\033[0;34m"
CYAN="\033[0;36m"
RESET="\033[0m"

echo -e "${CYAN}========================"
echo -e "Vérification de Composer"
echo -e "========================${RESET}"

# Vérifie si Composer est installé
if command -v composer >/dev/null 2>&1; then
    echo -e "${GREEN}✅ Composer est installé globalement.${RESET}"
    echo -e "${BLUE}Version de Composer :${RESET}"
    echo -e "${YELLOW}$(composer --version)${RESET}"
    echo -e "${BLUE}Emplacement de Composer :${RESET}"
    echo -e "${YELLOW}$(command -v composer)${RESET}"
else
    echo -e "${RED}❌ Composer n'est pas installé globalement.${RESET}"
fi

echo -e "${CYAN}======================${RESET}"
