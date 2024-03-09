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

$pacientesVacunas = $dataArray['pacientesVacunas'];

// Función para guardar los datos de pacientes_vacunas
function guardarPacientesVacunas($conn, $pacientesVacunas)
{
    foreach ($pacientesVacunas as $vacuna) {
        $id_paciente = $vacuna['id_paciente'];
        $id_vacuna = $vacuna['id_vacuna'];
        $dosis = $vacuna['dosis'];
        $refuerzo = $vacuna['refuerzo'];
        $fecha_aplicacion = $vacuna['fecha_aplicacion'];

        // Crear una consulta preparada para insertar los datos en la tabla
        $sql_pacientes_vacunas = "INSERT INTO pacientes_vacunas (id_paciente, id_vacuna, dosis, refuerzo, FECHA_APLICACION) VALUES (?, ?, ?, ?, ?)";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql_pacientes_vacunas);

        // Vincular los parámetros
        $stmt->bind_param("sssss", $id_paciente, $id_vacuna, $dosis, $refuerzo, $fecha_aplicacion);

        // Ejecutar la consulta preparada
        if ($stmt->execute() === FALSE) {
            $error_message = "Error al guardar los datos de pacientes_vacunas: " . $conn->error;
            error_log($error_message); // Registra el error en el archivo de registro del servidor o en otro lugar adecuado
            echo $error_message; // Muestra el mensaje de error al cliente
            return;
        }
    }

    echo "Datos de pacientes_vacunas guardados exitosamente.";
}

// Verificar si la tabla de pacientes_vacunas tiene datos
if ($pacientesVacunas) {
    guardarPacientesVacunas($conn, $pacientesVacunas);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>