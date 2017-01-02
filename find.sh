#!/bin/bash
files=$(find -name "*.php" -print);

for file in $files; do
    if [ ! -d "$file" ]; then
        echo "$file";
        cat "$file" | grep -E '(load_chat_id|load_chat_users|load_chats)';
    fi
done;
