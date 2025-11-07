<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REAC - Reporte de Actividades de Tutoría</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 16pt;
            margin: 5px 0;
        }
        .header p {
            margin: 2px 0;
            font-size: 10pt;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            padding: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
        }
        .info-value {
            display: table-cell;
            width: 70%;
            padding: 5px;
            border: 1px solid #ccc;
        }
        table.sesiones {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        table.sesiones th,
        table.sesiones td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }
        table.sesiones th {
            background-color: #d0d0d0;
            font-weight: bold;
            font-size: 10pt;
        }
        table.sesiones td {
            font-size: 9pt;
        }
        .evidencias-section {
            margin-top: 20px;
        }
        .evidencias-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .evidencia-item img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ccc;
            padding: 3px;
        }
        .firma-section {
            margin-top: 30px;
            text-align: center;
        }
        .firma-img {
            max-width: 200px;
            height: auto;
            border: 1px solid #333;
            padding: 5px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            font-size: 8pt;
            color: #666;
        }
        h2 {
            font-size: 13pt;
            background-color: #e0e0e0;
            padding: 5px;
            margin: 15px 0 10px 0;
            border-left: 4px solid #666;
        }
    </style>
</head>
<body>
    {{-- Encabezado del Documento --}}
    <div class="header">
        <h1>REPORTE DE ACTIVIDADES DE TUTORÍA (REAC)</h1>
        <p>Instituto Tecnológico</p>
        <p><strong>Semestre:</strong> {{ $reac->semestre_grupo }}</p>
    </div>

    {{-- Información General --}}
    <div class="info-section">
        <h2>Información General</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nombre del Tutor:</div>
                <div class="info-value">{{ $reac->tutor }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">División:</div>
                <div class="info-value">{{ $reac->division ?? ($reac->divisionRelacion->nombre ?? 'N/A') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Número de Tutorados:</div>
                <div class="info-value">{{ $reac->num_tutorados }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Semestre/Grupo:</div>
                <div class="info-value">{{ $reac->semestre_grupo }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Horas de Tutoría/Semana:</div>
                <div class="info-value">{{ number_format($reac->horas_tutorias_semana, 1) }} horas</div>
            </div>
            <div class="info-row">
                <div class="info-label">Fecha de Entrega:</div>
                <div class="info-value">{{ $reac->fecha_entrega->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>

    {{-- Sesiones de Tutoría --}}
    <h2>Sesiones de Tutoría</h2>
    <table class="sesiones">
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
            @forelse($reac->sesiones as $sesion)
                <tr>
                    <td>{{ $sesion->no_sesion }}</td>
                    <td>{{ \Carbon\Carbon::parse($sesion->fecha_sesion)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($sesion->hora_sesion)->format('H:i') }}</td>
                    <td>{{ ucfirst($sesion->modalidad) }}</td>
                    <td>{{ $sesion->es_grupal ? 'Grupal' : 'Individual' }}</td>
                    <td style="text-align: left;">{{ $sesion->tema }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se registraron sesiones</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><strong>Total de sesiones registradas:</strong> {{ $reac->sesiones->count() }}</p>

    {{-- Evidencias Fotográficas --}}
    @if($reac->evidencias_fotograficas && count($reac->evidencias_fotograficas) > 0)
        <div class="evidencias-section">
            <h2>Evidencias Fotográficas</h2>
            <div class="evidencias-grid">
                @foreach($reac->evidencias_fotograficas as $evidencia)
                    <div class="evidencia-item">
                        <img src="{{ public_path('storage/' . $evidencia) }}" alt="Evidencia Fotográfica">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Evidencias de Lista --}}
    @if($reac->evidencias_lista && count($reac->evidencias_lista) > 0)
        <div class="evidencias-section">
            <h2>Evidencias de Lista de Asistencia</h2>
            <ul>
                @foreach($reac->evidencias_lista as $evidencia)
                    <li>{{ basename($evidencia) }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Observaciones --}}
    @if($reac->observaciones)
        <div class="evidencias-section">
            <h2>Observaciones</h2>
            <p style="text-align: justify;">{{ $reac->observaciones }}</p>
        </div>
    @endif

    {{-- Firma del Tutor --}}
    <div class="firma-section">
        <p><strong>Firma del Tutor:</strong></p>
        <img src="{{ public_path('storage/' . $reac->firma) }}" class="firma-img" alt="Firma del Tutor">
        <p style="margin-top: 20px;">_________________________________</p>
        <p><strong>{{ $reac->tutor }}</strong></p>
        <p>{{ $reac->division }}</p>
    </div>

    {{-- Pie de página --}}
    <div class="footer">
        <p>Documento generado el {{ now()->format('d/m/Y H:i') }}</p>
        <p>Estado del reporte: {{ $reac->estado_formateado }}</p>
    </div>
</body>
</html>
