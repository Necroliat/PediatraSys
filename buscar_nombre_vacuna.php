<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID de la vacuna enviado por AJAX
$idVacuna = $_POST['id_vacuna'];

// Consulta para obtener el nombre de la vacuna
$query = "SELECT nombre FROM tipo_vacunas WHERE id_vacuna = '$idVacuna'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreVacuna = $row['nombre'];

    // Devolver el nombre de la vacuna como JSON
    $response = array('Nombre' => $nombreVacuna);
    echo json_encode($response);
} else {
    // No se encontró ninguna vacuna con ese ID
    $response = array('Nombre' => '');
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
