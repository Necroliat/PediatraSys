<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_cita'];
$nombremedico2 = $_GET['nombre_medico'];
$nombrepaciente2= $_GET['nombre_paciente'];

$querybuscar = mysqli_query($conn, "SELECT * FROM citas WHERE id_cita =$coddni");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
    $idcita = $mostrar['id_cita'];
    $fecha = $mostrar['fecha'];
    $hora = $mostrar['hora'];
    $idpaciente = $mostrar['id_paciente'];
    $idmedico = $mostrar['id_medico'];
    $observaciones = $mostrar['observaciones'];
    $estado = $mostrar['Estado'];
}



?>





<?php


// Función de validación de campos
function validarCampos($campos)
{
	foreach ($campos as $campo) {
		if (empty($_POST[$campo])) {
			return false;
		}
	}
	return true;
}

// Función para verificar si el médico está disponible en el día y hora seleccionados
function medicoDisponible($idMedico, $fecha, $hora)
{
	global $conn;

	// Obtener el día de la semana para la fecha seleccionada en español
	$diasSemana = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
	$numeroDiaSemana = date('w', strtotime($fecha));
	$diaSemana = $diasSemana[$numeroDiaSemana];

	// Consultar si el médico tiene un horario de trabajo registrado
	$queryHorario = "SELECT * FROM horario WHERE id_medico = '$idMedico' AND Estado = 'Activo'";
	$resultHorario = $conn->query($queryHorario);

	if ($resultHorario->num_rows > 0) {
		// El médico tiene un horario de trabajo registrado
		while ($rowHorario = $resultHorario->fetch_assoc()) {
			// Obtener los días de trabajo del médico
			$diasTrabajo = explode(', ', $rowHorario['dias']);

			// Verificar si el médico trabaja en el día seleccionado
			if (in_array($diaSemana, $diasTrabajo)) {
				// El médico trabaja en el día seleccionado, verificar el horario
				$horaInicio = $rowHorario['hora_inicio'];
				$horaFin = $rowHorario['hora_fin'];

				// Verificar si la hora seleccionada está dentro del horario del médico
				if ($hora >= $horaInicio && $hora <= $horaFin) {
					// El médico está disponible en el día y hora seleccionados
					return true;
				} else {
					// La hora seleccionada está fuera del horario del médico
					return "El médico no está disponible en el horario seleccionado.";
				}
			}
		}

		// El médico no trabaja en el día seleccionado
		return "El médico no trabaja en el día $diaSemana.";
	} else {
		// El médico no tiene un horario de trabajo registrado
		return "El médico no tiene un horario de trabajo registrado.";
	}
}

// Validar campos antes de procesar el formulario
if (isset($_POST['btnregistrar'])) {
	$camposRequeridos = ['txtid', 'id_medico', 'id_paciente', 'txtfecha', 'txthora'];
	if (validarCampos($camposRequeridos)) {
		$idcita = $_POST['txtid'];
		$medico = $_POST['id_medico'];
		$paciente = $_POST['id_paciente'];
		$fecha = $_POST['txtfecha'];
		$hora = $_POST['txthora'];
		$observacion = $_POST['txtdescripcion'];
		$estado = 'Vigente';

		// Verificar si el médico está disponible en el día y hora seleccionados
		$disponibilidadMedico = medicoDisponible($medico, $fecha, $hora);

		if ($disponibilidadMedico === true) {
			// El médico está disponible, proceder con el registro de la cita
			$queryAdd = mysqli_query($conn, "UPDATE citas SET fecha='$fecha', hora='$hora', id_paciente='$paciente', id_medico='$medico', observaciones='$observacion', Estado='$estado' WHERE id_cita='$idcita'");
			if (!$queryAdd) {
				echo "Error con el registro: " . mysqli_error($conn);
			} else {
				echo "<script> alert('Se ha actualizado la cita correctamente!!') </script>";
				echo "<script>window.location= '../../mant_citasmedicas.php?pag=1' </script>";
			}
		} else {
			// El médico no está disponible en el día y hora seleccionados
			echo "<script>alert('$disponibilidadMedico');</script>";
		}
	} else {
		echo "<script>alert('Por favor, complete todos los campos');</script>";
	}
}

?>

<html>

<head>
	<title>Sis_Pediátrico</title>
	<link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
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
			var idcita = document.getElementById("txtid").value;
			var fecha = document.getElementById("txtfecha").value;
			var hora = document.getElementById("txthora").value;
			var id_paciente = document.getElementById("id_paciente").value;
			var id_medico = document.getElementById("id_medico").value;
			var observaciones = document.getElementById("txtdescripcion").value;
			var estado = document.getElementById("estado").value;

			if (idcita.trim() === '' || fecha.trim() === '' || hora.trim() === '' || id_paciente.trim() === '' || id_medico.trim() === '' || observaciones.trim() === '' || estado.trim() === '') {
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
			font-size: 12px;
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
			padding: 2px;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin: 2px;
			border-radius: 5px;
			display: flex;
			font-size: 12px;
			flex-wrap: wrap;
			/*justify-content: space-between;*/
			width: 100%;
			vertical-align: baseline;
			align-items: baseline;
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
			grid-template-columns: 90%;
			grid-template-rows: repeat(2, 1fr);
			grid-gap: 6px 10px;
			margin-left: 8%;
			margin-right: 10%;
		}

		/* .container {
			display: grid;
			grid-template-columns: 100%;
			grid-template-rows: auto auto auto;
			/* Cambié repeat(3, 1fr) por auto para ajustar la altura automáticamente */
		/*	grid-gap: 6px 10px;
			margin-left: 10%;
			margin-right: 20%;
			padding: 0;

		} */


		label {
			font-size: 12px;
			color: #444;
			margin: 0;
			font-weight: bold;
		}

		input[type="text"]:read-only {
			background-color: rgb(115, 140, 136);
			color: #000;
			font-weight: bold;
			width: 55px;
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
			font-size: 12px;
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
			font-size: 12px;
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

		.resaltado {
			background-color: #A8A4DE;
		}

		#tabla_detalle_consulta {
			width: 100%;
			border-collapse: collapse;
		}

		#tabla_detalle_consulta th,
		#tabla_detalle_consulta td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}

		#tabla_detalle_consulta th {
			background-color: #f2f2f2;
		}

		#tabla_detalle_consulta tbody tr:hover {
			background-color: #f2f2f2;
		}

		#tabla_detalle_consulta .resaltado {
			background-color: #ffc107 !important;
			/* Cambiar el color de fondo resaltado */
		}

		#tabla_detalle button {
			padding: 6px 10px;
			border: none;
			background-color: #dc3545;
			color: white;
			cursor: pointer;
			border-radius: 4px;
			transition: background-color 0.3s;
		}

		#tabla_detalle button:hover {
			background-color: #c82333;
		}

		/* Resaltar la fila al hacer clic en ella */
		#tabla_detalle tbody tr.resaltado {
			background-color: #A8A4DE;
			/* Cambia el color de fondo como prefieras */
		}

		/* Resaltar la fila al pasar el mouse sobre ella */
		#tabla_detalle tbody tr.resaltado-hover {
			background-color: #E0E0E0;
			/* Cambia el color de fondo como prefieras */
		}

		#tabla_detalle tbody tr.nueva-fila {
			background-color: yellow;
			/* Estilo de resaltado */
		}

		#id_receta,
		#id_consulta,
		#id_centro,
		#id_medicamento,
		#cantidad,
		#tiempo_uso,
		#id_paciente {
			width: 55px;
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

			padding: 1vw;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin-bottom: 2vw;
		}

		legend {
			font-weight: bold;
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 1vw;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			border: solid 1px #45bac9db;
			border-radius: 10px;
		}

		* {
			font-size: medium;
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
	//include("menu_lateral_header.php");
	?>
</head>
<?php
//include("menu_lateral.php");
?>


<body onload="">
	<div class="container" style="padding:0%;  ">

		<fieldset style=" height:600px;">
			<form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
				<legend></legend>
				<fieldset class="caja">
					<legend class="cajalegend" style="padding:0; text-align: center; text-transform: uppercase;">════════════ Modificar Cita 📅📆 ════════════</legend>
					<fieldset class="caja" width="100%">
						<div>
							<label for="txtid">ID cita</label>
							<input type="text" name="txtid" id="txtid" value="<?php echo $idcita; ?>" required readonly>
						</div>
					</fieldset>

					<fieldset class="caja" width="100%">
						<label for="id_medico">Id Médico:</label>
						<input type="text" id="id_medico" name="id_medico" value="<?php echo  $idmedico ; ?>" readonly>
						<!--<button class="btn btn-primary " type="button" id="buscar_medico" onclick="mostrarModalmedico()"><i class="fa-solid fa-magnifying-glass"></i></button>-->
						<div id="Modalmedico" class="custom-modal">
							<div class="custom-modal-content">
								<span class="close" onclick="cerrarModalmedico()"><span class="material-symbols-outlined">
										cancel
									</span></span>
								<iframe id="modal-iframe" src="consulta_medico.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
							</div>
						</div>
						
						<script>
							$("#id_medico").on("input", function() {
								var idmedico = $(this).val();
								// Realizar la solicitud AJAX para obtener los datos del paciente
								$.ajax({
									url: 'consulta_apellido_nombre_medico.php', // Ruta al archivo PHP que creamos
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
						</script>
						<div>
							<label for="Nombre_medico">Médico:</label>
							<label id="nombre_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $nombremedico2; ?></label>
						</div>

						<!--<div>
							<label for="Apellido_medico" style="margin-left:5px;"> Apellido:</label>
							<label id="apellido_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
						</div>-->
					</fieldset>

					<fieldset class="caja" width="100%">
						<div>
							<label for="id_paciente">Id Paciente:</label>
							<input type="text" id="id_paciente" value="<?php echo  $idpaciente; ?>"name="id_paciente" readonly>
							<!--  -->
							<!--<button class="btn btn-primary " type="button" id="buscar_paciente" onclick="mostrarModalpaciente()"><i class="fa-solid fa-magnifying-glass"></i></button>-->
							<div id="Modalpaciente" class="custom-modal">
								<div class="custom-modal-content">
									<span class="close" onclick="cerrarModalpaciente()"><span class="material-symbols-outlined">
											cancel
										</span></span>
									<iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 70%;"></iframe>
								</div>
							</div>

							<script>
								// Función para mostrar el modal
								function mostrarModalpaciente() {
									var modal = document.getElementById('Modalpaciente');
									modal.style.display = 'block';
								}

								// Función para cerrar el modal
								function cerrarModalpaciente() {
									var modal = document.getElementById('Modalpaciente');
									modal.style.display = 'none';
								}

								// Función para mostrar el modal
								function mostrarModalmedico() {
									var modal = document.getElementById('Modalmedico');
									modal.style.display = 'block';
								}

								// Función para cerrar el modal
								function cerrarModalmedico() {
									var modal = document.getElementById('Modalmedico');
									modal.style.display = 'none';
								}
							</script>
						</div>
						<!-- <div id="Modalpaciente" class="custom-modal">
						<div class="custom-modal-content">
							<span class="close">&times;</span>
							<iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
						</div>
					</div> -->
						<script>
							$("#id_paciente").on("input", function() {
								var idPaciente = $(this).val();
								// Realizar la solicitud AJAX para obtener los datos del paciente
								$.ajax({
									url: 'consulta_apellido_nombre_paciente.php', // Ruta al archivo PHP que creamos
									type: 'POST',
									data: {
										id_paciente: idPaciente
									},
									dataType: 'json',
									success: function(data) {
										$("#nombre_paciente").text(data.nombre || '');
										$("#apellido_paciente").text(data.apellido || '');
									},
									error: function() {
										alert('Hubo un error al obtener los datos del paciente.');
									}
								});
							});
						</script>
						<div>
							<label for="Nombre_paciente">Paciente:</label>
							<label id="nombre_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $nombrepaciente2; ?></label>
						</div>
						<!--<div>
							<label for="Apellido_paciente" style="margin-left:5px;">Apellido del paciente:</label>
							<label id="apellido_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
						</div>-->
					</fieldset>

					<fieldset class="caja" width="100%" style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<p>
							<label for="txtfecha">Para la fecha:</label>
							<input type="date" autofocus name="txtfecha" id="txtfecha" value="<?php echo $fechacreacion; ?>" required>

						</p>

						<p>
							<label for="txthora">Hora</label>
							<input type="time" autofocus name="txthora" id="txthora" value="<?php echo $fechacreacion; ?>" required>

						</p>




						<script>
							// Función para verificar que la fecha no sea en el pasado y configurar la hora predeterminada
							function configurarFechaHora() {
								/* var fechaActual = new Date().toISOString().split('T')[0]; */
								var fechaActual = new Date().toISOString().split('T')[0];
								var inputFecha = document.getElementById('txtfecha');
								inputFecha.min = fechaActual;
								var inputHora = document.getElementById('txthora');
								var horaActual = '08:00';
								inputHora.value = horaActual;
							}

							window.onload = function() {
								configurarFechaHora();
							};
						</script>

						<p>
							<!-- <label for="txtestado">Estado</label>
							<select name="estado" id="estado" value="<?php echo $estado; ?>" required>
								<option value="Vigente">Vigente</option>
								<option value="Cancelada">Cancelada</option>

							</select><?php echo $descripcion; ?> -->

						</p>

						<p>
							<label for="txtdescripcion">Descripción/Notas: </label>
							<textarea name="txtdescripcion" id="txtdescripcion" style=" align-items:baseline;"><?php echo $descripcion; ?></textarea>

						</p>
					</fieldset>
					<div style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<p style="text-align: center; text-transform: uppercase; "><b>HORARIO DE TRABAJO DEL MEDICO 📅👨‍⚕️⏲👩‍⚕️:</b></p>
					</div>
					<fieldset class="caja" width="100%">
						<div id="tabla_horarios">
                <?php
require_once "../../include/conec.php";

// Consultar los datos de la cita
$querybuscar = mysqli_query($conn, "SELECT * FROM citas WHERE id_cita =$coddni");

// Inicializar variables para almacenar los datos de la cita
$idcita = $fecha = $hora = $idpaciente = $idmedico2 = $observaciones = $estado = "";

while ($mostrar = mysqli_fetch_array($querybuscar)) {
    $idcita = $mostrar['id_cita'];
    $fecha = $mostrar['fecha'];
    $hora = $mostrar['hora'];
    $idpaciente = $mostrar['id_paciente'];
    $idmedico2 = $mostrar['id_medico'];
    $observaciones = $mostrar['observaciones'];
    $estado = $mostrar['Estado'];
}

// Verificar si se recibió el ID del médico
if (isset($idmedico2) && !empty($idmedico2)) {
    // Consultar los horarios del médico
    $query = "SELECT * FROM horario WHERE id_medico = '$idmedico2' AND estado='Activo'";
    $result = $conn->query($query);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Inicializar un arreglo para almacenar los horarios
        $horarios = array();

        // Iterar sobre los resultados y agregarlos al arreglo de horarios
        while ($row = $result->fetch_assoc()) {
            $horarios[] = $row;
        }

        // Crear una tabla HTML para mostrar los horarios del médico
        if (!empty($horarios)) {
            echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th{background-color:white;}
                tr{background-color:rgb(128, 122, 133,0.3);}
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: center;
                }
              </style>";
            // Inicializar la tabla
            echo "<table>";
            echo "<tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr>";

            // Obtener todos los días de la semana
            $diasSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

            // Inicializar un arreglo para almacenar los horarios de cada día
            $horariosPorDia = array_fill_keys($diasSemana, array());

            // Organizar los horarios en un arreglo por día
            foreach ($horarios as $horario) {
                $dias = explode(", ", $horario['dias']);
                foreach ($dias as $dia) {
                    $horariosPorDia[$dia][] = "{$horario['hora_inicio']} - {$horario['hora_fin']}";
                }
            }

            // Recorrer los días de la semana para construir la tabla
            foreach ($diasSemana as $dia) {
                echo "<td>";
                foreach ($horariosPorDia[$dia] as $horario) {
                    echo "<div>$horario</div>";
                }
                echo "</td>";
            }

            // Cerrar la tabla
            echo "</table>";
        } else {
            echo "No se encontraron horarios para este médico.";
        }
    } else {
        echo "No se encontraron horarios para este médico.";
    }
} else {
    echo "ID de médico no proporcionado.";
}
?>

							<!-- Aquí se mostrará la tabla de horarios -->
						</div>
					</fieldset>
				</fieldset>
				<div class="botones-container" style="font-size:14px;">
					<button type="submit" name="btnregistrar" value="Registrar">
						<i class="fa-solid fa-calendar-day"></i>
						Actualizar
					</button>
					<!-- <a href="menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
						<i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i> Menú Principal
					</a>
					<a href="index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
						<i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i> Login
					</a> -->
					<a href="../../mant_citasmedicas.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;font-size:14px;">
						<i class="fa-solid fa-rectangle-xmark"></i> Cancelar
					</a>
				</div>
				<!-- <div>

					<iframe id="modal-iframe" src="consulta_cita.php" frameborder="0" style="width: 100%; height: 100%;max-height:440px;"></iframe>

				</div> -->
				<div style=" margin-top:-20;padding:0; height:0cm;">

				</div>
		
    
		</form>
</fieldset>
	</div>
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

	var idpacienteActual = "";
	// Obtener referencia al botón y al modal del paciente
	const btnbusquedapaciente = document.getElementById("buscarpaciente");
	const modalpaciente = document.getElementById("Modalpaciente");
	// Función para mostrar el modal de vacuna
	function mostrarModalp() {
		modalpaciente.style.display = "block";
	}
	// Función para ocultar el modal vacuna
	function ocultarModalp() {
		modalpaciente.style.display = "none";
	}
	// Asignar evento de clic al botón para mostrar u ocultar el modal DE VACUNA y evitar recargar la página
	btnbusquedapaciente.addEventListener("click", function(event) {
		event.preventDefault(); // Evitar recargar la página
		if (modalpaciente.style.display === "none") {
			mostrarModalp();
		} else {
			ocultarModalp();
		}
	});
</script>

</html>