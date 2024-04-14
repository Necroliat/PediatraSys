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
      echo "Cita cancelada con éxito.";
        header("Location: proces_citasXmedico.php");
    } else {
      echo "Error al cancelar la cita: " . $conn->error;
    }
  }

  if (isset($_POST['consultando'])) {
    $idCita = $_POST['id_cita'];
    $estado = "En consulta";
    $sql = "UPDATE citas SET Estado='$estado' WHERE id_cita='$idCita'";
    if ($conn->query($sql) === TRUE) {
      echo "Cita cambiada a 'En consulta' con éxito.";
        header("Location: proces_citasXmedico.php");
    } else {
      echo "Error al cambiar el estado de la cita a 'En consulta': " . $conn->error;
    }
  }

  if (isset($_POST['atendida'])) {
    $idCita = $_POST['id_cita'];
    $estado = "Atendida";
    $sql = "UPDATE citas SET Estado='$estado' WHERE id_cita='$idCita'";
    if ($conn->query($sql) === TRUE) {
      echo "Cita marcada como 'Atendida' con éxito.";
        header("Location: proces_citasXmedico.php");
    } else {
      echo "Error al cambiar el estado de la cita a 'Atendida': " . $conn->error;
    }
  }
}

//$idMedico = 1; // Supongamos que tienes el ID del médico que deseas consultar
//$idMedico =  $_SESSION['id_medico'];
$idMedico = $_GET["id_medico"];
$sql = "SELECT c.id_cita, c.fecha, c.hora, c.id_paciente, c.Estado, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
            FROM citas c
            INNER JOIN paciente p ON c.id_paciente = p.id_paciente
            WHERE c.id_medico = $idMedico AND DATE(c.fecha) = CURDATE() AND ESTADO='Vigente' OR ESTADO='En consulta'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'>
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
              <input type='hidden' name='id_cita' value='" . $row["id_cita"] . "'>
              <input type='submit' name='cancelada' value='Cancelada'>
              <input type='submit' name='consultando' value='Consultando'>
              <input type='submit' name='atendida' value='Atendida'>
            </form>
          </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "0 resultados";
}
$conn->close();
?>
