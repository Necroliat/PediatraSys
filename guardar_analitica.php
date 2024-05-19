<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Establecer la conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer la zona horaria a Santo Domingo, República Dominicana
date_default_timezone_set('America/Santo_Domingo');

// Obtener los datos enviados desde el formulario
$data = file_get_contents('php://input');
$dataArray = json_decode($data, true);

// Verificar si se recibieron datos para la analítica y los detalles de la analítica
if (isset($dataArray['analitica']) && isset($dataArray['detalles_analitica'])) {
    $analitica = $dataArray['analitica'];
    $detallesAnalitica = $dataArray['detalles_analitica'];

    // Obtener la fecha y hora actual
    $fechaHoraActual = date("Y-m-d H:i:s");

    // Insertar la analítica con la fecha y hora actual
    $sql_analitica = "INSERT INTO analitica_paciente (id_consulta, id_centro, id_paciente, id_medico, fecha_hora) 
                      VALUES ('{$analitica['id_consulta']}', '{$analitica['id_centro']}', '{$analitica['id_paciente']}', '{$analitica['id_medico']}', '$fechaHoraActual')";

    if ($conn->query($sql_analitica) === TRUE) {
        $last_id = $conn->insert_id;

        // Insertar los detalles de la analítica
        foreach ($detallesAnalitica as $detalle) {
            $id_analisis = $detalle['id_analisis'];

            $sql_detalle_analitica = "INSERT INTO detalle_analitica (id_analitica, id_analisis) 
                                      VALUES ('$last_id', '$id_analisis')";
            $conn->query($sql_detalle_analitica);
        }

        echo "Analítica guardada exitosamente con ID: $last_id";
    } else {
        echo "Error al guardar la analítica: " . $conn->error;
    }
} else {
    echo "Error: Datos incompletos recibidos.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
