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

// Verificar si se recibieron datos para la receta y el detalle de receta
if (isset($dataArray['receta'])) {
    $receta = $dataArray['receta'];

    // Insertar datos en la tabla recetas
    $sql_receta = "INSERT INTO recetas (id_consulta, id_centro) 
                   VALUES ('{$receta['id_consulta']}', '{$receta['id_centro']}')";

    if ($conn->query($sql_receta) === TRUE) {
        $last_id = $conn->insert_id;

        if (isset($dataArray['detalle_receta'])) {
            $detalleReceta = $dataArray['detalle_receta'];

            // Verificar si hay detalles de receta para insertar
            if (!empty($detalleReceta)) {
                foreach ($detalleReceta as $detalle) {
                    $sql_detalle_receta = "INSERT INTO detalle_receta (ID_Receta, id_medicamento, nombre_medicamento, cantidad, unidad_medida, frecuencia, tiempo_uso) 
                                           VALUES ('$last_id', '{$detalle['id_medicamento']}', '{$detalle['nombre_medicamento']}', '{$detalle['cantidad']}', '{$detalle['unidad_medida']}', '{$detalle['frecuencia']}', '{$detalle['tiempo_uso']}')";
                    $conn->query($sql_detalle_receta);
                }
            }
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
