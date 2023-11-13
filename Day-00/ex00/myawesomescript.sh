#!/bin/bash

curl -sI "$1" | grep "location" | cut -d ' ' -f 2