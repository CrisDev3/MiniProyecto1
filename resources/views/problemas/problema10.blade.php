@include('layouts.header')

@php
use App\Models\Validators;

$enviado = request()->isMethod('post');
$datos = [];
$resultado = [];
$error = null;

if ($enviado) {
    // Validar que todos los datos fueron enviados
    $vendedores = request('vendedores');
    if (!is_array($vendedores) || count($vendedores) == 0) {
        $error = "Por favor, ingresa al menos un vendedor con sus productos vendidos.";
    } else {
        // Inicializar matriz de ventas [producto][vendedor]
        $ventas = [];
        for ($p = 1; $p <= 5; $p++) {
            for ($v = 1; $v <= 4; $v++) {
                $ventas[$p][$v] = 0;
            }
        }

        // Procesar los datos enviados
        foreach ($vendedores as $vendedor) {
            $numV = (int)$vendedor['numero'];
            $productos = $vendedor['productos'] ?? [];
            foreach ($productos as $producto) {
                $numP = (int)$producto['numero'];
                $monto = (float)$producto['monto'];
                if ($numV >= 1 && $numV <= 4 && $numP >= 1 && $numP <= 5 && $monto > 0) {
                    $ventas[$numP][$numV] += $monto;
                }
            }
        }

        // Calcular totales
        $totalesProductos = [];
        $totalesVendedores = [1 => 0, 2 => 0, 3 => 0, 4 => 0];
        $granTotal = 0;

        for ($p = 1; $p <= 5; $p++) {
            $totalesProductos[$p] = array_sum($ventas[$p]);
            $granTotal += $totalesProductos[$p];
            for ($v = 1; $v <= 4; $v++) {
                $totalesVendedores[$v] += $ventas[$p][$v];
            }
        }

        $resultado = [
            'ventas' => $ventas,
            'totalesProductos' => $totalesProductos,
            'totalesVendedores' => $totalesVendedores,
            'granTotal' => $granTotal
        ];
    }
}
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 10 — Resumen de Ventas Mensuales</h3>

  <p class="text-muted">Ingrese los datos de ventas por vendedor y producto. Solo se consideran 4 vendedores (1–4) y 5 productos (1–5).</p>

  <form method="post" action="{{ route('problema.show', ['p' => 10]) }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Ingrese los datos en formato:</label>
      <ul>
        <li>Vendedor (1–4)</li>
        <li>Producto (1–5)</li>
        <li>Valor vendido (en USD)</li>
      </ul>
      <small class="text-muted">Puedes agregar varios registros de venta.</small>
    </div>

    <div id="vendedores-container">
      <div class="vendedor border p-3 mb-3 rounded">
        <h5>Vendedor 1</h5>
        <input type="hidden" name="vendedores[0][numero]" value="1">
        @for ($i = 1; $i <= 5; $i++)
          <div class="row mb-2">
            <div class="col-md-6">
              <label>Producto {{ $i }}</label>
            </div>
            <div class="col-md-6">
              <input type="number" step="0.01" min="0" name="vendedores[0][productos][{{ $i }}][numero]" value="{{ $i }}" hidden>
              <input type="number" step="0.01" min="0" class="form-control" placeholder="Monto vendido" name="vendedores[0][productos][{{ $i }}][monto]">
            </div>
          </div>
        @endfor
      </div>
    </div>

    <button type="button" class="btn btn-outline-primary" id="agregarVendedor">Agregar Vendedor</button>
    <button class="btn btn-primary-custom mt-3">Calcular Totales</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary mt-3">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    @if ($error)
      <div class="alert alert-danger">{{ $error }}</div>
    @else
      <h4 class="text-success">Tabla de Ventas Totales</h4>
      <table class="table table-bordered text-center mt-3">
        <thead class="table-light">
          <tr>
            <th>Producto</th>
            @for ($v = 1; $v <= 4; $v++)
              <th>Vendedor {{ $v }}</th>
            @endfor
            <th>Total Producto</th>
          </tr>
        </thead>
        <tbody>
          @for ($p = 1; $p <= 5; $p++)
          <tr>
            <td>{{ $p }}</td>
            @for ($v = 1; $v <= 4; $v++)
              <td>{{ number_format($resultado['ventas'][$p][$v], 2) }}</td>
            @endfor
            <td><strong>{{ number_format($resultado['totalesProductos'][$p], 2) }}</strong></td>
          </tr>
          @endfor
          <tr class="table-secondary">
            <td><strong>Total Vendedor</strong></td>
            @for ($v = 1; $v <= 4; $v++)
              <td><strong>{{ number_format($resultado['totalesVendedores'][$v], 2) }}</strong></td>
            @endfor
            <td><strong>{{ number_format($resultado['granTotal'], 2) }}</strong></td>
          </tr>
        </tbody>
      </table>
    @endif
  @endif
</div>

<script>
let contador = 1;
document.getElementById('agregarVendedor').addEventListener('click', () => {
  if (contador >= 4) {
    alert("Solo se permiten hasta 4 vendedores.");
    return;
  }
  const contenedor = document.getElementById('vendedores-container');
  const nuevo = document.createElement('div');
  nuevo.classList.add('vendedor', 'border', 'p-3', 'mb-3', 'rounded');
  nuevo.innerHTML = `
    <h5>Vendedor ${contador + 1}</h5>
    <input type="hidden" name="vendedores[${contador}][numero]" value="${contador + 1}">
    ${Array.from({length: 5}, (_, i) => `
      <div class="row mb-2">
        <div class="col-md-6">
          <label>Producto ${i + 1}</label>
        </div>
        <div class="col-md-6">
          <input type="number" step="0.01" min="0" name="vendedores[${contador}][productos][${i + 1}][numero]" value="${i + 1}" hidden>
          <input type="number" step="0.01" min="0" class="form-control" placeholder="Monto vendido" name="vendedores[${contador}][productos][${i + 1}][monto]">
        </div>
      </div>
    `).join('')}
  `;
  contenedor.appendChild(nuevo);
  contador++;
});
</script>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')