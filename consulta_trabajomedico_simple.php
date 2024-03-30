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

// Obtener el ID del trabajo médico enviado por AJAX
$idTrabajoMedico = $_POST['id_trabajo_medico'];

// Consulta para obtener la descripción del trabajo médico
$query = "SELECT descripcion_trabajo_medico FROM trabajos_medicos WHERE id_trabajo_medico = '$idTrabajoMedico'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $descripcionTrabajoMedico = $row['descripcion_trabajo_medico'];

    // Devolver la descripción del trabajo médico como JSON
    $response = array(
        'descripcion_trabajo_medico' => $descripcionTrabajoMedico
    );
    echo json_encode($response);
} else {
    // No se encontró ningún trabajo médico con ese ID
    $response = array(
        'descripcion_trabajo_medico' => ''
    );
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
