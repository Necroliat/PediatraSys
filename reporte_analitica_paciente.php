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

// Obtener el ID de la analítica desde la URL
$idAnalitica = $_GET['id_analitica'];

// Consulta para obtener los datos de la analítica y el detalle de la analítica
$query = "SELECT ap.*, p.nombre AS nombre_paciente, p.apellido AS apellido_paciente,
m.nombre AS nombre_medico, m.apellido AS apellido_medico, m.exequatur, m.id_especialidad,
ins.nombre AS nombre_centro, ins.direccion AS direccion_centro,
ins.telefono AS telefono_centro,
da.id_analisis, ta.Nombre AS nombre_analisis, ta.descripcion AS descripcion_analisis
FROM analitica_paciente ap
INNER JOIN paciente p ON ap.id_paciente = p.id_paciente
INNER JOIN medicos m ON ap.id_medico = m.id_medico
INNER JOIN especialidad esp ON m.id_especialidad = esp.id_especialidad
INNER JOIN institucion_de_salud ins ON ap.id_centro = ins.id_centro
INNER JOIN detalle_analitica da ON ap.id_analitica = da.id_analitica
INNER JOIN tipos_analisis ta ON da.id_analisis = ta.id_analisis
WHERE ap.id_analitica = '$idAnalitica'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Crear instancia de TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nombre Autor');
    $pdf->SetTitle('Reporte de Analítica del Paciente');
    $pdf->SetSubject('Analítica del Paciente');
    $pdf->SetKeywords('Analítica, Paciente, TCPDF');

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

    $html .= '<h1 style="text-align: center;">INDICACIÓN PARA ANÁLISIS DEL PACIENTE</h1>';
    $html .= '<div style="text-align:right;"><p>Fecha: ' . date('Y-m-d') . '</p></div>';
    $html .= '<div id="logo" style="text-align:center;"><img src="imagenes/logo/logo.png" width="50" height="50"></div><br><br>';
    $html .= '<p style="text-align: center;">' . $row['nombre_centro'] . '<br>';
    $html .= $row['direccion_centro'] . '<br>';
    $html .= 'Teléfono: ' . $row['telefono_centro'] . '</p>';

    $html .= '<p><b>Doctor:</b> ' . $row['nombre_medico'] . ' ' . $row['apellido_medico'] . '<br>';
    $html .= '<b>Especialidad:</b> ' . $row['especialidad'] . '<br>'; // Reemplazar Especialidad con el dato real
    $html .= '<b>Exequatur:</b> ' . $row['exequatur'] . '</p>';

    $html .= '<p><b>Para Paciente:</b> ' . $row['nombre_paciente'] . ' ' . $row['apellido_paciente'] . '</p>';

    $html .= '<div style="text-align: center;font-weight: bold;font-size: 16px;margin-bottom: 50px; padding:20px;">Análisis para Realizar: </div>';

    $html .= '<div style="padding:20px;border:1px solid #7fffd4;border-radius: 20px;"><table style="width: 100%;border-collapse: collapse;border-radius: 10px;margin-bottom: 20px;">';
    $html .= '<thead style="background-color:#afeeee;font-weight: bold;"><tr><th style="background-color:#afeeee;font-weight: bold;">Análisis</th><th style="background-color:#afeeee;font-weight: bold;">Descripción</th></tr></thead>';
    $html .= '<tbody>';

    // Obtener detalles de la analítica
    $queryDetalle = "SELECT ta.Nombre AS nombre_analisis, ta.descripcion AS descripcion_analisis 
                     FROM detalle_analitica da
                     INNER JOIN tipos_analisis ta ON da.id_analisis = ta.id_analisis
                     WHERE da.id_analitica = '$idAnalitica'";
    $resultDetalle = $conn->query($queryDetalle);

    if ($resultDetalle->num_rows > 0) {
        while ($rowDetalle = $resultDetalle->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . $rowDetalle['nombre_analisis'] . '</td>';
            $html .= '<td>' . $rowDetalle['descripcion_analisis'] . '</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table></div>';

    $html .= '<p>Firma Doctor: ________________________________________</p>';

    // Agregar el contenido al PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Salida del PDF (nombre archivo: analitica_paciente_IDANALITICA.pdf)
    ob_end_clean();
    $pdf->Output('analitica_paciente_' . $idAnalitica . '.pdf', 'I');
} else {
    echo "No se encontró ninguna analítica con ese ID.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
