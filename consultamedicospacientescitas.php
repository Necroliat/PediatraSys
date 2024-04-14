<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";
session_start();

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha seleccionado un médico para consultar sus citas
if (isset($_GET['id_medico'])) {
    $_SESSION['id_medico'] = $_GET['id_medico'];
    header("Location: consultacitasmedico.php");
    exit(); // Terminar el script después de redirigir
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Médicos y Citas</title>
</head>
<body>
    <h2>Lista de Médicos</h2>
    <table border='1'>
        <tr>
            <th>ID Médico</th>
            <th>Nombre del Médico</th>
            <th>Consultar Citas</th>
        </tr>

        <?php
        // Consulta para obtener la lista de médicos
        $sqlMedicos = "SELECT id_medico, CONCAT(nombre, ' ', apellido) AS nombre_medico FROM medicos";
        $resultadoMedicos = $conn->query($sqlMedicos);

        if ($resultadoMedicos->num_rows > 0) {
            while ($fila = $resultadoMedicos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["id_medico"] . "</td>";
                echo "<td>" . $fila["nombre_medico"] . "</td>";
                echo "<td><a href='?id_medico=" . $fila["id_medico"] . "'>Consultar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron médicos</td></tr>";
        }
        ?>

    </table>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>

