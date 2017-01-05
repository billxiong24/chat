#!/bin/bash
files=$(find -name "*.php" -print);

for file in $files; do
    if [ ! -d "$file" ]; then
        echo "$file";
        cat "$file" | grep -E 'load_last_id';
    fi
done;
