#!/bin/bash
files=$(find -name "*.php" -print);

for file in $files; do
    if [ ! -d "$file" ]; then
        echo "$file";
        cat "$file" | grep -F "last_notifs"
    fi
done;

