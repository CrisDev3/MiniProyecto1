@include('layouts.header')

@php
use App\Models\Validators;

$enviado = request()->isMethod('post');
$resultado = null;
$n = request('n');
$error = null;

if ($enviado) {
    if (!Validators::esNumeroPositivo($n)) {
        $error = "Por favor ingresa un número válido.";
    } else {
        $num = (int)Validators::aFloat($n);
        $suma = 0;
        for ($i=2; $i <= $num; $i+=2) {
            $suma += $i;
        }
        $resultado = "La suma de los números pares hasta {$num} es {$suma}.";
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 7 — Suma de Números Pares</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 7]) }}">
    @csrf
    <div class="mb-3">
      <label for="n" class="form-label">Ingrese un número entero</label>
      <input type="text" name="n" id="n" class="form-control" required value="{{ old('n') }}">
    </div>
    <button class="btn btn-primary-custom">Calcular</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if ($error)
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <div class="alert alert-success">{{ $resultado }}</div>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')

