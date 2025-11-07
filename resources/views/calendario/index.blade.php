@extends('layouts.admin')

@section('title', 'Calendarios de Tutorías')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Calendarios</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Calendarios de Tutorías</h1>
        <p class="page-subtitle">Gestión de calendarios académicos y fechas importantes</p>
    </div>
    <div>
        <a href="{{ route('calendario.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Nuevo Calendario
        </a>
    </div>
</div>

{{-- Estadísticas --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Calendarios</h6>
                        <h3 class="mb-0">{{ $calendarios->total() }}</h3>
                    </div>
                    <div class="stat-icon bg-primary">
                        <i class="bi bi-calendar3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Periodo Actual</h6>
                        <h5 class="mb-0">
                            @php
                                $actual = $calendarios->firstWhere('periodo', 'like', '%' . date('Y') . '%');
                            @endphp
                            {{ $actual ? $actual->periodo : 'N/A' }}
                        </h5>
                    </div>
                    <div class="stat-icon bg-info">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Próxima Entrega</h6>
                        <h5 class="mb-0">
                            @php
                                $proxima = $calendarios->where('fecha_entrega', '>=', now())->sortBy('fecha_entrega')->first();
                            @endphp
                            {{ $proxima ? $proxima->fecha_entrega->format('d/m/Y') : 'N/A' }}
                        </h5>
                    </div>
                    <div class="stat-icon bg-warning">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Este Año</h6>
                        <h3 class="mb-0">{{ $calendarios->filter(fn($c) => $c->created_at->year == date('Y'))->count() }}</h3>
                    </div>
                    <div class="stat-icon bg-success">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabla de Calendarios --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-table me-2"></i>Lista de Calendarios</h5>
    </div>
    <div class="card-body">
        @if($calendarios->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Documento</th>
                            <th>Periodo</th>
                            <th>Fecha Entrega</th>
                            <th>Inicio Tutorías</th>
                            <th>Fin Tutorías</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($calendarios as $calendario)
                            <tr>
                                <td><strong>#{{ $calendario->id }}</strong></td>
                                <td>{{ Str::limit($calendario->documento, 30) }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $calendario->periodo }}</span>
                                </td>
                                <td>
                                    <i class="bi bi-calendar-event text-primary me-1"></i>
                                    {{ $calendario->fecha_entrega->format('d/m/Y') }}
                                </td>
                                <td>
                                    @if($calendario->inicio_tutorias)
                                        {{ \Carbon\Carbon::parse($calendario->inicio_tutorias)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($calendario->fin_tutorias)
                                        {{ \Carbon\Carbon::parse($calendario->fin_tutorias)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('calendario.show', $calendario->id) }}"
                                           class="btn btn-outline-primary"
                                           title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('calendario.pdf', $calendario->id) }}"
                                           class="btn btn-outline-danger"
                                           title="Descargar PDF"
                                           target="_blank">
                                            <i class="bi bi-file-pdf"></i>
                                        </a>
                                        <a href="{{ route('calendario.edit', $calendario->id) }}"
                                           class="btn btn-outline-warning"
                                           title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger"
                                                title="Eliminar"
                                                onclick="confirmarEliminacion({{ $calendario->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <form id="delete-form-{{ $calendario->id }}"
                                          action="{{ route('calendario.destroy', $calendario->id) }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="mt-3">
                {{ $calendarios->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 4rem; color: #dee2e6;"></i>
                <h5 class="text-muted mt-3">No hay calendarios registrados</h5>
                <p class="text-muted">Comienza creando un nuevo calendario académico</p>
                <a href="{{ route('calendario.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Crear Primer Calendario
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmarEliminacion(id) {
    if (confirm('¿Está seguro de que desea eliminar este calendario? Esta acción no se puede deshacer.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush
