@include('layouts.header')

@php
use App\Models\Validators;
use App\Models\Utils;

$enviado = request()->isMethod('post');
$notas = [];
$errores = [];
$resultado = null;

if ($enviado) {
    for ($i = 1; $i <= 5; $i++) {
        $v = request("nota{$i}");
        if (!Validators::esNumeroPositivo($v)) {
            $errores[] = "La nota {$i} no es válida.";
        } else {
            $nota = Validators::aFloat($v);
            if ($nota > 100) $errores[] = "La nota {$i} no puede ser mayor que 100.";
            else $notas[] = $nota;
        }
    }

    if (!$errores) {
        $prom = Utils::media($notas);
        $resultado = $prom >= 71
            ? "Aprobado con promedio de {$prom}"
            : "Reprobado con promedio de {$prom}";
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 5 — Promedio de Notas</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 5]) }}">
    @csrf
    <div class="row g-3">
      @for ($i=1; $i<=5; $i++)
      <div class="col-md-2">
        <label class="form-label">Nota {{$i}}</label>
        <input type="text" name="nota{{$i}}" class="form-control" required value="{{ old("nota{$i}") }}">
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
      <div class="alert alert-success">{{ $resultado }}</div>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')

