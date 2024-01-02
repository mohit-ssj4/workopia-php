<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Gets the base path
 */
function basePath(string $path = ''): string
{
    return __DIR__ . '/' . $path;
}

/**
 * Loads a view
 */
function loadView(string $name, array $data = []): void
{
    $path = basePath("App/views/{$name}.view.php");
    if (file_exists($path)) {
        extract($data);
        require $path;
    } else {
        echo "View '{$name}' not found!";
    }
}

/**
 * Loads a partial
 */
function loadPartial(string $name, array $data = []): void
{
    $path = basePath("App/views/partials/{$name}.php");
    if (file_exists($path)) {
        extract($data);
        require $path;
    } else {
        echo "Partial '{$name}' not found!";
    }
}

/**
 * Formats the salary
 */
function formatSalary(string $salary): string
{
    return '$' . number_format(floatval($salary));
}

/**
 * Redirects to a given path
 */
#[NoReturn] function redirect(string $path = "/"): void
{
    header("Location: {$path}");
    exit();
}

/**
 * Inspect a value(s)
 */
function inspect(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect a value(s) and die
 */
#[NoReturn] function inspectAndDie(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

/**
 * Sanitizes the dirty data
 */
function sanitize(string $dirty): string
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}
