@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->a_paterno }}</p>
    </div>
</div>

{{-- Estadísticas Principales --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total REACs</h6>
                        <h3 class="mb-0">{{ $stats['total_reacs'] }}</h3>
                    </div>
                    <div class="stat-icon bg-primary">
                        <i class="bi bi-file-earmark-text"></i>
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
                        <h6 class="text-muted mb-1">Pendientes</h6>
                        <h3 class="mb-0">{{ $stats['reacs_pendientes'] }}</h3>
                    </div>
                    <div class="stat-icon bg-warning">
                        <i class="bi bi-clock-history"></i>
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
                        <h3 class="mb-0">{{ $stats['reacs_aprobados'] }}</h3>
                    </div>
                    <div class="stat-icon bg-success">
                        <i class="bi bi-check-circle"></i>
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
                        <h6 class="text-muted mb-1">
                            @if(in_array(Auth::user()->role, ['admin', 'coordinador']))
                                Tutores
                            @else
                                Estudiantes
                            @endif
                        </h6>
                        <h3 class="mb-0">{{ $stats['total_estudiantes'] }}</h3>
                    </div>
                    <div class="stat-icon bg-info">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Contenido Principal --}}
<div class="row">
    {{-- Columna Izquierda --}}
    <div class="col-md-8">
        {{-- REACs Recientes --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>REACs Recientes</h5>
                <a href="{{ route('reac.index') }}" class="btn btn-sm btn-outline-primary">Ver Todos</a>
            </div>
            <div class="card-body p-0">
                @if($recentReacs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tutor</th>
                                    <th>Semestre/Grupo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentReacs as $reac)
                                    <tr>
                                        <td><strong>#{{ $reac->id }}</strong></td>
                                        <td>{{ Str::limit($reac->tutor, 25) }}</td>
                                        <td>{{ $reac->semestre_grupo }}</td>
                                        <td>{{ $reac->created_at->format('d/m/Y') }}</td>
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
                                            <span class="badge {{ $badgeClass }}">{{ ucfirst($reac->estado) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('reac.show', $reac->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                        <p class="text-muted mt-2">No hay REACs registrados</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Estadísticas por Rol --}}
        @if(in_array(Auth::user()->role, ['admin', 'coordinador']) && isset($roleStats['top_tutores']))
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-trophy me-2"></i>Tutores Más Activos</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($roleStats['top_tutores'] as $index => $tutor)
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <div>
                                    <i class="bi bi-person-circle text-primary me-2"></i>
                                    <strong>{{ $tutor->tutor }}</strong>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $tutor->total }} REACs</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if(Auth::user()->role === 'tutor' && isset($roleStats['total_sesiones']))
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Mis Estadísticas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <i class="bi bi-bookmark-fill text-primary" style="font-size: 2rem;"></i>
                            <h4 class="mt-2">{{ $roleStats['total_sesiones'] }}</h4>
                            <p class="text-muted">Sesiones Totales</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <i class="bi bi-people-fill text-info" style="font-size: 2rem;"></i>
                            <h4 class="mt-2">{{ $stats['total_estudiantes'] }}</h4>
                            <p class="text-muted">Tutorados</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Columna Derecha --}}
    <div class="col-md-4">
        {{-- Calendario Actual --}}
        @if($currentCalendario)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Calendario Actual</h5>
                </div>
                <div class="card-body">
                    <h6 class="text-primary">{{ $currentCalendario->periodo }}</h6>
                    <hr>
                    <div class="mb-2">
                        <small class="text-muted">Inicio de Tutorías:</small><br>
                        @if($currentCalendario->inicio_tutorias)
                            <strong>{{ \Carbon\Carbon::parse($currentCalendario->inicio_tutorias)->format('d/m/Y') }}</strong>
                        @else
                            <span class="text-muted">No definido</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Fin de Tutorías:</small><br>
                        @if($currentCalendario->fin_tutorias)
                            <strong>{{ \Carbon\Carbon::parse($currentCalendario->fin_tutorias)->format('d/m/Y') }}</strong>
                        @else
                            <span class="text-muted">No definido</span>
                        @endif
                    </div>
                    <a href="{{ route('calendario.show', $currentCalendario->id) }}" class="btn btn-outline-primary btn-sm w-100 mt-3">
                        <i class="bi bi-eye me-1"></i>Ver Detalles
                    </a>
                </div>
            </div>
        @endif

        {{-- Acceso Rápido --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-lightning me-2"></i>Acceso Rápido</h5>
            </div>
            <div class="card-body p-2">
                <div class="list-group list-group-flush">
                    @if(in_array(Auth::user()->role, ['tutor', 'coordinador', 'admin']))
                        <a href="{{ route('reac.create') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-plus-circle text-success me-2"></i>
                            Crear Nuevo REAC
                        </a>
                    @endif
                    <a href="{{ route('reac.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-list-ul text-primary me-2"></i>
                        Ver Todos los REACs
                    </a>
                    <a href="{{ route('calendario.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar3 text-info me-2"></i>
                        Ver Calendarios
                    </a>
                    @if(in_array(Auth::user()->role, ['coordinador', 'admin']))
                        <a href="{{ route('calendario.create') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-calendar-plus text-warning me-2"></i>
                            Crear Calendario
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Estado de REACs --}}
        @if(isset($roleStats['reacs_by_status']) && $roleStats['reacs_by_status']->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-pie-chart me-2"></i>REACs por Estado</h5>
                </div>
                <div class="card-body">
                    @foreach($roleStats['reacs_by_status'] as $status)
                        @php
                            $badgeClass = match($status->estado) {
                                'borrador' => 'bg-warning',
                                'enviado' => 'bg-info',
                                'revisado' => 'bg-primary',
                                'aprobado' => 'bg-success',
                                'rechazado' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                            $percentage = $stats['total_reacs'] > 0 ? round(($status->total / $stats['total_reacs']) * 100) : 0;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status->estado) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="progress" style="width: 100px; height: 8px; margin-right: 10px;">
                                    <div class="progress-bar {{ $badgeClass }}" role="progressbar" style="width: {{ $percentage }}%"></div>
                                </div>
                                <strong>{{ $status->total }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
