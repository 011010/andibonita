<div class="encabezado">
</div>

<div class="info-instituto">
  <p><strong>CALENDARIO PARA ENTREGA DE INFORMACIÓN DE TUTORÍAS</strong></p>
  <p><strong>JULIO-DIC 2023</strong></p>
</div>

<form action="{{ url('/calendario') }}" method="POST">
  @csrf
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
        <td>Evidencia de canalización</td>
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
  <button type="submit">Guardar Datos</button>
</form>