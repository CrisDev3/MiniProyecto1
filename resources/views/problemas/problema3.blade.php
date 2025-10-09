@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$resultado = null;
$valor = request('numero');

if ($enviado) {
    if (!Validators::esNumeroPositivo($valor)) {
        $error = "Por favor ingresa un número válido.";
    } else {
        $n = Validators::aFloat($valor);
        $resultado = Utils::esPar((int)$n)
            ? "El número {$n} es par."
            : "El número {$n} es impar.";
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 3 — Número Par o Impar</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 3]) }}">
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
