<?php
namespace App\Support;

class ViewHelpers
{
    /**
     * Formatea un número con decimales usando coma como separador decimal.
     */
    public static function num($n, int $dec = 2): string
    {
        return number_format((float)$n, $dec, ',', '.');
    }

    /**
     * Escapa cadenas HTML de forma segura.
     */
    public static function e(string $s): string
    {
        return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Devuelve un enlace HTML para "Volver al menú" (usa la ruta named 'menu').
     * Se usa en vistas como: {!! \App\Support\ViewHelpers::backLink() !!}
     */
    public static function backLink(string $label = 'Volver al menú'): string
    {
        $url = route('menu');
        $labelEsc = self::e($label);
        return "<a href=\"{$url}\" class=\"btn btn-outline-secondary\">{$labelEsc}</a>";
    }

    /**
     * Devuelve una clase CSS si condición es verdadera.
     */
    public static function cssIf(bool $cond, string $class): string
    {
        return $cond ? $class : '';
    }
}
