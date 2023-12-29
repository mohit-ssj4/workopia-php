<?php

use JetBrains\PhpStorm\NoReturn;

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
 * @param array $data
 */
function loadView(string $name, array $data = []): void
{
    $path = basePath("views/{$name}.view.php");
    if (file_exists($path)) {
        extract($data);
        require $path;
    } else {
        echo "View '{$name}' not found!";
    }
}

/**
 * Loads a partial
 *
 * @param string $name
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

/**
 * Formats the salary
 *
 * @param string $salary
 * @return string
 */
function formatSalary(string $salary): string
{
    return '$' . number_format(floatval($salary));
}

/**
 * Navigates to index
 *
 * @param string $path
 * @return void
 */
#[NoReturn] function goToPath(string $path = "/"): void
{
    header("Location: {$path}");
    exit();
}

/**
 * Inspect a value(s)
 *
 * @param mixed $value
 */
function inspect(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * Inspect a value(s) and die
 *
 * @param mixed $value
 */
#[NoReturn] function inspectAndDie(mixed $value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}
