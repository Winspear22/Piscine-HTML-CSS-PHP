#!/bin/bash

url="$1"

if [[ ! $url == https://* ]]; then
    url="https://$1"
fi

curl -sI $url | grep "location" | cut -d ' ' -f 2