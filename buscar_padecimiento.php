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

// Obtener el ID del padecimiento enviado por AJAX
$idPadecimiento = $_POST['id_padecimiento'];

// Consulta para obtener el nombre del padecimiento
$query = "SELECT nombre_padecimiento FROM padecimientos_comunes WHERE id_padecimiento = '$idPadecimiento'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombrePadecimiento = $row['nombre_padecimiento'];

    // Devolver el nombre del padecimiento como JSON
    $response = array('nombre_padecimiento' => $nombrePadecimiento);
    echo json_encode($response);
} else {
    // No se encontró ningún padecimiento con ese ID
    $response = array('nombre_padecimiento' => '');
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>

