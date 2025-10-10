<?php
namespace App\Models;

class Validators
{
    public static function esNumeroPositivo($v): bool
    {
        if (is_null($v)) return false;
        $v = trim((string)$v);
        if ($v === '') return false;
        $normal = str_replace(',', '.', $v);
        if (filter_var($normal, FILTER_VALIDATE_FLOAT) === false) return false;
        return (float)$normal > 0;
    }

    public static function aFloat($v): float
    {
        return (float) str_replace(',', '.', trim((string)$v));
    }

    public static function e(string $s): string
    {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    public static function esEnteroPositivo($v): bool
    {
        $v = trim((string)$v);
        return preg_match('/^[1-9]\d*$/', $v) === 1;
    }
}
