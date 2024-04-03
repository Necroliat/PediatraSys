<?php
require_once('tcpdf/Tcpdf.php');

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID de la receta desde la URL
$idReceta = $_GET['id_receta'];

// Consulta para obtener los datos de la receta y el detalle de la prescripción médica
$query = "SELECT pm.*, p.nombre AS nombre_paciente, p.apellido AS apellido_paciente, m.nombre AS nombre_medico, m.apellido AS apellido_medico,
                 is.nombre AS nombre_centro, is.direccion AS direccion_centro, is.telefono AS telefono_centro
          FROM prescripcion_medica pm
          INNER JOIN paciente p ON pm.id_paciente = p.id_paciente
          INNER JOIN medicos m ON pm.id_medico = m.id_medico
          INNER JOIN institucion_de_salud is ON pm.id_centro = is.id_centro
          WHERE pm.id_receta = '$idReceta'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Crear instancia de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nombre Autor');
    $pdf->SetTitle('Reporte de Receta Médica');
    $pdf->SetSubject('Receta Médica');
    $pdf->SetKeywords('Receta, Médica, TCPDF');

    // Agregar una página
    $pdf->AddPage();

    // Agregar contenido al PDF
    $html = '<h1>RECETA MÉDICA</h1>';
    $html .= '<p>FECHA RECETA: ' . date('Y-m-d') . '</p>';
    $html .= '<img src="imagenes/logo/logo.png" width="150" height="150"><br>';
    $html .= '<p>' . $row['nombre_centro'] . '<br>';
    $html .= $row['direccion_centro'] . '<br>';
    $html .= 'Teléfono: ' . $row['telefono_centro'] . '</p>';

    $html .= '<p><b>Doctor:</b> ' . $row['nombre_medico'] . ' ' . $row['apellido_medico'] . '<br>';
    $html .= '<b>Especialidad:</b> Especialidad<br>'; // Reemplazar Especialidad con el dato real
    $html .= '<b>Exequatur:</b> ' . $row['exequatur'] . '</p>';

    $html .= '<p><b>Para Paciente:</b> ' . $row['nombre_paciente'] . ' ' . $row['apellido_paciente'] . '</p>';

    $html .= '<table border="1">';
    $html .= '<thead><tr><th>Medicamento</th><th>Cantidad</th><th>Unidad de Medida</th><th>Frecuencia</th><th>Tiempo de Uso</th></tr></thead>';
    $html .= '<tbody>';

    // Obtener detalles de la prescripción médica
    $queryDetalle = "SELECT * FROM detalle_prescripcion WHERE id_receta = '$idReceta'";
    $resultDetalle = $conn->query($queryDetalle);

    if ($resultDetalle->num_rows > 0) {
        while ($rowDetalle = $resultDetalle->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . $rowDetalle['id_medicamento'] . '</td>';
            $html .= '<td>' . $rowDetalle['cantidad'] . '</td>';
            $html .= '<td>' . $rowDetalle['unidad_de_medida'] . '</td>';
            $html .= '<td>' . $rowDetalle['frecuencia'] . '</td>';
            $html .= '<td>' . $rowDetalle['tiempo_de_uso'] . ' día/as</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table>';

    $html .= '<p>Firma: ________________________________________</p>';

    // Agregar el contenido al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Salida del PDF (nombre archivo: receta_medica_IDRECETA.pdf)
    $pdf->Output('receta_medica_' . $idReceta . '.pdf', 'I');
} else {
    echo "No se encontró ninguna receta con ese ID.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
