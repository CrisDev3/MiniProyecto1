@include('layouts.header')

@php
$enviado = request()->isMethod('post');
@endphp

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 6 — Cuadrado y Cubo de 1 a 20</h3>

  <form method="post" action="{{ route('problema.show', ['p' => 6]) }}">
    @csrf
    <button class="btn btn-primary-custom">Mostrar</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if ($enviado)
    <hr>
    <table class="table table-bordered text-center">
      <thead class="table-light">
        <tr>
          <th>Número</th>
          <th>Cuadrado</th>
          <th>Cubo</th>
        </tr>
      </thead>
      <tbody>
        @for ($i=1; $i<=20; $i++)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $i ** 2 }}</td>
          <td>{{ $i ** 3 }}</td>
        </tr>
        @endfor
      </tbody>
    </table>
  @endif
</div>

@include('layouts.footer')
