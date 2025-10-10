@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$resultado = [];
$valor = request('numero');
$error = '';

if ($enviado) {
    if (!Validators::esNumeroPositivo($valor)) {
        $error = "Por favor ingresa un número válido positivo.";
    } else {
        $n = (int)Validators::aFloat($valor); // Convertimos a entero
        $resultado = [];
        for ($i = 1; $i <= $n; $i++) {
            $resultado[] = "4 × {$i} = " . (4 * $i);
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 3 — N primeros múltiplos de 4</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 3]) }}">
    @csrf
    <div class="mb-3">
      <label for="numero" class="form-label">Número N</label>
      <input type="text" name="numero" id="numero" class="form-control" required value="{{ old('numero') }}">
    </div>
    <button class="btn btn-primary-custom">Generar múltiplos</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if (!empty($error))
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <div class="alert alert-success">
        @foreach ($resultado as $r)
          <div>{{ $r }}</div>
        @endforeach
      </div>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
