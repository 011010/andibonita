@extends('layouts.admin')

@section('title', 'Reportes REAC')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Reportes REAC</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Reportes REAC</h1>
        <p class="page-subtitle">Gestión de Reportes de Actividades de Tutoría</p>
    </div>
    <div>
        <a href="{{ route('reac.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Nuevo Reporte
        </a>
    </div>
</div>

{{-- Stats Cards --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total REACs</h6>
                        <h3 class="mb-0">{{ $reacs->total() }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-file-earmark-text text-primary" style="font-size: 1.5rem;"></i>
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
                        <h6 class="text-muted mb-1">Borradores</h6>
                        <h3 class="mb-0">{{ $reacs->where('estado', 'borrador')->count() }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-pencil-square text-warning" style="font-size: 1.5rem;"></i>
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
                        <h6 class="text-muted mb-1">Enviados</h6>
                        <h3 class="mb-0">{{ $reacs->where('estado', 'enviado')->count() }}</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="bi bi-send-check text-info" style="font-size: 1.5rem;"></i>
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
                        <h6 class="text-muted mb-1">Aprobados</h6>
                        <h3 class="mb-0">{{ $reacs->where('estado', 'aprobado')->count() }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-check-circle text-success" style="font-size: 1.5rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reac.index') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Buscar por tutor o semestre..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="estado" class="form-select">
                    <option value="">Todos los estados</option>
                    <option value="borrador" {{ request('estado') == 'borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="enviado" {{ request('estado') == 'enviado' ? 'selected' : '' }}>Enviado</option>
                    <option value="revisado" {{ request('estado') == 'revisado' ? 'selected' : '' }}>Revisado</option>
                    <option value="aprobado" {{ request('estado') == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                    <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="division" class="form-select">
                    <option value="">Todas las divisiones</option>
                    {{-- Aquí se cargarían las divisiones dinámicamente --}}
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search me-1"></i>Filtrar
                </button>
                <a href="{{ route('reac.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Limpiar
                </a>
            </div>
        </form>
    </div>
</div>

{{-- REACs Table --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Listado de Reportes</h5>
    </div>
    <div class="card-body p-0">
        @if($reacs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tutor</th>
                            <th>División</th>
                            <th>Semestre/Grupo</th>
                            <th>Tutorados</th>
                            <th>Fecha Entrega</th>
                            <th>Sesiones</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reacs as $reac)
                            <tr>
                                <td><strong>#{{ $reac->id }}</strong></td>
                                <td>
                                    <div>
                                        <div class="fw-semibold">{{ $reac->tutor }}</div>
                                        @if($reac->tutore)
                                            <small class="text-muted">{{ $reac->tutore->correoelectronico }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($reac->divisionRelacion)
                                        <span class="badge bg-secondary">{{ $reac->divisionRelacion->codigo }}</span>
                                    @else
                                        <span class="text-muted">{{ $reac->division }}</span>
                                    @endif
                                </td>
                                <td>{{ $reac->semestre_grupo }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $reac->num_tutorados }} estudiantes</span>
                                </td>
                                <td>{{ $reac->fecha_entrega->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $reac->sesiones->count() }} sesiones</span>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match($reac->estado) {
                                            'borrador' => 'bg-warning',
                                            'enviado' => 'bg-info',
                                            'revisado' => 'bg-primary',
                                            'aprobado' => 'bg-success',
                                            'rechazado' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ ucfirst($reac->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('reac.show', $reac->id) }}"
                                           class="btn btn-outline-primary"
                                           title="Ver detalle">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('reac.pdf', $reac->id) }}"
                                           class="btn btn-outline-danger"
                                           title="Descargar PDF"
                                           target="_blank">
                                            <i class="bi bi-file-pdf"></i>
                                        </a>

                                        @if($reac->esEditable())
                                            <a href="{{ route('reac.edit', $reac->id) }}"
                                               class="btn btn-outline-warning"
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif

                                        @if($reac->estado !== 'aprobado')
                                            <button type="button"
                                                    class="btn btn-outline-danger"
                                                    title="Eliminar"
                                                    onclick="confirmDeleteReac({{ $reac->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Mostrando {{ $reacs->firstItem() }} a {{ $reacs->lastItem() }} de {{ $reacs->total() }} registros
                    </div>
                    <div>
                        {{ $reacs->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                <h5 class="mt-3 text-muted">No hay reportes REAC</h5>
                <p class="text-muted">Comienza creando tu primer reporte de actividades.</p>
                <a href="{{ route('reac.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle me-2"></i>Crear Primer Reporte
                </a>
            </div>
        @endif
    </div>
</div>

{{-- Delete Form (Hidden) --}}
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function confirmDeleteReac(reacId) {
    if (confirm('¿Estás seguro de que deseas eliminar este REAC?\n\nEsta acción no se puede deshacer.')) {
        const form = document.getElementById('delete-form');
        form.action = `/reac/${reacId}`;
        form.submit();
    }
}
</script>
@endpush
