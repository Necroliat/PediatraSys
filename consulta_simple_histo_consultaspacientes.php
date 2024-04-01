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

// Obtener el ID de la consulta enviado por AJAX
$idConsulta = $_POST['id_consulta'];

// Consulta para obtener los datos de la consulta
$query = "SELECT c.id_consulta, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente, 
                 CONCAT(m.nombre, ' ', m.apellido) AS nombre_medico, c.fecha, c.hora
          FROM consultas c
          INNER JOIN paciente p ON c.id_paciente = p.id_paciente
          INNER JOIN medicos m ON c.id_medico = m.id_medico
          WHERE c.id_consulta = '$idConsulta'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Devolver los datos de la consulta como JSON
    $response = array(
        'id_consulta' => $row['id_consulta'],
        'nombre_pacientes' => $row['nombre_paciente'],
        'nombre_medico' => $row['nombre_medico'],
        'fecha' => $row['fecha'],
        'hora' => $row['hora']
    );
    echo json_encode($response);
} else {
    // No se encontró ninguna consulta con ese ID
    echo json_encode(array('id_consulta' => '', 'nombre_pacientes' => 'nada', 'nombre_medico' => '', 'fecha' => '', 'hora' => ''));
}

// Cerrar la conexión
$conn->close();
?>
