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
$idPaciente = $_POST['id_paciente'];

// Consulta para obtener el nombre y el apellido del paciente
$query = "SELECT 
p.*
FROM 
paciente p
WHERE p.id_paciente=$idPaciente and
p.id_paciente NOT IN (SELECT sp.id_paciente FROM seguro_paciente sp);
";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombrePaciente = $row['nombre'];
    $apellidoPaciente = $row['apellido'];

    // Devolver el nombre y el apellido del paciente como JSON
    $response = array(
        'nombre' => $nombrePaciente,
        'apellido' => $apellidoPaciente
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
