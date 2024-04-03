<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Establecer la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener el último registro de prescripción médica y detalle de prescripción médica
$query = "SELECT pm.id_receta, dp.id_det_receta
          FROM prescripcion_medica pm
          INNER JOIN detalle_prescripcion dp ON pm.id_receta = dp.id_receta
          ORDER BY pm.id_receta DESC
          LIMIT 1";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Devolver los datos del último registro como JSON
    $response = array(
        'id_receta' => $row['id_receta'],
        'id_det_receta' => $row['id_det_receta']
    );
    echo json_encode($response);
} else {
    // No se encontró ningún registro
    echo json_encode(array('id_receta' => '', 'id_det_receta' => ''));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
