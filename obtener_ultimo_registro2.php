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

// Consulta para obtener el último registro de analítica y detalle de analítica
$query = "SELECT ap.id_analitica, da.ID_det_analitica
          FROM analitica_paciente ap
          INNER JOIN detalle_analitica da ON ap.id_analitica = da.id_analitica
          ORDER BY ap.id_analitica DESC
          LIMIT 1";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Devolver los datos del último registro como JSON
    $response = array(
        'id_analitica' => $row['id_analitica'],
        'id_det_analitica' => $row['ID_det_analitica']
    );
    echo json_encode($response);
} else {
    // No se encontró ningún registro
    echo json_encode(array('id_analitica' => '', 'id_det_analitica' => ''));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
