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

// Obtener el ID del medicamento enviado por AJAX
$idMedicamento = $_POST['id_medicamento'];

// Consulta para obtener el nombre y la descripción del medicamento
$query = "SELECT nombre_medicamento, descripcion FROM medicamento WHERE Id_medicamento = '$idMedicamento'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreMedicamento = $row['nombre_medicamento'];
    $descripcionMedicamento = $row['descripcion'];

    // Devolver el nombre y la descripción del medicamento como JSON
    $response = array(
        'nombre' => $nombreMedicamento,
        'descripcion' => $descripcionMedicamento
    );
    echo json_encode($response);
} else {
    // No se encontró ningún medicamento con ese ID
    $response = array(
        'nombre' => '',
        'descripcion' => ''
    );
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
