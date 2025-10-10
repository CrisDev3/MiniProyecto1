<?php
namespace App\Models;

class Utils
{
    public static function media(array $xs): float {
        return count($xs) ? array_sum($xs) / count($xs) : 0.0;
    }

    public static function desviacion(array $xs): float {
        $n = count($xs);
        if ($n === 0) return 0.0;
        $m = self::media($xs);
        $acc = 0.0;
        foreach ($xs as $x) $acc += ($x - $m) ** 2;
        return sqrt($acc / $n);
    }

    public static function minimo(array $xs) {
        return empty($xs) ? null : min($xs);
    }

    public static function maximo(array $xs) {
        return empty($xs) ? null : max($xs);
    }

    public static function sumaUnoAN(int $n): int {
        return (int)(($n * ($n + 1)) / 2);
    }

    public static function esPar(int $n): bool {
        return $n % 2 === 0;
    }

    public static function esPrimo(int $n): bool {
        if ($n < 2) return false;
        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i === 0) return false;
        }
        return true;
    }
}
