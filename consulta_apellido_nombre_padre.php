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
$idpadre = $_POST['id_padres'];

// Preparar la consulta
$stmt = $conn->prepare("SELECT Nombre, Apellido FROM datos_padres_de_pacientes WHERE Numidentificador LIKE ? LIMIT 1");
$likeIdpadre = "%$idpadre%";
$stmt->bind_param("s", $likeIdpadre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombrepadre = $row['Nombre'];
    $apellidopadre = $row['Apellido'];
} else {
    // No se encontró ningún paciente con ese ID, se establece un valor predeterminado
    $nombrepadre = '';
    $apellidopadre = '';
}

// Devolver el nombre y el apellido del paciente como JSON
$response = array(
    'nombre' => $nombrepadre,
    'apellido' => $apellidopadre
);
echo json_encode($response);

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
