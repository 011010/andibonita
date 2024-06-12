<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <h1>Formulario</h1>
    <form action="{{ url('/reac/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="tutor">Nombre del Tutor:</label>
        <select name="tutor" id="tutor" required>
            @foreach($tutors as $tutor)
                <option value="{{ $tutor->id }}">{{ $tutor->nombre }}</option>
            @endforeach
        </select>
        <br>
        <label for="firma">Firma del Tutor:</label>
        <input type="file" name="firma" id="firma" accept="image/*" required>
        <br>
        <label for="division">División:</label>
        <select name="division" id="division" required>
            @foreach($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->nombre }}</option>
            @endforeach
        </select>
        <br>
        <label for="num_tutorados">Núm. de Tutorados:</label>
        <select name="num_tutorados" id="num_tutorados" required>
            @foreach($tutorados as $tutorado)
                <option value="{{ $tutorado->id }}">{{ $tutorado->num_tutorados }}</option>
            @endforeach
        </select>
        <br>
        <label for="fecha_entrega">Fecha de Entrega:</label>
        <input type="date" name="fecha_entrega" id="fecha_entrega" value="{{ $fecha_entrega }}" required>
        <br>
        <label for="semestre_grupo">Semestre/Grupo:</label>
        <input type="text" name="semestre_grupo" id="semestre_grupo" required>
        <br>
        <label for="horas_tutorias_semana">Horas Tutorías/Semana:</label>
        <input type="number" name="horas_tutorias_semana" id="horas_tutorias_semana" required>
        <br>
        <h2>Sesiones</h2>
        <div id="sesiones">
            <div class="sesion">
                <label for="no_sesion">No. Sesión:</label>
                <input type="number" name="no_sesion[]" required>
                <br>
                <label for="fecha_sesion">Fecha:</label>
                <input type="date" name="fecha_sesion[]" required>
                <br>
                <label for="hora_sesion">Hora de Sesión:</label>
                <input type="time" name="hora_sesion[]" required>
                <br>
                <label for="modalidad">Modalidad:</label>
                <input type="text" name="modalidad[]" required>
                <br>
                <label for="grupal">Grupal:</label>
                <input type="checkbox" name="grupal[]">
                <br>
                <label for="tema">Tema:</label>
                <input type="text" name="tema[]" required>
                <br>
            </div>
        </div>
        <button type="button" onclick="agregarSesion()">Agregar Sesión</button>
        <br>
        <h2>Evidencia Fotográfica</h2>
        <input type="file" name="evidencia_fotografica[]" accept="image/*" multiple>
        <br>
        <h2>Evidencias de Lista</h2>
        <input type="file" name="evidencia_lista[]" accept=".pdf,.doc,.docx" multiple>
        <br>
        <button type="submit">Guardar</button>
    </form>

    <script>
        function agregarSesion() {
            const sesionesDiv = document.getElementById('sesiones');
            const nuevaSesion = document.createElement('div');
            nuevaSesion.classList.add('sesion');
            nuevaSesion.innerHTML = `
                <label for="no_sesion">No. Sesión:</label>
                <input type="number" name="no_sesion[]" required>
                <br>
                <label for="fecha_sesion">Fecha:</label>
                <input type="date" name="fecha_sesion[]" required>
                <br>
                <label for="hora_sesion">Hora de Sesión:</label>
                <input type="time" name="hora_sesion[]" required>
                <br>
                <label for="modalidad">Modalidad:</label>
                <input type="text" name="modalidad[]" required>
                <br>
                <label for="grupal">Grupal:</label>
                <input type="checkbox" name="grupal[]">
                <br>
                <label for="tema">Tema:</label>
                <input type="text" name="tema[]" required>
                <br>
            `;
            sesionesDiv.appendChild(nuevaSesion);
        }
    </script>
</body>
</html>
