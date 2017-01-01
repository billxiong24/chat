#!/bin/bash
files=$(ls);

for file in $files; do
    if [ ! -d "$file" ]; then
        echo "$file";
        cat "$file" | grep "\$_SESSION\['manager'\]";
    fi
done;
