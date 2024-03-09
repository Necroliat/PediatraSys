<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Función para obtener el próximo ID de paciente.
function obtenerProximoIdPaciente($conn)
{
    // Realizar la consulta SQL para obtener el próximo ID de paciente
    $query = "SELECT MAX(id_paciente) AS ultimoId FROM paciente";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $ultimoIdPaciente = $row['ultimoId'];

    // Si la tabla está vacía, asignamos el valor inicial de 1 al próximo ID de paciente
    if (empty($ultimoIdPaciente)) {
        $proximoIdPaciente = 1;
    } else {
        // Incrementar el último ID para obtener el próximo ID
        $proximoIdPaciente = $ultimoIdPaciente + 1;
    }

    return $proximoIdPaciente;
}

// Función para guardar los datos de la historia clínica y su detalle
function guardarHistoriaClinica($conn, $proximoIdPaciente, $historiaClinica)
{
    // Insertar datos en la tabla historia_clinica
    $sql_historia_clinica = "INSERT INTO historia_clinica (ID_Paciente) VALUES ($proximoIdPaciente)";
    if ($conn->query($sql_historia_clinica) === TRUE) {
        // Obtener el ID_Hist_Clic generado
        $ID_Hist_Clic = $conn->insert_id;

        // Insertar datos en la tabla detalle_historia_clinica
        foreach ($historiaClinica as $detalle) {
            $id_padecimiento = $detalle['id_padecimiento'];
            $notas = $detalle['notas'];
            $desde_cuando = $detalle['desde_cuando'];
            
            $sql_detalle_historia_clinica = "INSERT INTO detalle_historia_clinica (ID_Hist_Clic, id_padecimiento, notas, desde_cuando) VALUES ($ID_Hist_Clic, '$id_padecimiento', '$notas', '$desde_cuando')";
            if ($conn->query($sql_detalle_historia_clinica) !== TRUE) {
                echo "Error al guardar los datos de la historia clínica: " . $conn->error;
                return;
            }
        }

        echo "Historia clínica guardada exitosamente.";
    } else {
        echo "Error al guardar los datos de la historia clínica: " . $conn->error;
    }
}

// Función para guardar los datos de pacientes_vacunas
function guardarPacientesVacunas($conn, $pacientesVacunas, $proximoIdPaciente)
{
    foreach ($pacientesVacunas as $vacuna) {
        $idVacuna = $vacuna['id_vacuna']; // Obtener el valor de id_vacuna desde el arreglo enviado desde JavaScript
        $dosis = $vacuna['dosis'];
        $refuerzo = $vacuna['refuerzo'];
        $fechaAplicacion = $vacuna['fecha_aplicacion'];

        // Agregar mensajes de depuración para verificar los valores
        echo "ID de vacuna: " . $idVacuna . "\n";
        echo "Fecha de aplicación: " . $fechaAplicacion . "\n";

        // No es necesario incluir id_vacuna_p en la sentencia INSERT, ya que es autoincremental en la base de datos
        $sql_pacientes_vacunas = "INSERT INTO pacientes_vacunas (id_paciente, id_vacuna, dosis, refuerzo, FECHA_APLICACION) 
                                 VALUES ($proximoIdPaciente, '$idVacuna', '$dosis', '$refuerzo', '$fechaAplicacion')";
        if ($conn->query($sql_pacientes_vacunas) === FALSE) {
            echo "Error al guardar los datos de pacientes_vacunas: " . $conn->error;
            return;
        }
    }

    echo "Datos de pacientes_vacunas guardados exitosamente.";
}

// Establecer la conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los datos enviados desde el formulario
$data = file_get_contents('php://input');
$dataArray = json_decode($data, true);

$nombre = $dataArray['nombre'];
$apellido = $dataArray['apellido'];
$sexo = $dataArray['sexo'];
$fecha_nacimiento = $dataArray['fecha_nacimiento'];
$pais = $dataArray['pais'];
$con_quien_vive = $dataArray['con_quien_vive'];
$direccion = $dataArray['direccion'];
$NSS = $dataArray['NSS'];
$Id_seguro_salud = $dataArray['Id_seguro_salud'];
$tieneDatosPadecimientos = $dataArray['tieneDatosPadecimientos'];
$historiaClinica = $dataArray['historiaClinica'];
$pacientesVacunas = $dataArray['pacientesVacunas'];

// Obtener el próximo ID de paciente
$proximoIdPaciente = obtenerProximoIdPaciente($conn);

// Insertar datos en la tabla paciente
$sql_paciente = "INSERT INTO paciente (id_paciente, nombre, apellido, sexo, fecha_nacimiento, Nacionalidad, Con_quien_vive, Direccion_reside) 
VALUES ($proximoIdPaciente, '$nombre', '$apellido', '$sexo', '$fecha_nacimiento', '$pais', '$con_quien_vive', '$direccion')";

if ($conn->query($sql_paciente) === TRUE) {
    // Insertar datos en la tabla seguro_paciente
    $sql_seguro_paciente = "INSERT INTO seguro_paciente (NSS, id_paciente, Id_seguro_salud) VALUES ('$NSS', $proximoIdPaciente, '$Id_seguro_salud')";
    if ($conn->query($sql_seguro_paciente) === TRUE) {
        // Verificar si la tabla de padecimientos tiene datos
        if ($tieneDatosPadecimientos) {
            // Guardar datos de la historia clínica y su detalle
            guardarHistoriaClinica($conn, $proximoIdPaciente, $historiaClinica);
        }

        // Verificar si la tabla de pacientes_vacunas tiene datos
        if ($pacientesVacunas) {
            guardarPacientesVacunas($conn, $pacientesVacunas, $proximoIdPaciente);
        }

        echo "Datos guardados exitosamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
} else {
    echo "Error al guardar los datos: " . $conn->error;
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>



