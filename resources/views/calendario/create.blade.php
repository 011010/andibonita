@extends('layouts.admin')

@section('title', 'Crear Calendario')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('calendario.index') }}">Calendarios</a></li>
    <li class="breadcrumb-item active">Crear Nuevo</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Crear Nuevo Calendario</h1>
        <p class="page-subtitle">Complete el formulario con las fechas importantes del semestre</p>
    </div>
    <div>
        <a href="{{ route('calendario.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Cancelar
        </a>
    </div>
</div>

<form action="{{ route('calendario.store') }}" method="POST">
    @csrf

    {{-- Información General --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="documento" class="form-label">
                            Nombre del Documento <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('documento') is-invalid @enderror"
                               id="documento"
                               name="documento"
                               value="{{ old('documento') }}"
                               placeholder="Ej: Calendario de Tutorías"
                               required>
                        @error('documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="periodo" class="form-label">
                            Periodo Académico <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('periodo') is-invalid @enderror"
                               id="periodo"
                               name="periodo"
                               value="{{ old('periodo') }}"
                               placeholder="Ej: Enero-Junio 2024"
                               required>
                        @error('periodo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">
                            Fecha de Entrega <span class="text-danger">*</span>
                        </label>
                        <input type="date"
                               class="form-control @error('fecha_entrega') is-invalid @enderror"
                               id="fecha_entrega"
                               name="fecha_entrega"
                               value="{{ old('fecha_entrega') }}"
                               max="{{ date('Y-m-d') }}"
                               required>
                        @error('fecha_entrega')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">No puede ser fecha futura</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Fechas de Tutorías --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-calendar3 me-2"></i>Periodo de Tutorías</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="inicio_tutorias" class="form-label">
                            <i class="bi bi-play-circle text-success me-1"></i>
                            Inicio de Tutorías
                        </label>
                        <input type="date"
                               class="form-control @error('inicio_tutorias') is-invalid @enderror"
                               id="inicio_tutorias"
                               name="inicio_tutorias"
                               value="{{ old('inicio_tutorias') }}">
                        @error('inicio_tutorias')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fin_tutorias" class="form-label">
                            <i class="bi bi-stop-circle text-danger me-1"></i>
                            Fin de Tutorías
                        </label>
                        <input type="date"
                               class="form-control @error('fin_tutorias') is-invalid @enderror"
                               id="fin_tutorias"
                               name="fin_tutorias"
                               value="{{ old('fin_tutorias') }}">
                        @error('fin_tutorias')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Fechas REAC y RESA --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Fechas de Reportes REAC y RESA</h5>
        </div>
        <div class="card-body">
            @for($i = 1; $i <= 4; $i++)
                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-bookmark-fill me-2"></i>{{ $i }}° Entrega
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reac_{{ $i }}" class="form-label">
                                REAC {{ $i }}
                            </label>
                            <input type="date"
                                   class="form-control @error('reac_' . $i) is-invalid @enderror"
                                   id="reac_{{ $i }}"
                                   name="reac_{{ $i }}"
                                   value="{{ old('reac_' . $i) }}">
                            @error('reac_' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="resa_{{ $i }}" class="form-label">
                                RESA {{ $i }}
                            </label>
                            <input type="date"
                                   class="form-control @error('resa_' . $i) is-invalid @enderror"
                                   id="resa_{{ $i }}"
                                   name="resa_{{ $i }}"
                                   value="{{ old('resa_' . $i) }}">
                            @error('resa_' . $i)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                @if($i < 4)
                    <hr>
                @endif
            @endfor
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
                    <div class="mb-3">
                        <label for="informe_asistencia" class="form-label">
                            <i class="bi bi-file-earmark-check text-primary me-1"></i>
                            Informe de Asistencia
                        </label>
                        <input type="date"
                               class="form-control @error('informe_asistencia') is-invalid @enderror"
                               id="informe_asistencia"
                               name="informe_asistencia"
                               value="{{ old('informe_asistencia') }}">
                        @error('informe_asistencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="evidencia_canalizacion" class="form-label">
                            <i class="bi bi-file-earmark-arrow-up text-info me-1"></i>
                            Evidencia de Canalización
                        </label>
                        <input type="date"
                               class="form-control @error('evidencia_canalizacion') is-invalid @enderror"
                               id="evidencia_canalizacion"
                               name="evidencia_canalizacion"
                               value="{{ old('evidencia_canalizacion') }}">
                        @error('evidencia_canalizacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="reporte_semestral" class="form-label">
                            <i class="bi bi-file-earmark-bar-graph text-warning me-1"></i>
                            Reporte Semestral
                        </label>
                        <input type="date"
                               class="form-control @error('reporte_semestral') is-invalid @enderror"
                               id="reporte_semestral"
                               name="reporte_semestral"
                               value="{{ old('reporte_semestral') }}">
                        @error('reporte_semestral')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="copias_actas" class="form-label">
                            <i class="bi bi-file-earmark-pdf text-danger me-1"></i>
                            Copias de Actas
                        </label>
                        <input type="date"
                               class="form-control @error('copias_actas') is-invalid @enderror"
                               id="copias_actas"
                               name="copias_actas"
                               value="{{ old('copias_actas') }}">
                        @error('copias_actas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Botones de Acción --}}
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Los campos marcados con <span class="text-danger">*</span> son obligatorios
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('calendario.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Guardar Calendario
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación de fechas en el cliente
    const fechaEntrega = document.getElementById('fecha_entrega');
    const inicioTutorias = document.getElementById('inicio_tutorias');
    const finTutorias = document.getElementById('fin_tutorias');

    // Al cambiar fecha de entrega, actualizar el mínimo de inicio de tutorías
    fechaEntrega.addEventListener('change', function() {
        if (this.value) {
            inicioTutorias.setAttribute('min', this.value);
        }
    });

    // Al cambiar inicio de tutorías, actualizar el mínimo de fin de tutorías y REACs
    inicioTutorias.addEventListener('change', function() {
        if (this.value) {
            finTutorias.setAttribute('min', this.value);
            document.getElementById('reac_1').setAttribute('min', this.value);
        }
    });

    // Cadena de validación para REACs y RESAs
    for (let i = 1; i <= 4; i++) {
        const reacField = document.getElementById(`reac_${i}`);
        const resaField = document.getElementById(`resa_${i}`);

        reacField.addEventListener('change', function() {
            if (this.value) {
                resaField.setAttribute('min', this.value);
                if (i < 4) {
                    document.getElementById(`reac_${i + 1}`).setAttribute('min', this.value);
                }
            }
        });

        resaField.addEventListener('change', function() {
            if (this.value && i < 4) {
                document.getElementById(`reac_${i + 1}`).setAttribute('min', this.value);
            }
            if (this.value && i === 4) {
                finTutorias.setAttribute('min', this.value);
            }
        });
    }
});
</script>
@endpush
