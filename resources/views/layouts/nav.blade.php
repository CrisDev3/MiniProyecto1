<div class="row g-3 mb-4">
  @for ($i = 1; $i <= 10; $i++)
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card problem-card h-100">
        <div class="card-body d-flex flex-column justify-content-between">
          <div>
            <small class="text-muted">Problema #{{ $i }}</small>
            <h6 class="mt-2">Ejercicio {{ $i }}</h6>
          </div>
          <div class="mt-3 d-flex justify-content-between align-items-center">
            <a href="{{ route('problema.show', ['p' => $i]) }}" class="btn btn-gradient btn-sm">Abrir</a>
            <span class="badge bg-light text-muted">#{{ $i }}</span>
          </div>
        </div>
      </div>
    </div>
  @endfor
</div>
