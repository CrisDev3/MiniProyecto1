<?php
namespace App\Http\Controllers;

class ProblemaController extends Controller
{
    public function show(int $p)
    {
        if ($p < 1 || $p > 10) {
            return redirect()->route('menu');
        }
        return view("problemas.problema{$p}", ['p' => $p]);
    }
}
