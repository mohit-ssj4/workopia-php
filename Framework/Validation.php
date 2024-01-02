<?php

namespace Framework;

class Validation
{
    /**
     * Validates a string
     */
    public static function string(string $value, int $min = 1, float $max = INF): bool
    {
        $length = strlen(trim($value));

        return $length >= $min && $length <= $max;
    }

    /**
     * Validates an email
     */
    public static function email(string $value): mixed
    {
        return filter_var(trim($value), FILTER_VALIDATE_EMAIL);
    }

    /**
     * Matches a value against another
     */
    public static function match(string $value1, string $value2): bool
    {
        return trim($value1) === trim($value2);
    }
}