<?php

/**
 * Gets the base path
 *
 * @param string $path
 * @return string
 */
function basePath(string $path = ''): string
{
    return __DIR__ . '/' . $path;
}

/**
 * Loads a view
 *
 * @param string $name
 * @return void
 */
function loadView(string $name): void
{
    $path = basePath("views/{$name}.view.php");
    if (file_exists($path)) {
        require $path;
    } else {
        echo "View '{$name}' not found!";
    }
}

/**
 * Loads a partial
 *
 * @param string $name
 * @return void
 */
function loadPartial(string $name): void
{
    $path = basePath("views/partials/{$name}.php");
    if (file_exists($path)) {
        require $path;
    } else {
        echo "Partial '{$name}' not found!";
    }
}