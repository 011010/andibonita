@extends('layouts.admin')

@section('title', 'Editar Reporte REAC')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reac.index') }}">Reportes REAC</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reac.show', $reac->id) }}">Reporte #{{ $reac->id }}</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Editar Reporte REAC #{{ $reac->id }}</h1>
        <p class="page-subtitle">{{ $reac->semestre_grupo }} - {{ $reac->tutor }}</p>
    </div>
    <div>
        <a href="{{ route('reac.show', $reac->id) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Cancelar
        </a>
    </div>
</div>

<form action="{{ route('reac.update', $reac->id) }}" method="POST" enctype="multipart/form-data" id="reacForm">
    @csrf
    @method('PUT')

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
                                    {{ old('tutor_id', $reac->tutor_id) == $tutor->id ? 'selected' : '' }}>
                                {{ $tutor->nombres }} {{ $tutor->a_paterno }} {{ $tutor->a_materno }}
                            </option>
                        @endforeach
                    </select>
                    @error('tutor_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tutor" class="form-label">Nombre Completo del Tutor <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tutor') is-invalid @enderror"
                           id="tutor" name="tutor" value="{{ old('tutor', $reac->tutor) }}" required>
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
                                    {{ old('division_id', $reac->division_id) == $division->id ? 'selected' : '' }}>
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
                           id="division" name="division" value="{{ old('division', $reac->division) }}" required>
                    @error('division')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="firma" class="form-label">Actualizar Firma del Tutor (Opcional)</label>
                    <input type="file" class="form-control @error('firma') is-invalid @enderror"
                           id="firma" name="firma" accept="image/*" onchange="previewFirma(this)">
                    @error('firma')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Deje vacío si no desea cambiar la firma actual</small>
                    <div id="firma-preview" class="mt-2">
                        <img src="{{ asset('storage/' . $reac->firma) }}" class="img-thumbnail" style="max-width: 200px;">
                    </div>
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
                           id="num_tutorados" name="num_tutorados" value="{{ old('num_tutorados', $reac->num_tutorados) }}"
                           min="1" max="100" required>
                    @error('num_tutorados')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="semestre_grupo" class="form-label">Semestre/Grupo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('semestre_grupo') is-invalid @enderror"
                           id="semestre_grupo" name="semestre_grupo" value="{{ old('semestre_grupo', $reac->semestre_grupo) }}"
                           required>
                    @error('semestre_grupo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="horas_tutorias_semana" class="form-label">Horas Tutorías/Semana <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('horas_tutorias_semana') is-invalid @enderror"
                           id="horas_tutorias_semana" name="horas_tutorias_semana"
                           value="{{ old('horas_tutorias_semana', $reac->horas_tutorias_semana) }}" min="0.5" max="40" step="0.5" required>
                    @error('horas_tutorias_semana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="fecha_entrega" class="form-label">Fecha de Entrega <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('fecha_entrega') is-invalid @enderror"
                           id="fecha_entrega" name="fecha_entrega"
                           value="{{ old('fecha_entrega', $reac->fecha_entrega->format('Y-m-d')) }}" required>
                    @error('fecha_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="observaciones" class="form-label">Observaciones (Opcional)</label>
                    <textarea class="form-control @error('observaciones') is-invalid @enderror"
                              id="observaciones" name="observaciones" rows="3"
                              maxlength="1000">{{ old('observaciones', $reac->observaciones) }}</textarea>
                    @error('observaciones')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                @php $sesionCounter = 0; @endphp
                @foreach($reac->sesiones as $sesion)
                    @php $sesionCounter++; @endphp
                    <div class="sesion-item mb-4 p-3 border rounded bg-light" data-sesion="{{ $sesionCounter }}">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0"><i class="bi bi-bookmark-fill me-2"></i>Sesión #{{ $sesionCounter }}</h6>
                            <button type="button" class="btn btn-sm btn-danger" onclick="eliminarSesion(this)">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">No. Sesión <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="no_sesion[]" value="{{ $sesion->no_sesion }}" min="1" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Fecha <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="fecha_sesion[]"
                                       value="{{ \Carbon\Carbon::parse($sesion->fecha_sesion)->format('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Hora <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="hora_sesion[]"
                                       value="{{ \Carbon\Carbon::parse($sesion->hora_sesion)->format('H:i') }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Modalidad <span class="text-danger">*</span></label>
                                <select class="form-select" name="modalidad[]" required>
                                    <option value="presencial" {{ $sesion->modalidad === 'presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="virtual" {{ $sesion->modalidad === 'virtual' ? 'selected' : '' }}>Virtual</option>
                                    <option value="hibrida" {{ $sesion->modalidad === 'hibrida' ? 'selected' : '' }}>Híbrida</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Tipo</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="grupal[]" value="1"
                                           {{ $sesion->es_grupal ? 'checked' : '' }}>
                                    <label class="form-check-label">Grupal</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Tema <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tema[]" value="{{ $sesion->tema }}" required>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Evidencias --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-paperclip me-2"></i>Agregar Más Evidencias (Opcional)</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="evidencia_fotografica" class="form-label">Nuevas Evidencias Fotográficas</label>
                    <input type="file" class="form-control" id="evidencia_fotografica" name="evidencia_fotografica[]" accept="image/*" multiple>
                    <small class="text-muted">Las nuevas evidencias se agregarán a las existentes</small>
                </div>

                <div class="col-md-6">
                    <label for="evidencia_lista" class="form-label">Nuevas Evidencias de Listas</label>
                    <input type="file" class="form-control" id="evidencia_lista" name="evidencia_lista[]" accept=".pdf,.doc,.docx" multiple>
                    <small class="text-muted">Las nuevas evidencias se agregarán a las existentes</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="d-flex justify-content-end gap-2 mb-4">
        <a href="{{ route('reac.show', $reac->id) }}" class="btn btn-secondary">
            <i class="bi bi-x-circle me-2"></i>Cancelar
        </a>
        <button type="submit" class="btn btn-primary" onclick="showLoading()">
            <i class="bi bi-save me-2"></i>Actualizar Reporte
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
let sesionCounter = {{ $reac->sesiones->count() }};

function loadTutorData(select) {
    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption.value) {
        document.getElementById('tutor').value = selectedOption.dataset.nombre;
        document.getElementById('division').value = selectedOption.dataset.division || '';
    }
}

function setDivisionName(select) {
    const selectedOption = select.options[select.selectedIndex];
    if (selectedOption.value) {
        document.getElementById('division').value = selectedOption.dataset.nombre;
    }
}

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
                <input type="text" class="form-control" name="tema[]" required>
            </div>
        </div>
    `;

    container.appendChild(sesionDiv);
    sesionDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function eliminarSesion(button) {
    if (confirm('¿Desea eliminar esta sesión?')) {
        button.closest('.sesion-item').remove();
    }
}

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

document.getElementById('reacForm').addEventListener('submit', function(e) {
    const sesiones = document.querySelectorAll('.sesion-item');

    if (sesiones.length === 0) {
        e.preventDefault();
        alert('Debe tener al menos una sesión de tutoría.');
        return false;
    }

    return true;
});
</script>
@endpush
