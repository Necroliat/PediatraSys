<?php
// Carga de la librería TCPDF
require_once('tcpdf/tcpdf.php');

// Configuración inicial de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recupera el ID del certificado médico desde la URL
$id_certificado_M = isset($_GET['id_certificado_M']) ? $_GET['id_certificado_M'] : die('Error: ID de certificado no proporcionado.');



$query = "SELECT cm.diagnostico, cm.Recomendacion, m.nombre AS medico_nombre, m.apellido AS medico_apellido, m.exequatur, m.cedula, es.especialidad, p.nombre AS paciente_nombre, p.apellido AS paciente_apellido, p.sexo, p.fecha_nacimiento, p.Nacionalidad, p.Con_quien_vive, p.Direccion_reside, i.nombre AS centro_nombre, i.direccion AS centro_direccion, i.telefono AS centro_telefono
FROM certificado_medico cm
JOIN medicos m ON cm.id_medico = m.id_medico
JOIN especialidad es ON m.id_especialidad = es.id_especialidad
JOIN paciente p ON cm.id_paciente = p.id_paciente
JOIN institucion_de_salud i ON cm.id_centro = i.id_centro
WHERE cm.id_certificado_M = ?";


$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_certificado_M);
$stmt->execute();
$result = $stmt->get_result();
$certificado = $result->fetch_assoc();

// Verificar si se obtuvieron datos
if (!$certificado) {
    die("No se encontró información con el ID proporcionado.");
}

// Cálculo de la edad
$birthDate = new DateTime($certificado['fecha_nacimiento']);
$today = new DateTime('today');
$age = $birthDate->diff($today)->y;

// Creación del objeto PDF
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Certificado Médico');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Eliminar líneas predeterminadas de header y footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Añadir una página
$pdf->AddPage();

// Contenido del Certificado
$html = <<<EOD
<div id="logo" style="text-align:center;"><img src="imagenes/logo/logo.png" width="50" height="50">
<h5 style="padding:0; margin:0;text-align: center;">PediatraSys</h5>
</div>

<h2 style="text-align:center;">CERTIFICADO MÉDICO</h2>
<h3 style="text-align:center;">{$certificado['centro_nombre']}</h3>
<p style="text-align:center;">Dirección: {$certificado['centro_direccion']}</p>
<p style="text-align:center;">Teléfono: {$certificado['centro_telefono']}</p>
<p style="padding:0; text-align:right; text-transform: uppercase;"><b>Fecha:</b> {$today->format('d \d\e F \d\e Y')}</p>
<p><b>Paciente:</b> {$certificado['paciente_nombre']} {$certificado['paciente_apellido']}</p>
<p><b>Edad:</b> {$age} años</p>

<h4 style="padding:0; text-align: left; text-transform: uppercase;">Por medio del presente Yo {$certificado['medico_nombre']} {$certificado['medico_apellido']}, con la cédula: {$certificado['cedula']} , el/la suscrito/a doctor/doctora certifica lo siguiente:</h4>

<p>Que el/la paciente {$certificado['paciente_nombre']} {$certificado['paciente_apellido']} {$certificado['diagnostico']}</p>

<p>{$certificado['Recomendacion']}</p>
<p>{$certificado['medico_nombre']} {$certificado['medico_apellido']}<br>
{$certificado['especialidad']}<br>
Colegiado con el No. de Execuátur: {$certificado['exequatur']}</p>
<br>
<br>
<br>
<br>
<br>
<br>
<p style="font-weight: bold;text-align:center;">Firma:__________________________________</p>
EOD;

// Escribir el HTML
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Cerrar y mostrar el PDF
$pdf->Output('certificado_medico.pdf', 'I');
?>
