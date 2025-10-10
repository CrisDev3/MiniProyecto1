@include('layouts.header')

<div class="card-app">
  <h3 class="text-danger mb-3">Problema 8 — (Plantilla)</h3>
  <p>Ejemplo de estructura básica para nuevos problemas.</p>

  <form method="post" action="{{ route('problema.show', ['p' => 8]) }}">
    @csrf
    <div class="mb-3">
      <label for="valor" class="form-label">Ingresa un valor</label>
      <input type="text" name="valor" id="valor" class="form-control">
    </div>
    <button class="btn btn-primary-custom">Enviar</button>
    <a href="{{ route('menu') }}" class="btn btn-secondary">Volver</a>
  </form>

  @if (request()->isMethod('post'))
    <hr>
    <div class="alert alert-info">Resultado pendiente de implementación.</div>
  @endif
</div>

@include('partials.firma', ['p' => $p])
@include('layouts.footer')

