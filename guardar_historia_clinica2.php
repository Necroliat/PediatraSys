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

// Verificar si la clave 'pacientesPadecimientos' está presente en el array
if (isset($dataArray['pacientesPadecimientos'])) {
    $pacientesPadecimientos = $dataArray['pacientesPadecimientos'];

    // Función para guardar los datos de pacientes_Padecimientos
    function guardarPacientesPadecimientos($conn, $id_paciente, $id_padecimiento, $nombre, $notas, $desde_cuando)
    {
        // Insertar datos en la tabla historia_clinica
        $sql_pacientes_padecimientos = "INSERT INTO historia_clinica (ID_Paciente) VALUES ('$id_paciente')";
        if ($conn->query($sql_pacientes_padecimientos) === FALSE) {
            echo "Error al guardar los datos de pacientes_vacunas: " . $conn->error;
            return;
        }

        // Obtener el ID_Pacientes_Padecimientos generado
        $ID_Pacientes_Padecimientos = $conn->insert_id;

        // Insertar datos en la tabla detalle_historia_clinica
        $sql_detalle_historia_clinica = "INSERT INTO detalle_historia_clinica (ID_Hist_Clic, id_padecimiento, notas, desde_cuando) VALUES ('$ID_Pacientes_Padecimientos', '$id_padecimiento', '$notas', '$desde_cuando')";
        if ($conn->query($sql_detalle_historia_clinica) === FALSE) {
            echo "Error al guardar el detalle de la historia clínica: " . $conn->error;
            return;
        }
    }

    // Verificar si la tabla de pacientes_padecimientos tiene datos
    if ($pacientesPadecimientos) {
        foreach ($pacientesPadecimientos as $Padecimientos) {
            // Verificar si las claves necesarias están presentes en cada iteración
            if (
                isset($Padecimientos['id_paciente'], $Padecimientos['id_Padecimientos'], $Padecimientos['nombre'], $Padecimientos['notas'], $Padecimientos['desde_cuando'])
            ) {
                guardarPacientesPadecimientos(
                    $conn,
                    $Padecimientos['id_paciente'],
                    $Padecimientos['id_Padecimientos'],
                    $Padecimientos['nombre'],
                    $Padecimientos['notas'],
                    $Padecimientos['desde_cuando']
                );
            } else {
                echo "Error: Faltan claves necesarias en la entrada de datos.";
            }
        }

        echo "Datos de pacientes_padecimientos guardados exitosamente.";
    }
} else {
    echo "Error: Clave 'pacientesPadecimientos' no presente en los datos recibidos.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
