<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Tutorías PDF</title>
    <style>
        /* Estilo general del calendario */
        .calendario {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        .calendario th,
        .calendario td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;
        }

        .calendario th {
            background-color: #f0f0f0;
        }

        /* Encabezado del calendario */
        .encabezado {
            text-align: center;
            font-size: 24px;
            margin-bottom: 0px;
            margin-top: -40px;
        }

        /* Información del instituto */
        .info-instituto {
            text-align: center;
            margin-bottom: 20px;
            line-height: -1;
        }

        /* Título del calendario */
        .titulo-calendario {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Tabla de fechas */
        .fechas {
            width: 100%;
        }

        .fechas tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .imagen {
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <div class="encabezado">
        <img src="{{ public_path('images/logo1.png') }}" alt="Logo 1" style="height: 50px;">
        <img src="{{ public_path('images/logo2.png') }}" alt="Logo 2" style="height: 47px;">
        <img src="{{ public_path('images/logo3.png') }}" alt="Logo 3" style="height: 50px;">
    </div>


    <div class="info-instituto">
        <p><strong>CALENDARIO PARA ENTREGA DE INFORMACIÓN DE TUTORÍAS</strong></p>
        <p><strong>JULIO-DIC 2023</strong></p>
    </div>

    <table class="calendario fechas">
        <thead>
            <tr>
                <th>DOCUMENTO A ENTREGAR</th>
                <th>PERIODO</th>
                <th>FECHA DE ENTREGA A COORDINADORAS/O DEPARTAMENTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $calendario->documento }}</td>
                <td>{{ $calendario->periodo }}</td>
                <td>{{ $calendario->fecha_entrega }}</td>
            </tr>
            <tr>
                <td colspan="3">INICIO DE TUTORÍAS ({{ $calendario->inicio_tutorias }})</td>
            </tr>
            <tr>
                <td>REAC 1</td>
                <td colspan="2">{{ $calendario->reac_1 }}</td>
            </tr>
            <tr>
                <td>RESA 1</td>
                <td colspan="2">{{ $calendario->resa_1 }}</td>
            </tr>
            <tr>
                <td>REAC 2</td>
                <td colspan="2">{{ $calendario->reac_2 }}</td>
            </tr>
            <tr>
                <td>RESA 2</td>
                <td colspan="2">{{ $calendario->resa_2 }}</td>
            </tr>
            <tr>
                <td>REAC 3</td>
                <td colspan="2">{{ $calendario->reac_3 }}</td>
            </tr>
            <tr>
                <td>RESA 3</td>
                <td colspan="2">{{ $calendario->resa_3 }}</td>
            </tr>
            <tr>
                <td>REAC 4</td>
                <td colspan="2">{{ $calendario->reac_4 }}</td>
            </tr>
            <tr>
                <td>RESA 4</td>
                <td colspan="2">{{ $calendario->resa_4 }}</td>
            </tr>
            <tr>
                <td colspan="3">FIN DE TUTORIAS ({{ $calendario->fin_tutorias }})</td>
            </tr>
            <tr>
                <td>Informe de asistencia</td>
                <td colspan="2">{{ $calendario->informe_asistencia }}</td>
            </tr>
            <tr>
                <td>Evidencia de canalización</td>
                <td colspan="2">{{ $calendario->evidencia_canalizacion }}</td>
            </tr>
            <tr>
                <td>Reporte semestral</td>
                <td colspan="2">{{ $calendario->reporte_semestral }}</td>
            </tr>
            <tr>
                <td>Copias de actas</td>
                <td colspan="2">{{ $calendario->copias_actas }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
