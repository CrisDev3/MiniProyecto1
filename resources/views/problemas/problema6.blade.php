/*
En un hospital existen tres 
áreas: Ginecología, Pediatría y 
Traumatología. El presupuesto 
anual del hospital se reparte 
conforme a la siguiente tabla 
Ver Referencia página #7 
Integrar Gráficas. 
*/


@include('layouts.header')

@php
use App\Models\Validators;

$enviado = request()->isMethod('post');
$presupuesto = request('presupuesto');
$errores = [];
$resultados = [];
$porcentajes = [
    'Ginecología' => 0.40,
    'Pediatría' => 0.30,
    'Traumatología' => 0.30
];

if ($enviado) {
    if (!Validators::esNumeroPositivo($presupuesto)) {
        $errores[] = "Por favor ingresa un presupuesto válido (mayor que 0).";
    } else {
        $presupuesto = (float)$presupuesto;

        foreach ($porcentajes as $area => $porc) {
            $resultados[$area] = $presupuesto * $porc;
        }
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 6 — Distribución del Presupuesto Hospitalario</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 6]) }}">
    @csrf
    <div class="mb-3">
      <label for="presupuesto" class="form-label">Presupuesto anual (en dólares)</label>
      <input type="text" name="presupuesto" id="presupuesto" class="form-control" required value="{{ old('presupuesto', $presupuesto) }}">
    </div>
    <button class="btn btn-primary-custom">Calcular</button>
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
      <h5 class="mb-3">Distribución del presupuesto:</h5>
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Área</th>
            <th>Porcentaje</th>
            <th>Monto Asignado ($)</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resultados as $area => $monto)
          <tr>
            <td>{{ $area }}</td>
            <td>{{ number_format($porcentajes[$area] * 100, 0) }}%</td>
            <td>{{ number_format($monto, 2, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div style="max-width: 400px; margin: 0 auto;">
        <canvas id="graficoPresupuesto"></canvas>
      </div>

      {{-- Carga de Chart.js y configuración de gráfico --}}
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const ctx = document.getElementById('graficoPresupuesto').getContext('2d');
          new Chart(ctx, {
            type: 'pie',
            data: {
              labels: {!! json_encode(array_keys($resultados)) !!},
              datasets: [{
                data: {!! json_encode(array_values($resultados)) !!},
                backgroundColor: ['#f87171', '#60a5fa', '#34d399']
              }]
            },
            options: {
              plugins: {
                legend: { position: 'bottom' },
                title: {
                  display: true,
                  text: 'Distribución del Presupuesto Anual'
                }
              }
            }
          });
        });
      </script>
    @endif
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')