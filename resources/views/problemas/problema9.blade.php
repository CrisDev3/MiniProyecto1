/*
Solicitar un número (1 al 9) 
Generar o imprimir las 
15 primeras potencias 
del número ( 4 elevado 
a la 1, 4 elevado a la 
dos, …. 
Problema #9 
*/


@include('layouts.header')

@php
use App\Models\Validators;

$enviado = request()->isMethod('post');
$valor = request('valor');
$resultado = [];
$error = null;

if ($enviado) {
    if (!Validators::esNumeroPositivo($valor) || (int)$valor < 1 || (int)$valor > 9) {
        $error = "Por favor ingresa un número válido entre 1 y 9.";
    } else {
        $num = (int)Validators::aFloat($valor);
        for ($i = 1; $i <= 15; $i++) {
            $resultado[] = [
                'potencia' => $i,
                'valor' => $num ** $i
            ];
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 9 — 15 primeras potencias</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 9]) }}">
    @csrf
    <div class="mb-3">
      <label for="valor" class="form-label">Ingresa un número (1-9)</label>
      <input type="text" name="valor" id="valor" class="form-control" required value="{{ old('valor', $valor) }}">
    </div>
    <button class="btn btn-primary-custom">Calcular</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if ($error)
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Potencia</th>
            <th>Resultado</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resultado as $r)
          <tr>
            <td>{{ $r['potencia'] }}</td>
            <td>{{ $r['valor'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
