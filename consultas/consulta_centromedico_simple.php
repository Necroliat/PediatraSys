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

// Obtener el ID del centro de salud enviado por AJAX
$idCentro = $_POST['id_centro'];

// Consulta para obtener el nombre, dirección y teléfono del centro de salud
$query = "SELECT nombre, direccion, telefono FROM institucion_de_salud WHERE id_centro = '$idCentro'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreCentro = $row['nombre'];
    $direccionCentro = $row['direccion'];
    $telefonoCentro = $row['telefono'];

    // Devolver el nombre, dirección y teléfono del centro de salud como JSON
    $response = array(
        'nombre' => $nombreCentro,
        'direccion' => $direccionCentro,
        'telefono' => $telefonoCentro
    );
    echo json_encode($response);
} else {
    // No se encontró ningún centro de salud con ese ID
    $response = array(
        'nombre' => '',
        'direccion' => '',
        'telefono' => ''
    );
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
