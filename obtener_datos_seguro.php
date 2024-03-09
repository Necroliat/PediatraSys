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

// Consulta para obtener los datos del seguro
$query = "SELECT * FROM seguro WHERE Id_seguro_salud = '$idSeguro'";
$result = $conn->query($query);

// Obtener los datos como un array asociativo
$data = array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$data[] = $row;
	}
}

// Cerrar la conexión
$conn->close();

// Devolver los datos como JSON
echo json_encode($data);
?>