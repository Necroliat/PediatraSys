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

// Recupera el ID del referimiento médico desde la URL
$id_referimiento = isset($_GET['ID_Referimiento']) ? $_GET['ID_Referimiento'] : die('Error: ID de referimiento no proporcionado.');

$query = "SELECT r.ID_Referimiento, r.medico_referido, r.Fecha_Referimiento, r.Motivo, r.Observaciones, r.id_centro, r.id_medico, r.id_paciente,
c.nombre AS centro_nombre, c.direccion AS centro_direccion, c.telefono AS centro_telefono,
m.nombre AS medico_nombre, m.apellido AS medico_apellido, m.cedula AS medico_cedula, m.exequatur AS medico_exequatur, m.id_especialidad AS medico_especialidad,
p.nombre AS paciente_nombre, p.apellido AS paciente_apellido, p.fecha_nacimiento AS paciente_fecha_nacimiento,
e.especialidad AS medico_especialidad_nombre
FROM referimientos r
INNER JOIN institucion_de_salud c ON r.id_centro = c.id_centro
INNER JOIN medicos m ON r.id_medico = m.id_medico
INNER JOIN paciente p ON r.id_paciente = p.id_paciente
INNER JOIN especialidad e ON m.id_especialidad = e.id_especialidad
WHERE r.ID_Referimiento = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_referimiento);
$stmt->execute();
$result = $stmt->get_result();
$referimiento = $result->fetch_assoc();

// Verificar si se obtuvieron datos
if (!$referimiento) {
    die("No se encontró información con el ID proporcionado.");
}

// Cálculo de la edad
$birthDate = new DateTime($referimiento['paciente_fecha_nacimiento']);
$today = new DateTime('today');
$age = $birthDate->diff($today)->y;

// Creación del objeto PDF
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Referimiento Médico');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Eliminar líneas predeterminadas de header y footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Añadir una página
$pdf->AddPage();

// Contenido del Referimiento Médico
$html = <<<EOD
<div id="logo" style="text-align:center;"><img src="imagenes/logo/logo.png" width="50" height="50">
<h5 style="padding:0; margin:0;text-align: center;">PediatraSys</h5>
<h4 style="text-align:center;">REFERIMIENTO MÉDICO</h4>
<p style="text-align:center;">{$referimiento['centro_nombre']}<br>
<b>Dirección:</b> {$referimiento['centro_direccion']}<br>
<b>Teléfono:</b> {$referimiento['centro_telefono']}</p>
<p style="padding:0; text-align:right; text-transform: uppercase;"><b>Fecha:</b> {$today->format('d \d\e F \d\e Y')}</p></div>
<p><b>Paciente:</b> {$referimiento['paciente_nombre']} {$referimiento['paciente_apellido']}</p>
<p><b>Edad:</b> {$age} años</p>

<p style="padding:0; text-align: left;"><b>Médico Remitente:</b> Dr. {$referimiento['medico_nombre']} {$referimiento['medico_apellido']}<br>
<b>Especialidad:</b> {$referimiento['medico_especialidad_nombre']}<br>
<b>Cédula:</b> {$referimiento['medico_cedula']}<br>
<b>Colegiado con No. de Execuátur:</b> {$referimiento['medico_exequatur']}</p>

<h4 style="padding:0; text-align: left; ">Médico Receptor: {$referimiento['medico_referido']}</h4>

<p><b>Estimado  {$referimiento['medico_referido']}:</b>
Me permito referir al paciente {$referimiento['paciente_nombre']} {$referimiento['paciente_apellido']}, quien acude a mi consultorio presentando un cuadro de:</p>
<p>{$referimiento['Motivo']}</p>
<p>{$referimiento['Observaciones']}</p>

<p>Agradezco de antemano su atención y quedo a la espera de sus comentarios.</p>

<p>Atentamente,</p>
<p>Dr. {$referimiento['medico_nombre']} {$referimiento['medico_apellido']}<br>
{$referimiento['medico_especialidad_nombre']}<br>
Colegiado con No. de Execuátur: {$referimiento['medico_exequatur']}</p>

<br>
<br>

<p style="font-weight: bold;text-align:center;">Firma:__________________________________</p>
EOD;

// Escribir el HTML
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Cerrar y mostrar el PDF
$pdf->Output('referimiento_medico.pdf', 'I');
?>
