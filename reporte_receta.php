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
$query = "SELECT pm.*, p.nombre AS nombre_paciente, p.apellido AS apellido_paciente,
m.nombre AS nombre_medico, m.apellido AS apellido_medico,m.exequatur,m.id_especialidad,
ins.nombre AS nombre_centro, ins.direccion AS direccion_centro,
ins.telefono AS telefono_centro,
dp.id_medicamento, dp.cantidad, dp.unidad_de_medida,
dp.frecuencia, dp.Tiempo_de_uso,
med.nombre_medicamento, med.descripcion, med.formato,  esp.especialidad
FROM prescripcion_medica pm
INNER JOIN paciente p ON pm.id_paciente = p.id_paciente
INNER JOIN medicos m ON pm.id_medico = m.id_medico
INNER JOIN especialidad esp ON m.id_especialidad  = esp.id_especialidad
INNER JOIN institucion_de_salud ins ON pm.id_centro = ins.id_centro
INNER JOIN detalle_prescripcion dp ON pm.id_receta = dp.id_receta
INNER JOIN medicamento med ON dp.id_medicamento = med.Id_medicamento
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
    $html = '<style>
table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    margin-bottom: 20px;
}
th, td {
    padding: 8px;
    text-align: left;
}
th {
    background-color: babyblue;
}
tr:nth-child(odd) {
    background-color: #D6EAF8;
}
tr:nth-child(even) {
    background-color: #EBF5FB;
}
#logo {
    
    text-align: center;
}
#detalle-titulo {
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 10px;
}
</style>';

    $html .= '<h1 style="text-align: center;">RECETA MÉDICA</h1>';
    $html .= '<div style="text-align:right;"><p>Fecha: ' . date('Y-m-d') . '</p></div>';
    $html .= '<div id="logo" style="text-align:center;"><img src="imagenes/logo/logo.png" width="50" height="50"></div><br><br>';
    $html .= '<p style="text-align: center;">' . $row['nombre_centro'] . '<br>';
    $html .= $row['direccion_centro'] . '<br>';
    $html .= 'Teléfono: ' . $row['telefono_centro'] . '</p>';

    $html .= '<p><b>Doctor:</b> ' . $row['nombre_medico'] . ' ' . $row['apellido_medico'] . '<br>';
    $html .= '<b>Especialidad:</b> '. $row['especialidad'] .'<br>'; // Reemplazar Especialidad con el dato real
    $html .= '<b>Exequatur:</b> ' . $row['exequatur'] . '</p>';

    $html .= '<p><b>Para Paciente:</b> ' . $row['nombre_paciente'] . ' ' . $row['apellido_paciente'] . '</p>';

    $html .= '<div style="text-align: center;font-weight: bold;font-size: 16px;margin-bottom: 50px; padding:20px;">Medicamentos Recetados</div>';

    $html .= '<div style="padding:20px;border:1px solid #7fffd4;border: radius 20px; "><table style="width: 100%;border-collapse: collapse;border-radius: 10px;margin-bottom: 20px;">';
    $html .= '<thead style="background-color:#afeeee;font-weight: bold;"><tr><th style="background-color:#afeeee;font-weight: bold;">Medicamento</th><th style="background-color:#afeeee;font-weight: bold;">Cantidad</th><th style="background-color:#afeeee;font-weight: bold;">Medida</th><th style="background-color:#afeeee;font-weight: bold;">Frecuencia</th><th style="background-color:#afeeee;font-weight: bold;">Tiempo de Uso</th></tr></thead>';
    $html .= '<tbody>';

    // Obtener detalles de la prescripción médica
    $queryDetalle = "SELECT * FROM detalle_prescripcion WHERE id_receta = '$idReceta'";
    $resultDetalle = $conn->query($query);

    if ($resultDetalle->num_rows > 0) {
        while ($rowDetalle = $resultDetalle->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . $rowDetalle['nombre_medicamento'] . '</td>';
            $html .= '<td>' . $rowDetalle['cantidad'] . '</td>';
            $html .= '<td>' . $rowDetalle['unidad_de_medida'] . '</td>';
            $html .= '<td>' . $rowDetalle['frecuencia'] . '</td>';
            $html .= '<td>' . $rowDetalle['Tiempo_de_uso'] . ' día/as</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table></div>';

    $html .= '<p>Firma Doctor: ________________________________________</p>';

    // Agregar el contenido al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Salida del PDF (nombre archivo: receta_medica_IDRECETA.pdf)
    ob_end_clean();
    $pdf->Output('receta_medica_' . $idReceta . '.pdf', 'I');
} else {
    echo "No se encontró ninguna receta con ese ID.";
}

// Cerrar la conexión a la base de datos
$conn->close();
