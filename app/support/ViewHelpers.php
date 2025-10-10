<?php
namespace App\Support;

class ViewHelpers
{
    public static function num($n, int $dec = 2): string
    {
        return number_format((float)$n, $dec, ',', '.');
    }

    public static function e(string $s): string
    {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    public static function backLink(string $label = 'Volver al menú'): string
    {
        $url = route('menu');
        $labelEsc = self::e($label);
        return "<a href=\"{$url}\" class=\"btn btn-outline-secondary mt-3\">{$labelEsc}</a>";
    }
}
