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

// Verificar si se recibieron datos para la receta y los detalles de la receta
if (isset($dataArray['receta']) && isset($dataArray['detalles_receta'])) {
    $receta = $dataArray['receta'];
    $detallesReceta = $dataArray['detalles_receta'];

    // Insertar la prescripción médica
    $sql_receta = "INSERT INTO prescripcion_medica (id_consulta, id_centro) 
                   VALUES ('{$receta['id_consulta']}', '{$receta['id_centro']}')";

    if ($conn->query($sql_receta) === TRUE) {
        $last_id = $conn->insert_id;

        // Insertar los detalles de la prescripción médica
        foreach ($detallesReceta as $detalle) {
            $id_medicamento = $detalle['id_medicamento'];
            $cantidad = $detalle['cantidad'];
            $unidad_medida = $detalle['unidad_medida'];
            $frecuencia = $detalle['frecuencia'];
            $tiempo_uso = $detalle['tiempo_uso'];

            $sql_detalle_receta = "INSERT INTO detalle_prescripcion (id_receta, id_medicamento, cantidad, unidad_de_medida, frecuencia, tiempo_de_uso) 
                                   VALUES ('$last_id', '$id_medicamento', '$cantidad', '$unidad_medida', '$frecuencia', '$tiempo_uso')";
            $conn->query($sql_detalle_receta);
        }

        echo "Receta guardada exitosamente con ID: $last_id";
    } else {
        echo "Error al guardar la receta: " . $conn->error;
    }
} else {
    echo "Error: Datos incompletos recibidos.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
