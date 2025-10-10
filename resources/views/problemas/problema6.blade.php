@include('layouts.header')

@php
$enviado = request()->isMethod('post');
$presupuesto = request('presupuesto');
$errores = [];
$distribucion = [];

if ($enviado) {
    if (!is_numeric($presupuesto) || $presupuesto <= 0) {
        $errores[] = "Por favor ingresa un presupuesto válido.";
    } else {
        $total = (float)$presupuesto;
        $distribucion = [
            'Ginecología' => $total * 0.40,
            'Traumatología' => $total * 0.35,
            'Pediatría' => $total * 0.25,
        ];
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 6 — Distribución del Presupuesto Hospitalario</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 6]) }}">
    @csrf
    <div class="mb-3">
      <label for="presupuesto" class="form-label">Presupuesto anual del hospital (en $)</label>
      <input type="text" name="presupuesto" id="presupuesto" class="form-control" required value="{{ old('presupuesto') }}">
    </div>
    <button class="btn btn-primary-custom">Calcular distribución</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
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
      <table class="table table-bordered text-center mt-3">
        <thead class="table-light">
          <tr>
            <th>Área</th>
            <th>Porcentaje</th>
            <th>Monto ($)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($distribucion as $area => $monto)
          <tr>
            <td>{{ $area }}</td>
            <td>
              @if ($area == 'Ginecología') 40%
              @elseif ($area == 'Traumatología') 35%
              @else 25%
              @endif
            </td>
            <td>{{ number_format($monto, 2, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')
