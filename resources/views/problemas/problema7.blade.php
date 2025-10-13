/*
Calculadora de Datos 
Estadísticos 
Pedir la cantidad de notas que 
desea ingresar el usuario. 
Luego pedir esas notas y 
calcular el promedio, la 
desviación estándar, la nota, 
mínima y la máxima. Usar 
foreach (o un ciclo que recorra 
una colección).
*/


@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$pasoNotas = false;
$cantidad = request('n');
$notas = [];
$errores = [];
$resultado = null;

if ($enviado) {
    // Paso 1: El usuario solo ingresó la cantidad de notas
    if (request()->has('n') && !request()->has('nota1')) {
        if (!Validators::esNumeroPositivo($cantidad) || (int)$cantidad == 0) {
            $errores[] = "Por favor ingresa un número válido de notas.";
        } else {
            $pasoNotas = true; // Mostramos los inputs de las notas
        }
    }
    // Paso 2: El usuario ya ingresó las notas
    elseif (request()->has('nota1')) {
        $cantidad = (int)Validators::aFloat($cantidad);
        for ($i = 1; $i <= $cantidad; $i++) {
            $v = request("nota{$i}");
            if (!Validators::esNumeroPositivo($v)) {
                $errores[] = "La nota {$i} no es válida.";
            } else {
                $notas[] = Validators::aFloat($v);
            }
        }

        if (!$errores) {
            $resultado = [
                'media' => Utils::media($notas),
                'desviacion' => Utils::desviacion($notas),
                'min' => Utils::minimo($notas),
                'max' => Utils::maximo($notas),
            ];
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 7 — Calculadora de Datos Estadísticos</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 7]) }}">
    @csrf

    @if (!$pasoNotas)
      <div class="mb-3">
        <label for="n" class="form-label">Cantidad de notas a ingresar</label>
        <input type="text" name="n" id="n" class="form-control" required value="{{ old('n', $cantidad) }}">
      </div>
      <button class="btn btn-primary-custom mt-2">Ingresar Notas</button>
    @else
      @for ($i = 1; $i <= $cantidad; $i++)
        <div class="mb-3">
          <label class="form-label">Nota {{$i}}</label>
          <input type="text" name="nota{{$i}}" class="form-control" required value="{{ old("nota{$i}") }}">
        </div>
      @endfor
      <input type="hidden" name="n" value="{{ $cantidad }}">
      <button class="btn btn-primary-custom mt-2">Calcular Estadísticas</button>
    @endif

    <a href="{{ route('menu') }}" class="btn btn-secondary mt-2">Volver</a>
  </form>

  @if ($enviado && $resultado)
    <hr>
    <div class="alert alert-success">
      <ul>
        <li>Media: {{ number_format($resultado['media'], 2, ',', '.') }}</li>
        <li>Desviación estándar: {{ number_format($resultado['desviacion'], 2, ',', '.') }}</li>
        <li>Mínimo: {{ number_format($resultado['min'], 2, ',', '.') }}</li>
        <li>Máximo: {{ number_format($resultado['max'], 2, ',', '.') }}</li>
      </ul>
    </div>
  @elseif($errores)
    <div class="alert alert-danger">
      @foreach ($errores as $e)
        <div>⚠️ {{ $e }}</div>
      @endforeach
    </div>
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
