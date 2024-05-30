<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Calendario de Tutorías</title>
  <link rel="stylesheet" href="assets/welcome.css">
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
      line-height:-1;
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
        <td><input type="text" name="documento" required></td>
        <td><input type="text" name="periodo" required></td>
        <td><input type="date" name="fecha_entrega" required></td>
      </tr>
      <tr>
        <td colspan="3"><input type="date" name="inicio_tutorias" required></td>
      </tr>
      <tr>
        <td>REAC 1</td>
        <td colspan="2"><input type="date" name="reac_1" required></td>
      </tr>
      <tr>
        <td>RESA 1</td>
        <td colspan="2"><input type="date" name="resa_1" required></td>
      </tr>
      <tr>
        <td>REAC 2</td>
        <td colspan="2"><input type="date" name="reac_2" required></td>
      </tr>
      <tr>
        <td>RESA 2</td>
        <td colspan="2"><input type="date" name="resa_2" required></td>
      </tr>
      <tr>
        <td>REAC 3</td>
        <td colspan="2"><input type="date" name="reac_3" required></td>
      </tr>
      <tr>
        <td>RESA 3</td>
        <td colspan="2"><input type="date" name="resa_3" required></td>
      </tr>
      <tr>
        <td>REAC 4</td>
        <td colspan="2"><input type="date" name="reac_4" required></td>
      </tr>
      <tr>
        <td>RESA 4</td>
        <td colspan="2"><input type="date" name="resa_4" required></td>
      </tr>
      <tr>
        <td colspan="3"><input type="date" name="fin_tutorias" required></td>
      </tr>
      <tr>
        <td>Informe de asistencia</td>
        <td colspan="2"><input type="date" name="informe_asistencia" required></td>
      </tr>
      <tr>
        <td>Evidencia de canalizacion</td>
        <td colspan="2"><input type="date" name="evidencia_canalizacion" required></td>
      </tr>
      <tr>
        <td>Reporte semestral</td>
        <td colspan="2"><input type="date" name="reporte_semestral" required></td>
      </tr>
      <tr>
        <td>Copias de actas</td>
        <td colspan="2"><input type="date" name="copias_actas" required></td>
      </tr>
    </tbody>
  </table>

  <form action="{{ url('/formulario') }}" method="POST">
    @csrf
    <button type="submit">Guardar Datos</button>
  </form>
</body>
</html>
