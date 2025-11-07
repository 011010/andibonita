@extends('layouts.admin')

@section('title', 'Detalle de Reporte REAC')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reac.index') }}">Reportes REAC</a></li>
    <li class="breadcrumb-item active">Reporte #{{ $reac->id }}</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Reporte REAC #{{ $reac->id }}</h1>
        <p class="page-subtitle">{{ $reac->semestre_grupo }} - {{ $reac->tutor }}</p>
    </div>
    <div class="d-flex gap-2">
        @if($reac->esEditable())
            <a href="{{ route('reac.edit', $reac->id) }}" class="btn btn-warning">
                <i class="bi bi-pencil me-2"></i>Editar
            </a>
        @endif

        <a href="{{ route('reac.pdf', $reac->id) }}" class="btn btn-danger" target="_blank">
            <i class="bi bi-file-pdf me-2"></i>Descargar PDF
        </a>

        <a href="{{ route('reac.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

{{-- Estado y Metadata --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-2">
                    @php
                        $badgeClass = match($reac->estado) {
                            'borrador' => 'bg-warning',
                            'enviado' => 'bg-info',
                            'revisado' => 'bg-primary',
                            'aprobado' => 'bg-success',
                            'rechazado' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        $icon = match($reac->estado) {
                            'borrador' => 'pencil-square',
                            'enviado' => 'send-check',
                            'revisado' => 'eye-fill',
                            'aprobado' => 'check-circle-fill',
                            'rechazado' => 'x-circle-fill',
                            default => 'circle'
                        };
                    @endphp
                    <i class="bi bi-{{ $icon }}" style="font-size: 2.5rem; color: var(--bs-{{ substr($badgeClass, 3) }});"></i>
                </div>
                <h6 class="text-muted mb-1">Estado</h6>
                <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($reac->estado) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-calendar-event" style="font-size: 2.5rem; color: var(--bs-primary);"></i>
                <h6 class="text-muted mt-2 mb-1">Fecha de Entrega</h6>
                <h5>{{ $reac->fecha_entrega->format('d/m/Y') }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-people-fill" style="font-size: 2.5rem; color: var(--bs-info);"></i>
                <h6 class="text-muted mt-2 mb-1">Tutorados</h6>
                <h5>{{ $reac->num_tutorados }} estudiantes</h5>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-bookmark-fill" style="font-size: 2.5rem; color: var(--bs-success);"></i>
                <h6 class="text-muted mt-2 mb-1">Sesiones</h6>
                <h5>{{ $reac->sesiones->count() }} registradas</h5>
            </div>
        </div>
    </div>
</div>

{{-- Información del Tutor --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Información del Tutor</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="30%">Nombre:</th>
                            <td>{{ $reac->tutor }}</td>
                        </tr>
                        <tr>
                            <th>División:</th>
                            <td>
                                @if($reac->divisionRelacion)
                                    <span class="badge bg-secondary">{{ $reac->divisionRelacion->codigo }}</span>
                                    {{ $reac->divisionRelacion->nombre }}
                                @else
                                    {{ $reac->division }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Correo:</th>
                            <td>
                                @if($reac->tutore)
                                    {{ $reac->tutore->correoelectronico }}
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="40%">Semestre/Grupo:</th>
                            <td>{{ $reac->semestre_grupo }}</td>
                        </tr>
                        <tr>
                            <th>Horas/Semana:</th>
                            <td>{{ number_format($reac->horas_tutorias_semana, 1) }} horas</td>
                        </tr>
                        <tr>
                            <th>Firma:</th>
                            <td>
                                @if($reac->firma)
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#firmaModal">
                                        <i class="bi bi-eye me-1"></i>Ver Firma
                                    </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Sesiones de Tutoría --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Sesiones de Tutoría ({{ $reac->sesiones->count() }})</h5>
    </div>
    <div class="card-body p-0">
        @if($reac->sesiones->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Modalidad</th>
                            <th>Tipo</th>
                            <th>Tema</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reac->sesiones as $sesion)
                            <tr>
                                <td><strong>#{{ $sesion->no_sesion }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($sesion->fecha_sesion)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($sesion->hora_sesion)->format('H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $sesion->modalidad === 'presencial' ? 'primary' : ($sesion->modalidad === 'virtual' ? 'info' : 'warning') }}">
                                        {{ ucfirst($sesion->modalidad) }}
                                    </span>
                                </td>
                                <td>
                                    @if($sesion->es_grupal)
                                        <span class="badge bg-success"><i class="bi bi-people-fill me-1"></i>Grupal</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="bi bi-person-fill me-1"></i>Individual</span>
                                    @endif
                                </td>
                                <td>{{ $sesion->tema }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-calendar-x" style="font-size: 3rem; color: #dee2e6;"></i>
                <p class="text-muted mt-2">No hay sesiones registradas</p>
            </div>
        @endif
    </div>
</div>

{{-- Evidencias --}}
<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-image me-2"></i>Evidencias Fotográficas</h5>
            </div>
            <div class="card-body">
                @if($reac->evidencias_fotograficas && count($reac->evidencias_fotograficas) > 0)
                    <div class="row g-2">
                        @foreach($reac->evidencias_fotograficas as $index => $evidencia)
                            <div class="col-md-6">
                                <a href="{{ asset('storage/' . $evidencia) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $evidencia) }}"
                                         class="img-thumbnail"
                                         alt="Evidencia {{ $index + 1 }}"
                                         style="width: 100%; height: 150px; object-fit: cover;">
                                </a>
                                <small class="text-muted d-block mt-1">Evidencia #{{ $index + 1 }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="bi bi-image" style="font-size: 2rem; color: #dee2e6;"></i>
                        <p class="text-muted mt-2 mb-0">Sin evidencias fotográficas</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Evidencias de Lista</h5>
            </div>
            <div class="card-body">
                @if($reac->evidencias_lista && count($reac->evidencias_lista) > 0)
                    <div class="list-group">
                        @foreach($reac->evidencias_lista as $index => $evidencia)
                            <a href="{{ asset('storage/' . $evidencia) }}"
                               class="list-group-item list-group-item-action"
                               target="_blank">
                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                {{ basename($evidencia) }}
                                <i class="bi bi-download float-end"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="bi bi-file-earmark" style="font-size: 2rem; color: #dee2e6;"></i>
                        <p class="text-muted mt-2 mb-0">Sin evidencias de lista</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Observaciones --}}
@if($reac->observaciones)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-chat-left-text me-2"></i>Observaciones</h5>
        </div>
        <div class="card-body">
            <p class="mb-0">{{ $reac->observaciones }}</p>
        </div>
    </div>
@endif

{{-- Metadata --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información del Sistema</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <small class="text-muted">Creado el:</small>
                <p>{{ $reac->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="col-md-6">
                <small class="text-muted">Última actualización:</small>
                <p>{{ $reac->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Modal de Firma --}}
<div class="modal fade" id="firmaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Firma del Tutor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $reac->firma) }}"
                     class="img-fluid"
                     alt="Firma del tutor">
            </div>
        </div>
    </div>
</div>
@endsection
