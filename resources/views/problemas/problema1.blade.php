@php
use App\Models\Validators;
use App\Models\Utils;

$errores = [];
$numeros = [];
$enviado = request()->isMethod('post');

if ($enviado) {
    for ($i = 1; $i <= 5; $i++) {
        $val = request("n{$i}");
        if (!Validators::esNumeroPositivo($val)) {
            $errores[] = "El número {$i} no es válido.";
        } else {
            $numeros[] = Validators::aFloat($val);
        }
    }
}
@endphp

@include('layouts.header')

<div class="card-app">
  <h3 class="mb-3 text-danger">Problema 1 — Estadística simple</h3>

  @if ($enviado && $errores)
    <div class="alert alert-danger">
      @foreach ($errores as $e)
        <div>⚠️ {{ $e }}</div>
      @endforeach
    </div>
  @endif

  <form method="post" action="{{ route('problema.show', ['p' => 1]) }}">
    @csrf
    <div class="row g-3">
      @for ($i=1; $i<=5; $i++)
      <div class="col-md-2">
        <label for="n{{$i}}" class="form-label">Número {{$i}}</label>
        <input type="text" name="n{{$i}}" class="form-control" required value="{{ old("n{$i}") }}">
      </div>
      @endfor
    </div>
    <button class="btn btn-primary-custom mt-3">Calcular</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Volver</a>
  </form>

  @if ($enviado && !$errores)
    @php
      $media = Utils::media($numeros);
      $desv = Utils::desviacion($numeros);
      $min = Utils::minimo($numeros);
      $max = Utils::maximo($numeros);
    @endphp
    <hr>
    <h5>Resultados</h5>
    <ul>
      <li>Media: {{ number_format($media,2,',','.') }}</li>
      <li>Desviación estándar: {{ number_format($desv,2,',','.') }}</li>
      <li>Mínimo: {{ number_format($min,2,',','.') }}</li>
      <li>Máximo: {{ number_format($max,2,',','.') }}</li>
    </ul>
  @endif
</div>

@include('layouts.footer')
