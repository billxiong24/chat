#!/bin/bash

files=$(find -name "*.php" -print)
count=0
for file in $files; do
    info=$(wc -l $file);
    echo $info
    num=$(echo $info | grep -oP '^[0-9]+')
    count=$(($count+$num))
done
echo $count
