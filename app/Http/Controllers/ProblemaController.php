<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemaController extends Controller
{
    public function show(Request $request, int $p)
    {
        if ($p < 1 || $p > 10) {
            return redirect()->route('menu')->with('error', 'Problema no encontrado.');
        }

        $view = "problemas.problema{$p}";
        if (!view()->exists($view)) {
            return back()->with('error', "Vista del problema {$p} no disponible.");
        }

        return view($view);
    }
}
