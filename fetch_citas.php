<?php 
     error_reporting(E_ERROR | E_PARSE);
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "pediatra_sis";
     session_start();
     // Crear conexión
     $conn = new mysqli($servername, $username, $password, $database);    
     $idMedico = isset($_GET['idMedico']) ? $_GET['idMedico'] : 'valor_por_defecto';
     $fecha_actual2 = isset($_GET['fechaActual']) ? $_GET['fechaActual'] : date('Y-m-d');
// Consulta para obtener las citas canceladas o atendidas
    // Consulta SQL
$sql_segunda_tabla = "
    SELECT 
        ROW_NUMBER() OVER(ORDER BY c.id_cita) AS Turno,
        c.id_cita, 
        c.fecha, 
        c.hora, 
        c.id_paciente, 
        c.Estado, 
        CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
    FROM 
        citas c
    INNER JOIN 
        paciente p ON c.id_paciente = p.id_paciente
    WHERE 
        c.id_medico = $idMedico 
        AND c.fecha = '$fecha_actual2' 
        AND (c.Estado = 'Vigente' OR c.Estado = 'En consulta')
    ORDER BY 
        c.id_cita;
";

        
        
$result_segunda_tabla = $conn->query($sql_segunda_tabla);

if ($result_segunda_tabla->num_rows > 0) {
    echo "<div class='centrado'><img src='IMAGENES/citamedica-64.png'  alt='Mantenimientos'style='width: 64px; height: 64px;'><img src='IMAGENES/turnos-100.png'  alt='Mantenimientos'style='width: 100px; height: 100px;'>
        </div>";
    echo"<h4 style='padding:0; text-align: center; text-transform: uppercase;'>Estatus de Turnos</h4>";
  echo "<h5 style='padding:0; text-align: center; text-transform: uppercase;'>Citas del Día DE- Dr./Dra $nombre_medico $apellido_medico - $fecha_actual</h5>";
  echo "<table class='table table-striped zebra-table rounded-corners'>";
  echo "<tr>
            <th>Turno</th>
            
            <th>Fecha</th>
            <th>Nombre Paciente</th>
           
            <th>Estado</th>
            
        </tr>";

  while ($row = $result_segunda_tabla->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["Turno"] . "</td>
               
                <td>" . $row["fecha"] . "</td>
               
                <td>" . $row["nombre_paciente"] . "</td>
                <td style='background-color: " . ($row["Estado"] == 'Vigente' ? 'darkslateblue' : 'green') . "; color: white; text-align: center;'><i class='" . ($row["Estado"] == 'En Consulta' ? 'fas fa-times-circle' : 'fa-solid fa-clock-rotate-left') . "'></i> " . $row["Estado"] . "</td>
                
          </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No hay citas canceladas o atendidas para mostrar.</p>";
}

$conn->close();
 
        ?>