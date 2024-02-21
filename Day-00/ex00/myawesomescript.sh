#!/usr/bin/sh

url="$1"

if echo "$url" | grep -q "^https://"; then
    final_url="$url"
    curl -sI "$final_url" | grep "location" | cut -d ' ' -f 2
else
    final_url="$url"
    curl -sI "$final_url" | grep "Location" | cut -d ' ' -f 2
fi