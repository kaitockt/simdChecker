<?php

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $paths = [
        "classes/",
        "classes/model/",
        "classes/view/",
        "classes/contoler/"
    ];
    $extension = ".class.php";

    foreach($paths as $path){
        $fullPath = $path.$className.$extension;
        if(file_exists($fullPath)){
            include_once $fullPath;
            break;
        }
    }
}