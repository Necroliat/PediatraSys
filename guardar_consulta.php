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

// Obtener los datos enviados desde el formulario
$data = file_get_contents('php://input');
$dataArray = json_decode($data, true);

// Verificar si se recibieron datos para la consulta y el detalle de consulta
if (isset($dataArray['consulta'])) {
    $consulta = $dataArray['consulta'];

    // Insertar datos en la tabla consultas
    $sql_consulta = "INSERT INTO consultas (id_paciente, id_medico, fecha, hora, diagnostico, tratamiento) 
                     VALUES ('{$consulta['id_paciente']}', '{$consulta['id_medico']}', '{$consulta['fecha']}', '{$consulta['hora']}', '{$consulta['diagnostico']}', '{$consulta['tratamiento']}')";

    if ($conn->query($sql_consulta) === TRUE) {
        $last_id = $conn->insert_id;

        if (isset($dataArray['detalle_consulta'])) {
            $detalleConsulta = $dataArray['detalle_consulta'];

            // Verificar si hay detalles de consulta para insertar
            if (!empty($detalleConsulta)) {
                foreach ($detalleConsulta as $detalle) {
                    $sql_detalle_consulta = "INSERT INTO detalle_consulta (ID_Consulta, id_trabajo_medico, Observacion) 
                                             VALUES ('$last_id', '{$detalle['id_trabajo_medico']}', '{$detalle['observacion']}')";
                    $conn->query($sql_detalle_consulta);
                }
            }
        }

        echo "Consulta guardada exitosamente con ID: $last_id";
    } else {
        echo "Error al guardar la consulta: " . $conn->error;
    }
} else {
    echo "Error: Datos incompletos recibidos.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
