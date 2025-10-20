@php
    $autor = ($p % 2 == 0) ? 'Juan Carrion' : 'Cristopher Núñez';
    $fecha = date('d/m/Y');
@endphp

<div class="autor-card">
  <div class="icon">👨‍💻</div>
  <h6>Desarrollado por: {{ $autor }}</h6>
  <p class="mb-1 text-muted">Autor del Problema {{ $p }}</p>
  <small class="text-secondary">📅 Fecha: {{ $fecha }}</small>
</div>