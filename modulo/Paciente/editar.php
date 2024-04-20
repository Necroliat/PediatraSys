<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_paciente'];
$medico = $_GET['nombre_medico'];
//$coddni =5;

$querybuscar = mysqli_query($conn, "SELECT * FROM paciente WHERE id_paciente =$coddni");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$idpaciente = $mostrar['id_paciente'];
	$nombre = $mostrar['nombre'];
	$apellido = $mostrar['apellido'];
	$sexo = $mostrar['sexo'];
	$fecnac = $mostrar['fecha_nacimiento'];
	$nacion = $mostrar['Nacionalidad'];
	$vivecon = $mostrar['Con_quien_vive'];
	$direccion = $mostrar['Direccion_reside'];
}
?>
<?php

// Variable de bandera para indicar si se encontró un choque de horarios
$choqueEncontrado = false;
// Función para verificar choques de horarios
function verificarChoques($idMedico, $dia, $horaInicio, $horaFin, $etiqueta, $idhorario2)
{
	global $conn, $choqueEncontrado;
	// Consulta para verificar choques de horarios para el día específico
	$query = "SELECT * FROM horario WHERE id_medico = '$idMedico' AND dias LIKE '%$dia%' AND Estado = 'Activo' AND id_horario <>'$idhorario2'";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$horaInicioDB = $row['hora_inicio'];
			$horaFinDB = $row['hora_fin'];
			// Verificar choque de horarios
			if (($horaInicio >= $horaInicioDB && $horaInicio < $horaFinDB) || ($horaFin > $horaInicioDB && $horaFin <= $horaFinDB)) {
				// Verificar si el día de la base de datos coincide con el día insertado
				if (strpos($row['dias'], $dia) !== false) {
					// Imprimir mensaje de choque de horarios
					echo "<script>alert('Hay un choque en el día $dia con el horario de $horaInicioDB a $horaFinDB');</script>";
					// Establecer la variable de bandera en true
					$choqueEncontrado = true;
					// Detener la función de verificación
					return;
				}
			}
		}
	}
}
// Validar campos antes de procesar el formulario
if (isset($_POST['btnregistrar'])) {
	// Obtener datos del formulario
	$idhorario = $_POST['txtid'];
	$idmedico = $_POST['id_medico'];
	$diasSeleccionados = $_POST['dia'];
	$etiqueta = "Regular";
	/* $etiqueta = $_POST['txtetiqueta']; */
	$horainicial = $_POST['hora_inicio'];
	$horafinal = $_POST['hora_fin'];
	$estado = $_POST['txtestado'];
	// Verificar choques de horarios para cada día seleccionado
	foreach ($diasSeleccionados as $dia) {
		verificarChoques($idmedico, $dia, $horainicial, $horafinal, $etiqueta, $idhorario2);
		// Si se encontró un choque, detener la ejecución
		if ($choqueEncontrado) {
			break;
		}
	}
	// Si no se encontraron choques, proceder con el registro en la base de datos
	if (!$choqueEncontrado) {
		// Insertar datos en la tabla horario
		$dias = implode(", ", $diasSeleccionados);
		// Actualizar datos en la tabla horario
		$queryUpdate = mysqli_query($conn, "UPDATE horario SET id_medico = '$idmedico', dias = '$dias', etiqueta = '$etiqueta', hora_inicio = '$horainicial', hora_fin = '$horafinal', Estado = '$estado' WHERE id_horario = '$idhorario2'");
		if (!$queryUpdate) {
			echo "Error al actualizar el registro: " . mysqli_error($conn);
		} else {
			echo "<script>window.location= '../../mant_horario.php?pag=1' </script>";
		}
		/* $queryAdd = mysqli_query($conn, "INSERT INTO horario (id_horario, id_medico, dias, etiqueta, hora_inicio, hora_fin, Estado) VALUES('$idhorario', '$idmedico','$dias','$etiqueta','$horainicial','$horafinal','$estado')");
		if (!$queryAdd) {
			echo "Error con el registro: " . mysqli_error($conn);
		} else {
			echo "<script>window.location= '../../mant_horario.php?pag=1' </script>";
		} */
	}
}
// Función para obtener los horarios del médico
function obtenerHorariosMedico($idMedico)
{
	global $conn;
	$horarios = array();
	// Consultar los horarios del médico con el ID correspondiente
	$query = "SELECT * FROM horario WHERE id_medico = '$idMedico' ORDER BY FIELD(dias, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado')";
	$result = $conn->query($query);

	// Iterar sobre los resultados y guardar en un array asociativo
	while ($row = $result->fetch_assoc()) {
		$dia = $row['dias'];
		$horario = $row['hora_inicio'] . ' - ' . $row['hora_fin'];

		// Verificar si ya existe un horario para este día en el array
		if (array_key_exists($dia, $horarios)) {
			// Si existe, agregar el horario a la lista existente
			$horarios[$dia][] = $horario;
		} else {
			// Si no existe, crear una nueva lista para ese día
			$horarios[$dia] = array($horario);
		}
	}
	return $horarios;
}
?>

<html>

<head>
	<title>Sis_Pediátrico</title>
	<link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8">
	<!-- <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
	<meta charset="UTF-8">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css"> -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<style>
		/* Estilos personalizados aquí */
	</style>
	<script>
		// Función para validar campos antes de enviar el formulario
		function validarFormulario() {
			var idhorario = document.getElementById("txtid").value;
			var idmedico = document.getElementById("id_medico").value;
			var dia = document.getElementById("checklist").value;
			var etiqueta = document.getElementById("txtetiqueta").value;
			var horainicio = document.getElementById("hora_inicio").value;
			var horafin = document.getElementById("hora_fin").value;
			var estado = document.getElementById("txtestado").value;

			if (idhorario.trim() === '' || idmedico.trim() === '' || dia.trim() === '' || etiqueta.trim() === '' || horainicio.trim() === '' || horafin.trim() === '' || estado.trim() === '') {
				alert("Por favor, complete todos los campos");
				return false;
			}

			return true;
		}
	</script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style>
		.botones-container {
			display: flex;
			flex-wrap: wrap;
			margin: 2px;
			padding: 2px;
			box-sizing: border-box;
			justify-content: center;
		}

		.botones-container>a,
		.botones-container>input[type="button"],
		.botones-container>input[type="submit"],
		.botones-container>button {
			margin: 5px;
			padding: 10px 20px;
			border: none;
			border-radius: 10px;
			text-align: center;
			text-decoration: none;
			cursor: pointer;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			color: #fff;
			font-weight: bold;
			transition: background-color 0.3s ease;
			flex: 1 1 auto;
			/* Esto hace que los botones se expandan igualmente */
			max-width: 150px;
			/* Establece el ancho máximo para mantener la responsividad. */
			font-size: 14px;
		}

		.botones-container>a:hover,
		.botones-container>input[type="button"]:hover,
		.botones-container>input[type="submit"]:hover,
		.botones-container>button:hover {
			background: linear-gradient(to right, #63b8ff, #4a90e2);

			box-shadow: 2px 3px 3px rgba(0, 0, 0, 0.1);
		}
	</style>



	<style>
		.caja {
			border: 3px solid #ddd;
			padding: 5px;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin: 2px;
			border-radius: 5px;





		}

		.cajalegend {
			border: 0px solid rgba(102, 153, 144, 0.0);
			font-weight: bolder;
			font-size: 16px;
			color: white;
			margin: 0;
			padding: 0;
			background-color: transparent;
			border-radius: 2px;
			margin-top: -20px;
			text-shadow: 2px 1px 2px #000000;


		}

		.container {
			display: grid;
			grid-template-columns: 80% 20%;
			/* Cambiado a una relación de 60/40 */
			grid-template-rows: repeat(3, 1fr);
			grid-gap: 3px 5px;
		}

		label {
			font-size: 14px;
			color: #444;
			margin: 0;
			font-weight: bold;
		}

		input[type="text"]:read-only {
			background-color: rgb(115, 140, 136);
			color: #000;
			font-weight: bold;
			width: 65px;
		}

		button,
		input,
		optgroup,
		select,
		textarea {
			margin: 0;

			font-size: 12px;
			line-height: 14px;
			margin: 10px;
			padding-top: 5px;
			padding-bottom: 5px;
		}

		input[type="text"],
		input[type="date"],
		select {

			width: 150px;
			height: 40px;
			color: #444;
			margin-bottom: 0;
			border: none;
			border-bottom: 0.1vw solid #444;
			outline: none;
			border-radius: 10px;

		}

		button {
			border: none;
			outline: none;
			color: #fff;
			font-size: 14px;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			padding: 10px;
			border-radius: 10px;

			margin: 10px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;
			min-height: 40px;
		}


		.boton_bus {
			border: none;
			outline: none;
			height: 4vw;
			color: #fff;
			font-size: 1.6vw;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			border-radius: 60px;
			width: 60px;
			margin-top: 2vw;
			text-decoration: none;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;


		}

		.boton_bus:active {
			background-color: #5bc0f7;
			scale: 1.5;
			cursor: pointer;

			transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.8s ease, font-weight 0.8s ease;
			/* Animaciones de 0.5 segundos */
			box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red;
			/* Sombra inicial y sombra roja */
			font-size: 25px;
			color: white;
			/* Cambiar el color del texto */
			font-weight: bold;
			/* Cambiar a negritas */
			font-family: "Copperplate", Fantasy;
		}

		/* Estilos específicos para el modal personalizado */
		.custom-modal {
			display: none;
			position: fixed;
			z-index: 9999;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.7);
		}

		.custom-modal-content {
			width: 80%;
			height: 80%;
			margin: auto;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			padding: 20px;
			border-radius: 20PX;
		}

		.custom-close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
		}

		.custom-close:hover,
		.custom-close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}

		/* Estilos adicionales específicos para el iframe dentro del modal */
		.custom-iframe {
			width: 100%;
			height: 100%;
			border: none;
		}

		body {
			background: linear-gradient(to right, #E8A9F7, #e4e5dc);
		}

		fieldset {
			background: linear-gradient(to right, #e4e5dc, #62c4f9);
			border: 1px solid #ddd;
			border-radius: 2vw;

			padding: 10px;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin-bottom: 4px;
		}

		legend {
			font-weight: bold;
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 15px;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			border: solid 1px #45bac9db;
			border-radius: 10px;

		}

		/* Estilos específicos para el modal personalizado */
		.custom-modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4);
		}

		.custom-modal-content {
			opacity: 95%;
			background-color: #fefefe;
			margin: 5% auto 0;
			/* Margen superior ajustado */
			padding: 20px;
			border: 1px solid #888;
			border-radius: 20px;
			width: 80%;
			max-width: 1100px;
			background: linear-gradient(to right, #e4e5dc, #62c4f9);
			/* Ancho máximo para el contenido */
		}

		/* Centrar horizontalmente en pantallas pequeñas */
		@media screen and (max-width: 600px) {
			.custom-modal-content {
				width: 90%;
			}
		}




		.close {
			color: #aaa;
			float: right;
			font-size: 20px;
			/* Ajustar el tamaño de la fuente */
			font-weight: bold;
			color: #d06c6c;
			padding: 6px 8px;
			/* Ajustar el padding */
			border-radius: 50%;
		}

		.close:hover,
		.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
			color: #cf2626;
		}

		#id_paciente,
		#id_medico,
		#id_trabajo_medico {
			width: 55px;
			/* Ancho automático */

			/* Espaciado interior */
		}

		input,
		label {
			font-size: 14;
		}
	</style>
	<script>
		// Función para ejecutar código JavaScript
		function ejecutarCodigoJavaScript() {
			$("#id_medico").on("input", function() {
				var idmedico = $(this).val();
				// Realizar la solicitud AJAX para obtener los datos del paciente
				$.ajax({
					url: '../../consulta_apellido_nombre_medico.php', // Ruta al archivo PHP que creamos
					type: 'POST',
					data: {
						id_medico: idmedico
					},
					dataType: 'json',
					success: function(data) {
						$("#nombre_medico").text(data.nombre || '');
						$("#apellido_medico").text(data.apellido || '');
					},
					error: function() {
						alert('Hubo un error al obtener los datos del medico.');
					}
				});
			});
		}

		// Ejecutar la función al cargar la página
		window.onload = ejecutarCodigoJavaScript;
	</script>

	<?php
	//include("../../menu_lateral_header.php");
	?>
</head>
<?php
//include("../../menu_lateral.php");
?>

<body onload="cargarHorariosMedico()">

	<div class="container">
		<fieldset style=" height:650px;">
			<form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
				<legend>MODIFICANDO DATOS DEL PACIENTE 📝</legend>

				<DIV><label for="id_paciente">ID de Paciente:</label>
					<input type="text" id="id_paciente" style="width:115px; background-color:#979998 " name="id_paciente" value="<?php echo $proximoIdPaciente; ?>" readonly>
				</DIV>

				<div>

					<label for="nombre">Nombre:</label>
					<input type="text" id="nombre" name="nombre" title="Ingrese su nombre" placeholder="Nombre del infante" required>
				</div>
				<div>
					<label for="apellido">Apellido:</label>
					<input type="text" id="apellido" name="apellido" title="Ingrese su apellido" placeholder="Apellido/s del/la niño/a" required>
				</div>
				<fieldset style="width:90%;">
					<legend>Sexo:</legend>
					<div style="width:35%;float:left; margin-left: 10%; padding: 1%;">
						<label for="masculino">Masculino</label>
						<input type="radio" id="masculino" name="sexo" value="masculino" required>
					</div>
					<div style="width:35%;float:left;padding: 1%;">
						<label for="femenino">Femenino</label>
						<input type="radio" id="femenino" name="sexo" value="femenino" required>
					</div>
				</fieldset>
				<div>
					<label for="fecha_nacimiento">Fecha de nacimiento:</label>
					<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" title="Seleccione su fecha de nacimiento" required>
				</div>
				<!-- Select para países -->
				<div>
					<label for="pais">País:</label>
					<select id="pais" name="pais" title="Seleccione su país de origen" required>
						<option value="Afganistán">Afganistán</option>
						<option value="Albania">Albania</option>
						<option value="Alemania">Alemania</option>
						<option value="Andorra">Andorra</option>
						<option value="Angola">Angola</option>
						<option value="Anguilla">Anguilla</option>
						<option value="Antártida">Antártida</option>
						<option value="Antigua y Barbuda">Antigua y Barbuda</option>
						<option value="Antillas Holandesas">Antillas Holandesas</option>
						<option value="Arabia Saudí">Arabia Saudí</option>
						<option value="Argelia">Argelia</option>
						<option value="Argentina">Argentina</option>
						<option value="Armenia">Armenia</option>
						<option value="Aruba">Aruba</option>
						<option value="Australia">Australia</option>
						<option value="Austria">Austria</option>
						<option value="Azerbaiyán">Azerbaiyán</option>
						<option value="Bahamas">Bahamas</option>
						<option value="Bahrein">Bahrein</option>
						<option value="Bangladesh">Bangladesh</option>
						<option value="Barbados">Barbados</option>
						<option value="Bélgica">Bélgica</option>
						<option value="Belice">Belice</option>
						<option value="Benin">Benin</option>
						<option value="Bermudas">Bermudas</option>
						<option value="Bielorrusia">Bielorrusia</option>
						<option value="Birmania">Birmania</option>
						<option value="Bolivia">Bolivia</option>
						<option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
						<option value="Botswana">Botswana</option>
						<option value="Brasil">Brasil</option>
						<option value="Brunei">Brunei</option>
						<option value="Bulgaria">Bulgaria</option>
						<option value="Burkina Faso">Burkina Faso</option>
						<option value="Burundi">Burundi</option>
						<option value="Bután">Bután</option>
						<option value="Cabo Verde">Cabo Verde</option>
						<option value="Camboya">Camboya</option>
						<option value="Camerún">Camerún</option>
						<option value="Canadá">Canadá</option>
						<option value="Chad">Chad</option>
						<option value="Chile">Chile</option>
						<option value="China">China</option>
						<option value="Chipre">Chipre</option>
						<option value="Ciudad del Vaticano (Santa Sede)">Ciudad del Vaticano (Santa Sede)</option>
						<option value="Colombia">Colombia</option>
						<option value="Comores">Comores</option>
						<option value="Congo">Congo</option>
						<option value="Congo, República Democrática del">Congo, República Democrática del</option>
						<option value="Corea">Corea</option>
						<option value="Corea del Norte">Corea del Norte</option>
						<option value="Costa de Marfíl">Costa de Marfíl</option>
						<option value="Costa Rica">Costa Rica</option>
						<option value="Croacia">Croacia (Hrvatska)</option>
						<option value="Cuba">Cuba</option>
						<option value="Dinamarca">Dinamarca</option>
						<option value="Djibouti">Djibouti</option>
						<option value="Dominica">Dominica</option>
						<option value="Ecuador">Ecuador</option>
						<option value="Egipto">Egipto</option>
						<option value="El Salvador">El Salvador</option>
						<option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
						<option value="Eritrea">Eritrea</option>
						<option value="Eslovenia">Eslovenia</option>
						<option value="España">España</option>
						<option value="Estados Unidos">Estados Unidos</option>
						<option value="Estonia">Estonia</option>
						<option value="Etiopía">Etiopía</option>
						<option value="Fiji">Fiji</option>
						<option value="Filipinas">Filipinas</option>
						<option value="Finlandia">Finlandia</option>
						<option value="Francia">Francia</option>
						<option value="Gabón">Gabón</option>
						<option value="Gambia">Gambia</option>
						<option value="Georgia">Georgia</option>
						<option value="Ghana">Ghana</option>
						<option value="Gibraltar">Gibraltar</option>
						<option value="Granada">Granada</option>
						<option value="Grecia">Grecia</option>
						<option value="Groenlandia">Groenlandia</option>
						<option value="Guadalupe">Guadalupe</option>
						<option value="Guam">Guam</option>
						<option value="Guatemala">Guatemala</option>
						<option value="Guayana">Guayana</option>
						<option value="Guayana Francesa">Guayana Francesa</option>
						<option value="Guinea">Guinea</option>
						<option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
						<option value="Guinea-Bissau">Guinea-Bissau</option>
						<option value="Haití">Haití</option>
						<option value="Honduras">Honduras</option>
						<option value="Hungría">Hungría</option>
						<option value="India">India</option>
						<option value="Indonesia">Indonesia</option>
						<option value="Irak">Irak</option>
						<option value="Irán">Irán</option>
						<option value="Irlanda">Irlanda</option>
						<option value="Isla Bouvet">Isla Bouvet</option>
						<option value="Isla de Christmas">Isla de Christmas</option>
						<option value="Islandia">Islandia</option>
						<option value="Islas Caimán">Islas Caimán</option>
						<option value="Islas Cook">Islas Cook</option>
						<option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
						<option value="Islas Faroe">Islas Faroe</option>
						<option value="Islas Heard y McDonald">Islas Heard y McDonald</option>
						<option value="Islas Malvinas">Islas Malvinas</option>
						<option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
						<option value="Islas Marshall">Islas Marshall</option>
						<option value="Islas menores de Estados Unidos">Islas menores de Estados Unidos</option>
						<option value="Islas Palau">Islas Palau</option>
						<option value="Islas Salomón">Islas Salomón</option>
						<option value="Islas Svalbard y Jan Mayen">Islas Svalbard y Jan Mayen</option>
						<option value="Islas Tokelau">Islas Tokelau</option>
						<option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
						<option value="Islas Vírgenes (EEUU)">Islas Vírgenes (EEUU)</option>
						<option value="Islas Vírgenes (Reino Unido)">Islas Vírgenes (Reino Unido)</option>
						<option value="Islas Wallis y Futuna">Islas Wallis y Futuna</option>
						<option value="Israel">Israel</option>
						<option value="Italia">Italia</option>
						<option value="Jamaica">Jamaica</option>
						<option value="Japón">Japón</option>
						<option value="Jordania">Jordania</option>
						<option value="Kazajistán">Kazajistán</option>
						<option value="Kenia">Kenia</option>
						<option value="Kirguizistán">Kirguizistán</option>
						<option value="Kiribati">Kiribati</option>
						<option value="Kuwait">Kuwait</option>
						<option value="Laos">Laos</option>
						<option value="Lesotho">Lesotho</option>
						<option value="Letonia">Letonia</option>
						<option value="Líbano">Líbano</option>
						<option value="Liberia">Liberia</option>
						<option value="Libia">Libia</option>
						<option value="Liechtenstein">Liechtenstein</option>
						<option value="Lituania">Lituania</option>
						<option value="Luxemburgo">Luxemburgo</option>
						<option value="Macedonia, Ex-República Yugoslava de">Macedonia, Ex-República Yugoslava de
						</option>
						<option value="Madagascar">Madagascar</option>
						<option value="Malasia">Malasia</option>
						<option value="Malawi">Malawi</option>
						<option value="Maldivas">Maldivas</option>
						<option value="Malí">Malí</option>
						<option value="Malta">Malta</option>
						<option value="Marruecos">Marruecos</option>
						<option value="Martinica">Martinica</option>
						<option value="Mauricio">Mauricio</option>
						<option value="Mauritania">Mauritania</option>
						<option value="Mayotte">Mayotte</option>
						<option value="México">México</option>
						<option value="Micronesia">Micronesia</option>
						<option value="Moldavia">Moldavia</option>
						<option value="Mónaco">Mónaco</option>
						<option value="Mongolia">Mongolia</option>
						<option value="Montserrat">Montserrat</option>
						<option value="Mozambique">Mozambique</option>
						<option value="Namibia">Namibia</option>
						<option value="Nauru">Nauru</option>
						<option value="Nepal">Nepal</option>
						<option value="Nicaragua">Nicaragua</option>
						<option value="Níger">Níger</option>
						<option value="Nigeria">Nigeria</option>
						<option value="Niue">Niue</option>
						<option value="Norfolk">Norfolk</option>
						<option value="Noruega">Noruega</option>
						<option value="Nueva Caledonia">Nueva Caledonia</option>
						<option value="Nueva Zelanda">Nueva Zelanda</option>
						<option value="Omán">Omán</option>
						<option value="Países Bajos">Países Bajos</option>
						<option value="Panamá">Panamá</option>
						<option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
						<option value="Paquistán">Paquistán</option>
						<option value="Paraguay">Paraguay</option>
						<option value="Perú">Perú</option>
						<option value="Pitcairn">Pitcairn</option>
						<option value="Polinesia Francesa">Polinesia Francesa</option>
						<option value="Polonia">Polonia</option>
						<option value="Portugal">Portugal</option>
						<option value="Puerto Rico">Puerto Rico</option>
						<option value="Qatar">Qatar</option>
						<option value="Reino Unido">Reino Unido</option>
						<option value="República Centroafricana">República Centroafricana</option>
						<option value="República Checa">República Checa</option>
						<option value="República de Sudáfrica">República de Sudáfrica</option>
						<option value="República Dominicana" selected>República Dominicana</option>
						<option value="República Eslovaca">República Eslovaca</option>
						<option value="Reunión">Reunión</option>
						<option value="Ruanda">Ruanda</option>
						<option value="Rumania">Rumania</option>
						<option value="Rusia">Rusia</option>
						<option value="Sahara Occidental">Sahara Occidental</option>
						<option value="Saint Kitts y Nevis">Saint Kitts y Nevis</option>
						<option value="Samoa">Samoa</option>
						<option value="Samoa Americana">Samoa Americana</option>
						<option value="San Marino">San Marino</option>
						<option value="San Vicente y Granadinas">San Vicente y Granadinas</option>
						<option value="Santa Helena">Santa Helena</option>
						<option value="Santa Lucía">Santa Lucía</option>
						<option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
						<option value="Senegal">Senegal</option>
						<option value="Seychelles">Seychelles</option>
						<option value="Sierra Leona">Sierra Leona</option>
						<option value="Singapur">Singapur</option>
						<option value="Siria">Siria</option>
						<option value="Somalia">Somalia</option>
						<option value="Sri Lanka">Sri Lanka</option>
						<option value="San Pedro y Miquelón">San Pedro y Miquelón</option>
						<option value="Suazilandia">Suazilandia</option>
						<option value="Sudán">Sudán</option>
						<option value="Suecia">Suecia</option>
						<option value="Suiza">Suiza</option>
						<option value="Surinam">Surinam</option>
						<option value="Tailandia">Tailandia</option>
						<option value="Taiwán">Taiwán</option>
						<option value="Tanzania">Tanzania</option>
						<option value="Tayikistán">Tayikistán</option>
						<option value="Territorios franceses del Sur">Territorios franceses del Sur</option>
						<option value="Timor Oriental">Timor Oriental</option>
						<option value="Togo">Togo</option>
						<option value="Tonga">Tonga</option>
						<option value="Trinidad y Tobago">Trinidad y Tobago</option>
						<option value="Túnez">Túnez</option>
						<option value="Turkmenistán">Turkmenistán</option>
						<option value="Turquía">Turquía</option>
						<option value="Tuvalu">Tuvalu</option>
						<option value="Ucrania">Ucrania</option>
						<option value="Uganda">Uganda</option>
						<option value="Uruguay">Uruguay</option>
						<option value="Uzbekistán">Uzbekistán</option>
						<option value="Vanuatu">Vanuatu</option>
						<option value="Venezuela">Venezuela</option>
						<option value="Vietnam">Vietnam</option>
						<option value="Yemen">Yemen</option>
						<option value="Yugoslavia">Yugoslavia</option>
						<option value="Zambia">Zambia</option>
						<option value="Zimbabue">Zimbabue</option>
					</select>
					<script>
						window.addEventListener('load', function() {
							// Variable de PHP que contiene el valor de nacionalidad
							var nacionalidadPhp = "<?php echo $nacion; ?>";

							// Obtener el elemento del select
							var selectNacionalidad = document.getElementById("pais");

							// Recorrer las opciones del select
							for (var i = 0; i < selectNacionalidad.options.length; i++) {
								// Obtener el valor de la opción actual
								var opcionValor = selectNacionalidad.options[i].value;

								// Verificar si el valor coincide con la nacionalidad de PHP
								if (opcionValor === nacionalidadPhp) {
									// Establecer la opción como seleccionada
									selectNacionalidad.options[i].selected = true;
									// Romper el bucle, ya que hemos encontrado la coincidencia
									break;
								}
							}
						});
					</script>
				</div>
				<!-- Select para con quién vive -->
				<div>
					<label for="con_quien_vive">Con quién vive:</label>
					<select id="con_quien_vive" name="con_quien_vive" title="Seleccione con quién vive actualmente" required>
						<option value="padre_madre" selected>Ambos Padres</option>
						<option value="padre">Padre</option>
						<option value="madre">Madre</option>
						<option value="tutor_legal">Tutor Legal</option>
						<!-- Agregar más opciones si es necesario -->
					</select>
				</div>
				<div>
					<label for="direccion">Dirección:</label>
					<input type="text" id="direccion" name="direccion" title="Ingrese su dirección actual" placeholder="Dirección que reside el infante" required>
				</div>
				<script>
					// Definimos una variable global en JavaScript para el ID de paciente
					var globalIdPaciente = <?php echo $proximoIdPaciente; ?>;
				</script>

				<div class="botones-container">
					<button type="submit" name="btnregistrar" value="Registrar">
						<i class="fa-solid fa-file-pen"></i>
						MODIFICAR
					</button>
					<a class="boton" href="../../mant_horario.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-circle-xmark"></i> Cancelar
					</a>
				</div>
				<!-- <iframe id="modal-iframe" src="../../consulta_horario.php" frameborder="0" style="width: 100%; height: 100%;max-height:700px;"></iframe> -->
			</form>
		</fieldset>



		<script>
			// Función para cargar la tabla de horarios del médico
			function cargarHorariosMedico() {
				var idMedico = document.getElementById('id_medico').value;
				var tablaHorarios = document.getElementById('tabla_horarios');

				// Realizar una petición AJAX para obtener los horarios del médico
				$.ajax({
					type: 'POST',
					url: '../../obtener_horarios_medico.php',
					data: {
						id_medico: idMedico
					},
					success: function(data) {
						// Actualizar la tabla de horarios con los datos recibidos
						tablaHorarios.innerHTML = data;
					},
					error: function() {
						alert('Error al cargar los horarios del médico.');
					}
				});
			}

			// Escuchar cambios en el input del ID del médico
			document.getElementById('id_medico').addEventListener('input', cargarHorariosMedico);
		</script>


	</div>
</body>

<script>
	var idmedicoActual = "";
	// Obtener referencia al botón y al modal del paciente
	const btnbusquedamedico = document.getElementById("buscarmedico");
	const modalmedico = document.getElementById("Modalmedico");
	// Función para mostrar el modal de vacuna
	function mostrarModalm() {
		modalmedico.style.display = "block";
	}
	// Función para ocultar el modal vacuna
	function ocultarModalm() {
		modalmedico.style.display = "none";
	}
	// Asignar evento de clic al botón para mostrar u ocultar el modal DE VACUNA y evitar recargar la página
	btnbusquedamedico.addEventListener("click", function(event) {
		event.preventDefault(); // Evitar recargar la página
		if (modalmedico.style.display === "none") {
			mostrarModalm();
		} else {
			ocultarModalm();
		}
	});
</script>

</html>