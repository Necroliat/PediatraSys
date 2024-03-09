<?php
echo "Datos recibidos en guardar_historia_clinica.php:<br>";
var_dump($_POST);

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

$pacientesPadecimientos = $dataArray['pacientesPadecimientos'];

// Función para guardar los datos de pacientes_Padecimientos
function guardarPacientesPadecimientos($conn, $pacientesPadecimientos)
{
    foreach ($pacientesPadecimientos as $Padecimientos) {
        // Verificar la existencia de las claves necesarias
        if (isset($Padecimientos['id_paciente'], $Padecimientos['id_padecimiento'], $Padecimientos['nombre_padecimiento'], $Padecimientos['notas'], $Padecimientos['desde_cuando'])) {
            $id_paciente = $Padecimientos['id_paciente'];
            $id_padecimiento = $Padecimientos['id_padecimiento'];
            $nombre = $Padecimientos['nombre_padecimiento'];
            $notas = $Padecimientos['notas'];
            $desde_cuando = $Padecimientos['desde_cuando'];

            // Crear una consulta preparada para insertar los datos en la tabla historia_clinica
            $sql_pacientes_padecimientos = "INSERT INTO historia_clinica (ID_Paciente) VALUES (?)";

            // Preparar la declaración
            $stmt = $conn->prepare($sql_pacientes_padecimientos);

            // Vincular los parámetros
            $stmt->bind_param("s", $id_paciente);

            // Ejecutar la consulta preparada
            if ($stmt->execute() === FALSE) {
                $error_message = "Error al guardar los datos de pacientes_padecimientos: " . $conn->error;
                error_log($error_message); // Registra el error en el archivo de registro del servidor o en otro lugar adecuado
                echo $error_message; // Muestra el mensaje de error al cliente
                return;
            }

            // Obtener el ID_Pacientes_Padecimientos generado
            $ID_Pacientes_Padecimientos = $conn->insert_id;

            // Crear una consulta preparada para insertar los datos en la tabla detalle_historia_clinica
            $sql_detalle_historia_clinica = "INSERT INTO detalle_historia_clinica (ID_Hist_Clic, id_padecimiento, notas, desde_cuando) VALUES (?, ?, ?, ?)";

            // Preparar la declaración
            $stmt_detalle = $conn->prepare($sql_detalle_historia_clinica);

            // Vincular los parámetros
            $stmt_detalle->bind_param("ssss", $ID_Pacientes_Padecimientos, $id_padecimiento, $notas, $desde_cuando);

            // Ejecutar la consulta preparada
            if ($stmt_detalle->execute() === FALSE) {
                $error_message = "Error al guardar el detalle de la historia clínica: " . $stmt_detalle->error;
                error_log($error_message); // Registra el error en el archivo de registro del servidor o en otro lugar adecuado
                echo $error_message; // Muestra el mensaje de error al cliente
                return;
            }
        } else {
            // Manejar el caso en el que falten claves necesarias
            echo "Error: Faltan claves necesarias en la entrada de datos.";
            return;
        }
    }

    echo "Datos de pacientes_padecimientos guardados exitosamente.";
}

// Verificar si la tabla de pacientes_padecimientos tiene datos
if ($pacientesPadecimientos) {
    guardarPacientesPadecimientos($conn, $pacientesPadecimientos);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
