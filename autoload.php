<?php

spl_autoload_register(function ($className) {
    if (0 !== strpos($className, 'Gilbite\OOExercise')) {
        return false;
    }

    $exploded = explode('\\', $className);

    // i mean [2:]
    array_shift($exploded);
    array_shift($exploded);
    $path = implode(DIRECTORY_SEPARATOR, array_merge([__DIR__], $exploded)) . '.php';
    if (!file_exists($path)) {
        return false;
    }

    require_once $path;
});

