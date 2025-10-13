/*
Estación del Año 
Al ingresar la fecha, devolver 
la estación de año de acuerdo 
con la siguiente tabla (ver 
imagen de la estación del Año) 
Ver Referencia página #7 
Datos prueba. 
*/


@include('layouts.header')

@php
use App\Models\Validators;

$enviado = request()->isMethod('post');
$fecha = request('fecha');
$estacion = null;
$error = null;
$imagenEstacion = null; // Para guardar la ruta de la imagen

if ($enviado) {
    if (empty($fecha) || !Validators::esFechaValida($fecha)) {
        $error = "Por favor, ingresa una fecha válida.";
    } else {
        $mes = (int) date('m', strtotime($fecha));
        $dia = (int) date('d', strtotime($fecha));

        // Hemisferio norte
        if (($mes == 12 && $dia >= 21) || $mes == 1 || $mes == 2 || ($mes == 3 && $dia < 21)) {
            $estacion = "Invierno";
            $imagenEstacion = asset('images/invierno.jpg');
        } elseif (($mes == 3 && $dia >= 21) || $mes == 4 || $mes == 5 || ($mes == 6 && $dia < 21)) {
            $estacion = "Primavera";
            $imagenEstacion = asset('images/primavera.jpg');
        } elseif (($mes == 6 && $dia >= 21) || $mes == 7 || $mes == 8 || ($mes == 9 && $dia < 23)) {
            $estacion = "Verano";
            $imagenEstacion = asset('images/verano.jpg');
        } elseif (($mes == 9 && $dia >= 23) || $mes == 10 || $mes == 11 || ($mes == 12 && $dia < 21)) {
            $estacion = "Otoño";
            $imagenEstacion = asset('images/otono.jpg');
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 8 — Estación del Año</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 8]) }}">
    @csrf
    <div class="mb-3">
      <label for="fecha" class="form-label">Ingresa una fecha</label>
      <input type="date" name="fecha" id="fecha" class="form-control" required value="{{ old('fecha', $fecha) }}">
    </div>

    <button class="btn btn-primary-custom">Calcular Estación</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if ($error)
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <div class="alert alert-success text-center">
        📅 Fecha ingresada: <strong>{{ date('d/m/Y', strtotime($fecha)) }}</strong><br>
        🌤️ Estación correspondiente: <strong>{{ $estacion }}</strong>
        <br><br>
        @if($imagenEstacion)
          <img src="{{ $imagenEstacion }}" alt="{{ $estacion }}" style="max-width: 300px; border-radius: 8px;">
        @endif
      </div>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
