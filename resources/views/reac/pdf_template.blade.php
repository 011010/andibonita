<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reac PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .firma {
            width: 150px;
            height: auto;
        }
        .evidencias img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Formulario</h1>
    <p><strong>Nombre del Tutor:</strong> {{ $tutores['tutor'] }}</p>
    <p><strong>División:</strong> {{ $tutores['division'] }}</p>
    <p><strong>Núm. de Tutorados:</strong> {{ $tutorados['num_tutorados'] }}</p>
    <p><strong>Fecha de Entrega:</strong> {{ $calendarios['fecha_entrega'] }}</p>
    <p><strong>Semestre/Grupo:</strong> {{ $data['semestre_grupo'] }}</p>
    <p><strong>Horas Tutorías/Semana:</strong> {{ $data['horas_tutorias_semana'] }}</p>

    <h2>Sesiones</h2>
    <table>
        <thead>
            <tr>
                <th>No. Sesión</th>
                <th>Fecha</th>
                <th>Hora de Sesión</th>
                <th>Modalidad</th>
                <th>Grupal</th>
                <th>Tema</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['no_sesion'] as $index => $no_sesion)
                <tr>
                    <td>{{ $no_sesion }}</td>
                    <td>{{ $data['fecha_sesion'][$index] }}</td>
                    <td>{{ $data['hora_sesion'][$index] }}</td>
                    <td>{{ $data['modalidad'][$index] }}</td>
                    <td>{{ isset($data['grupal'][$index]) ? 'Sí' : 'No' }}</td>
                    <td>{{ $data['tema'][$index] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Evidencia Fotográfica</h2>
    <div class="evidencias">
        @foreach($data['evidencias_fotograficas'] as $evidencia)
            <img src="{{ public_path('storage/' . $evidencia) }}" alt="Evidencia Fotográfica">
        @endforeach
    </div>

    <h2>Evidencias de Lista</h2>
    <ul>
        @foreach($data['evidencias_lista'] as $evidencia)
            <li><a href="{{ public_path('storage/' . $evidencia) }}">{{ basename($evidencia) }}</a></li>
        @endforeach
    </ul>

    <p><strong>Firma del Tutor:</strong></p>
    <img src="{{ public_path('storage/' . $data['firma']) }}" class="firma" alt="Firma del Tutor">
</body>
</html>
