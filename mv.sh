#!/bin/bash

for i in *; do
    if [[ "$i" =~ "Controller" ]]; then
        mv "$i" controller;
    fi
done
