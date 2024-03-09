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

// Obtener el ID del seguro enviado por AJAX
$idSeguro = $_POST['id_seguro'];

// Consulta para obtener el nombre del seguro
$query = "SELECT Nombre FROM seguro WHERE Id_seguro_salud = '$idSeguro'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreSeguro = $row['Nombre'];

    // Devolver el nombre del seguro como JSON
    $response = array('Nombre' => $nombreSeguro);
    echo json_encode($response);
} else {
    // No se encontró ningún seguro con ese ID
    $response = false;
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
