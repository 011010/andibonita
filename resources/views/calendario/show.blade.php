@extends('layouts.admin')

@section('title', 'Detalle del Calendario')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('calendario.index') }}">Calendarios</a></li>
    <li class="breadcrumb-item active">Calendario #{{ $calendario->id }}</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Calendario #{{ $calendario->id }}</h1>
        <p class="page-subtitle">{{ $calendario->periodo }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('calendario.pdf', $calendario->id) }}" class="btn btn-danger" target="_blank">
            <i class="bi bi-file-pdf me-2"></i>Descargar PDF
        </a>
        <a href="{{ route('calendario.edit', $calendario->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-2"></i>Editar
        </a>
        <a href="{{ route('calendario.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

{{-- Información General --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="40%">Documento:</th>
                            <td>{{ $calendario->documento }}</td>
                        </tr>
                        <tr>
                            <th>Periodo:</th>
                            <td><span class="badge bg-primary fs-6">{{ $calendario->periodo }}</span></td>
                        </tr>
                        <tr>
                            <th>Fecha de Entrega:</th>
                            <td>
                                <i class="bi bi-calendar-event text-primary me-2"></i>
                                {{ $calendario->fecha_entrega->format('d/m/Y') }}
                                <small class="text-muted">({{ $calendario->fecha_entrega->diffForHumans() }})</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="40%">Inicio de Tutorías:</th>
                            <td>
                                @if($calendario->inicio_tutorias)
                                    <i class="bi bi-play-circle text-success me-2"></i>
                                    {{ \Carbon\Carbon::parse($calendario->inicio_tutorias)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">No definido</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Fin de Tutorías:</th>
                            <td>
                                @if($calendario->fin_tutorias)
                                    <i class="bi bi-stop-circle text-danger me-2"></i>
                                    {{ \Carbon\Carbon::parse($calendario->fin_tutorias)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">No definido</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Duración:</th>
                            <td>
                                @if($calendario->inicio_tutorias && $calendario->fin_tutorias)
                                    @php
                                        $inicio = \Carbon\Carbon::parse($calendario->inicio_tutorias);
                                        $fin = \Carbon\Carbon::parse($calendario->fin_tutorias);
                                        $dias = $inicio->diffInDays($fin);
                                        $semanas = round($dias / 7);
                                    @endphp
                                    <strong>{{ $dias }}</strong> días (aprox. <strong>{{ $semanas }}</strong> semanas)
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Fechas REAC y RESA --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Fechas de Reportes REAC y RESA</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>Entrega</th>
                        <th>REAC</th>
                        <th>RESA</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 4; $i++)
                        <tr>
                            <td><strong>{{ $i }}° Entrega</strong></td>
                            <td>
                                @if($calendario->{'reac_' . $i})
                                    <i class="bi bi-calendar-check text-primary me-2"></i>
                                    {{ \Carbon\Carbon::parse($calendario->{'reac_' . $i})->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($calendario->{'reac_' . $i})->diffForHumans() }}
                                    </small>
                                @else
                                    <span class="text-muted">No definido</span>
                                @endif
                            </td>
                            <td>
                                @if($calendario->{'resa_' . $i})
                                    <i class="bi bi-calendar-check text-success me-2"></i>
                                    {{ \Carbon\Carbon::parse($calendario->{'resa_' . $i})->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($calendario->{'resa_' . $i})->diffForHumans() }}
                                    </small>
                                @else
                                    <span class="text-muted">No definido</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $reacDate = $calendario->{'reac_' . $i} ? \Carbon\Carbon::parse($calendario->{'reac_' . $i}) : null;
                                    $resaDate = $calendario->{'resa_' . $i} ? \Carbon\Carbon::parse($calendario->{'resa_' . $i}) : null;
                                    $now = now();
                                @endphp
                                @if($reacDate && $resaDate)
                                    @if($now->lt($reacDate))
                                        <span class="badge bg-info">Pendiente</span>
                                    @elseif($now->between($reacDate, $resaDate))
                                        <span class="badge bg-warning">En proceso</span>
                                    @else
                                        <span class="badge bg-success">Completado</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">No programado</span>
                                @endif
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Documentos Adicionales --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Documentos Adicionales</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-file-earmark-check text-primary me-2"></i>
                            <strong>Informe de Asistencia</strong>
                        </div>
                        <span class="{{ $calendario->informe_asistencia ? 'text-success' : 'text-muted' }}">
                            @if($calendario->informe_asistencia)
                                {{ \Carbon\Carbon::parse($calendario->informe_asistencia)->format('d/m/Y') }}
                            @else
                                No definido
                            @endif
                        </span>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-file-earmark-arrow-up text-info me-2"></i>
                            <strong>Evidencia de Canalización</strong>
                        </div>
                        <span class="{{ $calendario->evidencia_canalizacion ? 'text-success' : 'text-muted' }}">
                            @if($calendario->evidencia_canalizacion)
                                {{ \Carbon\Carbon::parse($calendario->evidencia_canalizacion)->format('d/m/Y') }}
                            @else
                                No definido
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-file-earmark-bar-graph text-warning me-2"></i>
                            <strong>Reporte Semestral</strong>
                        </div>
                        <span class="{{ $calendario->reporte_semestral ? 'text-success' : 'text-muted' }}">
                            @if($calendario->reporte_semestral)
                                {{ \Carbon\Carbon::parse($calendario->reporte_semestral)->format('d/m/Y') }}
                            @else
                                No definido
                            @endif
                        </span>
                    </div>

                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                            <strong>Copias de Actas</strong>
                        </div>
                        <span class="{{ $calendario->copias_actas ? 'text-success' : 'text-muted' }}">
                            @if($calendario->copias_actas)
                                {{ \Carbon\Carbon::parse($calendario->copias_actas)->format('d/m/Y') }}
                            @else
                                No definido
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Timeline Visual --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Línea de Tiempo</h5>
    </div>
    <div class="card-body">
        <div class="timeline">
            @if($calendario->inicio_tutorias)
                <div class="timeline-item">
                    <div class="timeline-marker bg-success"></div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Inicio de Tutorías</h6>
                        <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($calendario->inicio_tutorias)->format('d/m/Y') }}</p>
                    </div>
                </div>
            @endif

            @for($i = 1; $i <= 4; $i++)
                @if($calendario->{'reac_' . $i})
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">REAC {{ $i }}</h6>
                            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($calendario->{'reac_' . $i})->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @endif

                @if($calendario->{'resa_' . $i})
                    <div class="timeline-item">
                        <div class="timeline-marker bg-info"></div>
                        <div class="timeline-content">
                            <h6 class="mb-1">RESA {{ $i }}</h6>
                            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($calendario->{'resa_' . $i})->format('d/m/Y') }}</p>
                        </div>
                    </div>
                @endif
            @endfor

            @if($calendario->fin_tutorias)
                <div class="timeline-item">
                    <div class="timeline-marker bg-danger"></div>
                    <div class="timeline-content">
                        <h6 class="mb-1">Fin de Tutorías</h6>
                        <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($calendario->fin_tutorias)->format('d/m/Y') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Metadata --}}
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información del Sistema</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <small class="text-muted">Creado el:</small>
                <p>{{ $calendario->created_at->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="col-md-6">
                <small class="text-muted">Última actualización:</small>
                <p>{{ $calendario->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -26px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline-content {
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 5px;
}
</style>
@endpush
