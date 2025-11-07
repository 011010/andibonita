@extends('layouts.admin')

@section('title', 'Nuevo Reporte REAC')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reac.index') }}">Reportes REAC</a></li>
    <li class="breadcrumb-item active">Nuevo Reporte</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Crear Nuevo Reporte REAC</h1>
        <p class="page-subtitle">Reporte de Actividades de Tutoría</p>
    </div>
    <div>
        <a href="{{ route('reac.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver
        </a>
    </div>
</div>

<form action="{{ route('reac.store') }}" method="POST" enctype="multipart/form-data" id="reacForm">
    @csrf

    {{-- Información del Tutor --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Información del Tutor</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="tutor_id" class="form-label">Seleccionar Tutor</label>
                    <select class="form-select @error('tutor_id') is-invalid @enderror" id="tutor_id" name="tutor_id" onchange="loadTutorData(this)">
                        <option value="">-- Seleccione un tutor --</option>
                        @foreach($tutores as $tutor)
                            <option value="{{ $tutor->id }}"
                                    data-nombre="{{ $tutor->nombres }} {{ $tutor->a_paterno }} {{ $tutor->a_materno }}"
                                    data-division="{{ $tutor->division }}"
                                    {{ old('tutor_id') == $tutor->id ? 'selected' : '' }}>
                                {{ $tutor->nombres }} {{ $tutor->a_paterno }} {{ $tutor->a_materno }}
                            </option>
                        @endforeach
                    </select>
                    @error('tutor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">O ingrese manualmente los datos del tutor</small>
                </div>

                <div class="col-md-6">
                    <label for="tutor" class="form-label">Nombre Completo del Tutor <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tutor') is-invalid @enderror"
                           id="tutor" name="tutor" value="{{ old('tutor') }}" required>
                    @error('tutor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="division_id" class="form-label">División</label>
                    <select class="form-select @error('division_id') is-invalid @enderror" id="division_id" name="division_id" onchange="setDivisionName(this)">
                        <option value="">-- Seleccione una división --</option>
                        @foreach($divisiones as $division)
                            <option value="{{ $division->id }}"
                                    data-nombre="{{ $division->nombre }}"
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->codigo }} - {{ $division->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="division" class="form-label">Nombre de la División <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('division') is-invalid @enderror"
                           id="division" name="division" value="{{ old('division') }}" required>
                    @error('division')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="firma" class="form-label">Firma del Tutor (Imagen) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('firma') is-invalid @enderror"
                           id="firma" name="firma" accept="image/*" required onchange="previewFirma(this)">
                    @error('firma')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos: JPG, PNG, GIF, SVG. Tamaño máximo: 2MB</small>
                    <div id="firma-preview" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Información General del Reporte --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información General</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="num_tutorados" class="form-label">Número de Tutorados <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('num_tutorados') is-invalid @enderror"
                           id="num_tutorados" name="num_tutorados" value="{{ old('num_tutorados') }}"
                           min="1" max="100" required>
                    @error('num_tutorados')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="semestre_grupo" class="form-label">Semestre/Grupo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('semestre_grupo') is-invalid @enderror"
                           id="semestre_grupo" name="semestre_grupo" value="{{ old('semestre_grupo') }}"
                           placeholder="Ej: 5°A, 3°B" required>
                    @error('semestre_grupo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="horas_tutorias_semana" class="form-label">Horas Tutorías/Semana <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('horas_tutorias_semana') is-invalid @enderror"
                           id="horas_tutorias_semana" name="horas_tutorias_semana"
                           value="{{ old('horas_tutorias_semana') }}" min="0.5" max="40" step="0.5" required>
                    @error('horas_tutorias_semana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="fecha_entrega" class="form-label">Fecha de Entrega <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('fecha_entrega') is-invalid @enderror"
                           id="fecha_entrega" name="fecha_entrega"
                           value="{{ old('fecha_entrega', $fecha_entrega) }}" required>
                    @error('fecha_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="observaciones" class="form-label">Observaciones (Opcional)</label>
                    <textarea class="form-control @error('observaciones') is-invalid @enderror"
                              id="observaciones" name="observaciones" rows="3"
                              maxlength="1000">{{ old('observaciones') }}</textarea>
                    @error('observaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Máximo 1000 caracteres</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Sesiones de Tutoría --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Sesiones de Tutoría</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="agregarSesion()">
                <i class="bi bi-plus-circle me-1"></i>Agregar Sesión
            </button>
        </div>
        <div class="card-body">
            <div id="sesiones-container">
                <div class="sesion-item mb-4 p-3 border rounded bg-light" data-sesion="1">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"><i class="bi bi-bookmark-fill me-2"></i>Sesión #1</h6>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">No. Sesión <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="no_sesion[]" value="1" min="1" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="fecha_sesion[]" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Hora <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="hora_sesion[]" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Modalidad <span class="text-danger">*</span></label>
                            <select class="form-select" name="modalidad[]" required>
                                <option value="presencial">Presencial</option>
                                <option value="virtual">Virtual</option>
                                <option value="hibrida">Híbrida</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Tipo</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="grupal[]" value="1">
                                <label class="form-check-label">Grupal</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Tema <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="tema[]"
                                   placeholder="Ej: Técnicas de estudio" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-3">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Nota:</strong> Agregue todas las sesiones de tutoría realizadas durante el periodo.
            </div>
        </div>
    </div>

    {{-- Evidencias --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-paperclip me-2"></i>Evidencias</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="evidencia_fotografica" class="form-label">Evidencias Fotográficas (Opcional)</label>
                    <input type="file" class="form-control @error('evidencia_fotografica.*') is-invalid @enderror"
                           id="evidencia_fotografica" name="evidencia_fotografica[]" accept="image/*" multiple>
                    @error('evidencia_fotografica.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Puede seleccionar múltiples imágenes. Máximo 5MB por archivo.</small>
                </div>

                <div class="col-md-6">
                    <label for="evidencia_lista" class="form-label">Evidencias de Listas (Opcional)</label>
                    <input type="file" class="form-control @error('evidencia_lista.*') is-invalid @enderror"
                           id="evidencia_lista" name="evidencia_lista[]" accept=".pdf,.doc,.docx" multiple>
                    @error('evidencia_lista.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos: PDF, DOC, DOCX. Máximo 10MB por archivo.</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="d-flex justify-content-end gap-2 mb-4">
        <a href="{{ route('reac.index') }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-2"></i>Cancelar
        </a>
        <button type="submit" class="btn btn-primary" onclick="showLoading()">
            <i class="bi bi-save me-2"></i>Guardar Reporte
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
let sesionCounter = 1;

// Cargar datos del tutor seleccionado
function loadTutorData(select) {
    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption.value) {
        document.getElementById('tutor').value = selectedOption.dataset.nombre;
        document.getElementById('division').value = selectedOption.dataset.division || '';
    }
}

// Establecer nombre de división
function setDivisionName(select) {
    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption.value) {
        document.getElementById('division').value = selectedOption.dataset.nombre;
    }
}

// Agregar nueva sesión
function agregarSesion() {
    sesionCounter++;
    const container = document.getElementById('sesiones-container');

    const sesionDiv = document.createElement('div');
    sesionDiv.className = 'sesion-item mb-4 p-3 border rounded bg-light';
    sesionDiv.dataset.sesion = sesionCounter;

    sesionDiv.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="mb-0"><i class="bi bi-bookmark-fill me-2"></i>Sesión #${sesionCounter}</h6>
            <button type="button" class="btn btn-sm btn-danger" onclick="eliminarSesion(this)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        </div>

        <div class="row g-3">
            <div class="col-md-2">
                <label class="form-label">No. Sesión <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="no_sesion[]" value="${sesionCounter}" min="1" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Fecha <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="fecha_sesion[]" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Hora <span class="text-danger">*</span></label>
                <input type="time" class="form-control" name="hora_sesion[]" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Modalidad <span class="text-danger">*</span></label>
                <select class="form-select" name="modalidad[]" required>
                    <option value="presencial">Presencial</option>
                    <option value="virtual">Virtual</option>
                    <option value="hibrida">Híbrida</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Tipo</label>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="grupal[]" value="1">
                    <label class="form-check-label">Grupal</label>
                </div>
            </div>

            <div class="col-md-12">
                <label class="form-label">Tema <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tema[]"
                       placeholder="Ej: Técnicas de estudio" required>
            </div>
        </div>
    `;

    container.appendChild(sesionDiv);

    // Scroll suave a la nueva sesión
    sesionDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Eliminar sesión
function eliminarSesion(button) {
    if (confirm('¿Desea eliminar esta sesión?')) {
        button.closest('.sesion-item').remove();
    }
}

// Preview de la firma
function previewFirma(input) {
    const preview = document.getElementById('firma-preview');
    preview.innerHTML = '';

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '150px';
            preview.appendChild(img);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

// Validación del formulario
document.getElementById('reacForm').addEventListener('submit', function(e) {
    const sesiones = document.querySelectorAll('.sesion-item');

    if (sesiones.length === 0) {
        e.preventDefault();
        alert('Debe agregar al menos una sesión de tutoría.');
        return false;
    }

    // Validar que no haya números de sesión duplicados
    const numerosSesion = Array.from(document.querySelectorAll('input[name="no_sesion[]"]'))
        .map(input => input.value);

    const duplicados = numerosSesion.filter((item, index) => numerosSesion.indexOf(item) !== index);

    if (duplicados.length > 0) {
        e.preventDefault();
        alert('Hay números de sesión duplicados. Por favor, corrija los números de sesión.');
        return false;
    }

    return true;
});
</script>
@endpush
