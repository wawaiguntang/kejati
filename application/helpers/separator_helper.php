<?php

function separator(string $path){
    if (stripos(PHP_OS, "WIN") === 0) {
        return str_replace('/','\\',$path);
    } else {
        return str_replace('\\','/',$path);
    }
}