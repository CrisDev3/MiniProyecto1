@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$sumaPares = 0;
$sumaImpares = 0;

if ($enviado) {
    // Rango fijo de 1 a 200
    for ($i = 1; $i <= 200; $i++) {
        if ($i % 2 === 0) {
            $sumaPares += $i;
        } else {
            $sumaImpares += $i;
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 4 — Suma de pares e impares (1..200)</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 4]) }}">
    @csrf
    <p>Este cálculo se realiza automáticamente para los números del 1 al 200.</p>
    <button class="btn btn-primary-custom">Calcular</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    <div class="alert alert-success">
      <div>Suma de números pares: <strong>{{ number_format($sumaPares, 0, ',', '.') }}</strong></div>
      <div>Suma de números impares: <strong>{{ number_format($sumaImpares, 0, ',', '.') }}</strong></div>
    </div>
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
