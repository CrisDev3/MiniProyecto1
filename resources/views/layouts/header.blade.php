<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MiniProyecto1 — Resolviendo estructuras de control</title>
  @vite(['resources/js/app.js', 'resources/css/app.css'])
  <link rel="icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('menu') }}">
        <div class="brand">
          <div class="logo">M1</div>
          <div>
            <div class="fw-bold" style="color:var(--brand)">MiniProyecto1</div>
            <div class="small text-muted">Sentencias de Control y Clases — UTP</div>
          </div>
        </div>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item me-2"><a class="nav-link" href="{{ route('menu') }}">Menú</a></li>
          <li class="nav-item me-2"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal">Instrucciones</a></li>
          <li class="nav-item"><a class="btn btn-outline-primary" href="https://github.com/tu-repo" target="_blank">Repositorio</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-4">
    <div class="hero p-3">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h2 class="mb-0" style="color:var(--brand)">Resolviendo problemas con estructuras de control</h2>
          <div class="small text-muted">If -> Switch -> Loops -> Funciones -> Clases</div>
        </div>
        <div class="text-end d-none d-md-block">
          <small class="text-muted">Profesor: Ing. Irina Fong</small>
        </div>
      </div>
    </div>

    <!-- modal info (small instructions) -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Indicaciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>Selecciona un problema para ver el formulario y la solución. Recuerda usar entradas válidas. Todos los formularios usan CSRF y sanitización.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
