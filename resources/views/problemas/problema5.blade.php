@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$edades = [];
$errores = [];
$resultado = [];
$estadisticas = [
    'Niño' => 0,
    'Adolescente' => 0,
    'Adulto' => 0,
    'Adulto mayor' => 0,
];

if ($enviado) {
    for ($i = 1; $i <= 5; $i++) {
        $v = request("edad{$i}");
        if (!Validators::esNumeroPositivo($v)) {
            $errores[] = "La edad {$i} no es válida.";
        } else {
            $edad = (int)Validators::aFloat($v);
            $edades[] = $edad;

            // Clasificación por categoría
            if ($edad >= 0 && $edad <= 12) {
                $categoria = 'Niño';
            } elseif ($edad >= 13 && $edad <= 17) {
                $categoria = 'Adolescente';
            } elseif ($edad >= 18 && $edad <= 64) {
                $categoria = 'Adulto';
            } else {
                $categoria = 'Adulto mayor';
            }

            $resultado[] = "Persona {$i}: {$edad} años — {$categoria}";
            $estadisticas[$categoria]++;
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 5 — Clasificación de edades</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 5]) }}">
    @csrf
    <div class="row g-3">
      @for ($i=1; $i<=5; $i++)
      <div class="col-md-2">
        <label class="form-label">Edad {{$i}}</label>
        <input type="text" name="edad{{$i}}" class="form-control" required value="{{ old("edad{$i}") }}">
      </div>
      @endfor
    </div>
    <button class="btn btn-primary-custom mt-3">Calcular</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if ($errores)
      <div class="alert alert-danger">
        @foreach ($errores as $e)
          <div>⚠️ {{ $e }}</div>
        @endforeach
      </div>
    @else
      <div class="alert alert-success">
        @foreach ($resultado as $r)
          <div>{{ $r }}</div>
        @endforeach
        <hr>
        <h6>Estadísticas de categorías:</h6>
        <ul>
          @foreach ($estadisticas as $cat => $cant)
            <li>{{ $cat }}: {{ $cant }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
