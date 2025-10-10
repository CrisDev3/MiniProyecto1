@include('layouts.header')
@php
use App\Models\Utils;

$enviado = request()->isMethod('post');
$metodo = request()->input('metodo', 'for');
$n = 1000;
$resultado = null;
$explicacion = '';

if ($enviado) {
    switch ($metodo) {
        case 'for':
            $suma = 0;
            for ($i = 1; $i <= $n; $i++) $suma += $i;
            $resultado = $suma;
            $explicacion = "Suma con bucle for";
            break;
        case 'gauss':
            $resultado = Utils::sumaUnoAN($n);
            $explicacion = "Fórmula de Gauss";
            break;
    }
}
@endphp

<div class="card-app">
  <h3 class="text-primary mb-3">Problema 2 — Suma 1..1000</h3>

  <form method="post" class="mb-4">
    @csrf
    <div class="form-check">
      <input class="form-check-input" type="radio" name="metodo" value="for" id="for" {{ $metodo==='for' ? 'checked' : '' }}>
      <label for="for" class="form-check-label">Bucle for</label>
    </div>
    <div class="form-check mb-3">
      <input class="form-check-input" type="radio" name="metodo" value="gauss" id="gauss" {{ $metodo==='gauss' ? 'checked' : '' }}>
      <label for="gauss" class="form-check-label">Fórmula de Gauss</label>
    </div>

    <button class="btn-gradient">Calcular</button>
    {!! \App\Support\ViewHelpers::backLink() !!}
  </form>

  @if ($enviado)
    <div class="alert alert-success">Resultado: <strong>{{ number_format($resultado, 0, ',', '.') }}</strong></div>
    <p class="text-muted">Método: {{ $explicacion }}</p>
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')

