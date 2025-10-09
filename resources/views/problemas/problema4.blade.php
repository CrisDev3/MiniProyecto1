@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$resultado = null;
$n = request('numero');

if ($enviado) {
    if (!Validators::esNumeroPositivo($n)) {
        $error = "El valor ingresado no es un número válido.";
    } else {
        $num = (int)Validators::aFloat($n);
        $resultado = Utils::esPrimo($num)
            ? "El número {$num} es primo."
            : "El número {$num} no es primo.";
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 4 — Número Primo</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 4]) }}">
    @csrf
    <div class="mb-3">
      <label for="numero" class="form-label">Número</label>
      <input type="text" name="numero" id="numero" class="form-control" required value="{{ old('numero') }}">
    </div>
    <button class="btn btn-primary-custom">Verificar</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if (!empty($error))
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <div class="alert alert-success">{{ $resultado }}</div>
    @endif
  @endif
</div>

@include('layouts.footer')
