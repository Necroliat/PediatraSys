<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Agrega los estilos de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Agrega estilos personalizados -->
  <style>
    /* Estilos personalizados */
    .zebra-table tbody tr:nth-of-type(odd) {
      background-color: rgba(255,255,255,0.6);
    }
    .rounded-corners {
      border-radius: 10px;
        
    }
      fieldset {
      border: 1px solid #ddd;
      border-radius: 2vw;
      background: linear-gradient(to right, #e4e5dc, #45bac9db);
      padding: 1vw;
      box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
      margin: 120px;


    }
      body {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
    }

    fieldset {
      background: linear-gradient(to right, #e4e5dc, #62c4f9);
    }
  </style>
    <title>Citas del Día</title>
</head>
<body>
    <fieldset>
    <div class="table-responsive">
<!--    <h2>Citas del Día</h2>-->

    <?php
    error_reporting(E_ERROR | E_PARSE);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pediatra_sis";
    session_start();
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

    // Procesamiento de los formularios
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['cancelada'])) {
        $idCita = $_POST['id_cita'];
        $estado = "Cancelada";
        $sql = "UPDATE citas SET Estado='$estado' WHERE id_cita='$idCita'";
        if ($conn->query($sql) === TRUE) {
          //echo "Cita cancelada con éxito.";
            //header("Location: proces_citasXmedico.php");
        } else {
          echo "Error al cancelar la cita: " . $conn->error;
        }
      }

      if (isset($_POST['consultando'])) {
        $idCita = $_POST['id_cita'];
        $estado = "En consulta";
        $sql = "UPDATE citas SET Estado='$estado' WHERE id_cita='$idCita'";
        if ($conn->query($sql) === TRUE) {
          //echo "Cita cambiada a 'En consulta' con éxito.";
          // header("Location: proces_citasXmedico.php");
        } else {
          echo "Error al cambiar el estado de la cita a 'En consulta': " . $conn->error;
        }
      }

      if (isset($_POST['atendida'])) {
        $idCita = $_POST['id_cita'];
        $estado = "Atendida";
        $sql = "UPDATE citas SET Estado='$estado' WHERE id_cita='$idCita'";
        if ($conn->query($sql) === TRUE) {
         // echo "Cita marcada como 'Atendida' con éxito.";
           // header("Location: proces_citasXmedico.php");
        } else {
          echo "Error al cambiar el estado de la cita a 'Atendida': " . $conn->error;
        }
      }
    }

    //$idMedico = 18; // Supongamos que tienes el ID del médico que deseas consultar
    //fecha actual sql-- CURDATE()
    $idMedico =  $_SESSION['id_medico'];
    //$idMedico = $_GET["id_medico"];
        
 // Obtener el nombre y apellido del médico
$sql_medico = "SELECT nombre, apellido FROM medicos WHERE id_medico = $idMedico";
$result_medico = $conn->query($sql_medico);

$nombre_medico = "";
$apellido_medico = "";
if ($result_medico->num_rows > 0) {
  $row_medico = $result_medico->fetch_assoc();
  $nombre_medico = $row_medico["nombre"];
  $apellido_medico = $row_medico["apellido"];
}

// Obtener la fecha actual en formato corto
$fecha_actual = date("d/m/Y");

// Imprimir la etiqueta <h2> con el nombre del médico y la fecha actual
echo "<h5 style='text-transform: uppercase;'>Citas del Día - Dr./Dra $nombre_medico $apellido_medico - $fecha_actual</h5>";
        
        
        
    $sql = "SELECT c.id_cita, c.fecha, c.hora, c.id_paciente, c.Estado, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
                FROM citas c
                INNER JOIN paciente p ON c.id_paciente = p.id_paciente
                WHERE c.id_medico = $idMedico AND DATE(c.fecha) ='CURDATE()'  AND ESTADO='Vigente' OR ESTADO='En consulta'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
     echo "<table class='table table-striped zebra-table rounded-corners'>
        <tr>
          <th>ID Cita</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>ID</th>
          <th>Estado</th>
          <th>Nombre del Paciente</th>
          <th>Acción</th>
        </tr>";
// Output data of each row
while ($row = $result->fetch_assoc()) {
  echo "<tr>
            <td>" . $row["id_cita"] . "</td>
            <td>" . $row["fecha"] . "</td>
            <td>" . $row["hora"] . "</td>
            <td>" . $row["id_paciente"] . "</td>
            <td>" . $row["Estado"] . "</td>
            <td>" . $row["nombre_paciente"] . "</td>
            <td>
              <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                <input type='hidden' name='id_cita' value='" . $row["id_cita"] . "'>";

  // Consulta para obtener el estado de la cita
  $sql_estado = "SELECT Estado FROM citas WHERE id_cita = '" . $row["id_cita"] . "'";
  $resultado_estado = $conn->query($sql_estado);

  // Verificar si se encontró el estado y si es "En consulta"
  if ($resultado_estado->num_rows > 0) {
    $fila_estado = $resultado_estado->fetch_assoc();
    $estado = $fila_estado["Estado"];

    // Si el estado es "En consulta", deshabilitar el botón y aplicar estilo verde
    if ($estado == "En consulta") {
      echo "<button type='submit' name='cancelada' class='btn btn-danger'><i class='fas fa-ban'></i> Cancelada</button>
            <button type='submit' name='consultando' class='btn btn-success' disabled><i class='fas fa-stethoscope'></i> Consultando</button>
            <button type='submit' name='atendida' class='btn btn-primary'><i class='fas fa-check-circle'></i> Atendida</button>";
    } else {
      // Si no es "En consulta", mostrar el botón normalmente con estilo azul
      echo "<button type='submit' name='cancelada' class='btn btn-danger'><i class='fas fa-ban'></i> Cancelada</button>
            <button type='submit' name='consultando' class='btn btn-primary'><i class='fas fa-stethoscope'></i> Consultando</button>
            <button type='submit' name='atendida' class='btn btn-primary'><i class='fas fa-check-circle'></i> Atendida</button>";
    }
  } else {
    // Si no se encuentra el estado, mostrar todos los botones normalmente con estilo azul
    echo "<button type='submit' name='cancelada' class='btn btn-danger'><i class='fas fa-ban'></i> Cancelada</button>
          <button type='submit' name='consultando' class='btn btn-primary'><i class='fas fa-stethoscope'></i> Consultando</button>
          <button type='submit' name='atendida' class='btn btn-primary'><i class='fas fa-check-circle'></i> Atendida</button>";
  }

  echo "</form>
      </td>
    </tr>";
}
      echo "</table>";
    } else {
      echo "0 resultados/No hay citas por ahora!!";
    }

    ?>
        <?php 
        

// Consulta para obtener las citas canceladas o atendidas
$sql_segunda_tabla = "SELECT c.id_cita, c.fecha, c.hora, c.id_paciente, c.Estado, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
                      FROM citas c
                      INNER JOIN paciente p ON c.id_paciente = p.id_paciente
                      WHERE c.id_medico = $idMedico AND DATE(c.fecha) ='CURDATE()'  AND (ESTADO = 'Cancelada' OR ESTADO = 'Atendida')";
/*// Consulta para obtener las citas canceladas o atendidas
$sql_segunda_tabla = "SELECT c.id_cita, c.fecha, c.hora, c.id_paciente, c.Estado, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
                FROM citas c
                INNER JOIN paciente p ON c.id_paciente = p.id_paciente
                WHERE c.id_medico = $idMedico AND DATE(c.fecha) ='2024-04-13'  AND ESTADO='Atendida' OR ESTADO='Cancelada'";*/
$result_segunda_tabla = $conn->query($sql_segunda_tabla);

if ($result_segunda_tabla->num_rows > 0) {
  echo "<h5 style='text-transform: uppercase;'>Historial de Citas - Dr./Dra. $nombre_medico $apellido_medico</h5>";
  echo "<table class='table table-striped zebra-table rounded-corners'>";
  echo "<tr>
          <th>ID Cita</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>ID</th>
          <th>Estado</th>
          <th>Paciente</th>
        </tr>";

  while ($row = $result_segunda_tabla->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id_cita"] . "</td>
            <td>" . $row["fecha"] . "</td>
            <td>" . $row["hora"] . "</td>
            <td>" . $row["id_paciente"] . "</td>
            <td style='background-color: " . ($row["Estado"] == 'Cancelada' ? 'red' : 'green') . "; color: white; text-align: center;'><i class='" . ($row["Estado"] == 'Cancelada' ? 'fas fa-times-circle' : 'fas fa-check-circle') . "'></i> " . $row["Estado"] . "</td>
            <td>" . $row["nombre_paciente"] . "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No hay citas canceladas o atendidas para mostrar.</p>";
}

$conn->close();
 
        ?>
       <a href="consultamedicospacientescitas.php" id="btnatras" class="btn btn-primary" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
      <i class="fa-solid fa-left-long"></i> Regresar
    </a> 
    </div>
        </fieldset>
</body>
</html>

