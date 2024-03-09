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

// Obtener el ID del paciente enviado por AJAX
$idmedico = $_POST['id_medico'];

// Consulta para obtener el nombre y el apellido del paciente
$query = "SELECT nombre, apellido FROM medicos WHERE id_medico = '$idmedico'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombremedico = $row['nombre'];
    $apellidomedico = $row['apellido'];

    // Devolver el nombre y el apellido del paciente como JSON
    $response = array(
        'nombre' => $nombremedico,
        'apellido' => $apellidomedico
    );
    echo json_encode($response);
} else {
    // No se encontró ningún paciente con ese ID
    $response = array(
        'nombre' => '',
        'apellido' => ''
    );
    echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>