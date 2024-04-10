<?php

session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];

// Variable de bandera para indicar si se encontró un choque de horarios
$choqueEncontrado = false;

// Función para verificar choques de horarios
function verificarChoques($idMedico, $dia, $horaInicio, $horaFin, $etiqueta)
{
	global $conn, $choqueEncontrado;

	// Consulta para verificar choques de horarios para el día específico
	$query = "SELECT * FROM horario WHERE id_medico = '$idMedico' AND dias LIKE '%$dia%' AND Estado = 'Activo'";
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
			/*  if (($horaInicio >= $horaInicioDB && $horaInicio < $horaFinDB) || ($horaFin > $horaInicioDB && $horaFin <= $horaFinDB)) {
                // Imprimir mensaje de choque de horarios
                echo "<script>alert('Hay un choque en el día $dia con el horario de $horaInicioDB a $horaFinDB');</script>";
                // Establecer la variable de bandera en true
                $choqueEncontrado = true;
                // Detener la función de verificación
                return;
            } */
		}
	}
}


// Consultar el último ID de la tabla HORARIOS
$query = "SELECT MAX(id_horario) AS max_id FROM horario";
$result = $conn->query($query);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$lastId = $row["max_id"];
	$newId = $lastId + 1;
} else {
	// Si no hay registros en la tabla, asignar el ID inicial
	$newId = 1;
}

// Guardar el nuevo ID en una variable PHP
$idhorario = $newId;

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
		verificarChoques($idmedico, $dia, $horainicial, $horafinal, $etiqueta);
		// Si se encontró un choque, detener la ejecución
		if ($choqueEncontrado) {
			break;
		}
	}

	// Si no se encontraron choques, proceder con el registro en la base de datos
	if (!$choqueEncontrado) {
		// Insertar datos en la tabla horario
		$dias = implode(", ", $diasSeleccionados);
		$queryAdd = mysqli_query($conn, "INSERT INTO horario (id_horario, id_medico, dias, etiqueta, hora_inicio, hora_fin, Estado) VALUES('$idhorario', '$idmedico','$dias','$etiqueta','$horainicial','$horafinal','$estado')");

		if (!$queryAdd) {
			echo "Error con el registro: " . mysqli_error($conn);
		} else {
			echo "<script>window.location= '../../mant_horario.php?pag=1' </script>";
		}
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
	<script type="text/javascript">
		// Obtener el campo de entrada y el nuevo ID
		var txtId = document.getElementById("txtid");
		var newId = <?php echo $idLaboratorio; ?>;
		// Asignar el nuevo ID al campo de entrada
		txtId.value = newId;
		// Cambiar el fondo a gris claro
		txtId.style.backgroundColor = "#f0f0f0";

		function placeCursorAtEnd() {
			if (this.setSelectionRange) {
				// Double the length because Opera is inconsistent about 
				// whether a carriage return is one character or two.
				var len = this.value.length * 2;
				this.setSelectionRange(len, len);
			} else {
				// This might work for browsers without setSelectionRange support.
				this.value = this.value;
			}
			if (this.nodeName === "TEXTAREA") {
				// This will scroll a textarea to the bottom if needed
				this.scrollTop = 999999;
			}
		};
		window.onload = function() {
			var input = document.getElementById("txtseg");

			if (obj.addEventListener) {
				obj.addEventListener("focus", placeCursorAtEnd, false);
			} else if (obj.attachEvent) {
				obj.attachEvent('onfocus', placeCursorAtEnd);
			}

			input.focus();
		}
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
				<legend>REGISTRAR HORARIO DE TRABAJO</legend>
				<fieldset class="caja">
					<legend class="cajalegend" style="text-align: center;">══ CREAR NUEVO HORARIO PARA EL MÉDICO 📅👩‍⚕️👨‍⚕️ ══</legend>
					<p style="margin:0;">
						<label for="txtid">ID horario</label>
						<input type="text" name="txtid" id="txtid" value="<?php echo $idhorario; ?>" required readonly>
					</p>


					<div style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<label for="id_medico">ID medico:</label>
						<input type="text" id="id_medico" name="id_medico" required>
						<button class="btn btn-primary " type="button" id="buscar_medico" onclick="mostrarModalmedico()"><i class="fa-solid fa-magnifying-glass"></i></button>
						<div id="Modalmedico" class="custom-modal">
							<div class="custom-modal-content">
								<span class="close" onclick="cerrarModalmedico()"><span class="material-symbols-outlined">cancel</span></span>
								<iframe id="modal-iframe" src="../../consulta_medico.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
							</div>
						</div>
						<script>
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
						</script>

						<label for="Nombre_medico">Nombre:</label>
						<label id="nombre_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
						<label for="Apellido_medico" style="margin-left:5px;">Apellido:</label>
						<label id="apellido_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;margin-left:5px;"></label>
					</div>

					<fieldset>
						<legend style="padding: 0%; margin: 0%;">DIAS QUE TRABAJARÁ:</legend>
						<div id="checklist" style="display: flex; flex-wrap: wrap;">
							<p style="text-align:center; font-weight:bold;">Dias Laborables:</p><label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Lunes"> Lunes</label>
							<label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Martes"> Martes</label>
							<label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Miércoles"> Miércoles</label>
							<label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Jueves"> Jueves</label>
							<label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Viernes"> Viernes</label>
							<hr style="width: 100%; margin: 10px 0;">
							<p style="text-align:center; font-weight:bold;">Fin de semana:</p>
							<label style="margin-right: 10px;"><input type="checkbox" name="dia[]" value="Sábado"> Sábado</label>
						</div>
					</fieldset>

					<fieldset>
						<div style="display: flex; flex-wrap: wrap;">
							<!-- <div><label for="txtetiqueta">Identificador del horario</label>
								<select id="txtetiqueta" name="txtetiqueta" style=" width: 110px; " autocomplete="off" value="<?php echo $etiqueta; ?>" require>

									<option selected value="Regular">Regular</option>
									<option value="Alterno">Alterno</option>
								</select>
								
							</div><br> -->

							<div>
								<label for="hora_inicio">Hora de inicio:</label>
								<input type="time" id="hora_inicio" name="hora_inicio" value="09:00">
							</div><br>

							<div>
								<label for="hora_fin">Hora de fin:</label>
								<input type="time" id="hora_fin" name="hora_fin" value="18:00">
							</div><br>

							<div><label>Estado</label>
								<select id="txtestado" name="txtestado" style=" width: 110px; " autocomplete="off" value="<?php echo $estado; ?>" require>

									<option selected value="Activo">Activo</option>
									<option value="Inactivo">Inactivo</option>
								</select>
								<!-- <input type="text" name="txtest" autocomplete="off" require> -->
							</div>
						</div>
					</fieldset>
					<div id="tabla_horarios">
						<!-- Aquí se mostrará la tabla de horarios -->
					</div>
				</fieldset>
				<div class="botones-container">
					<button type="submit" name="btnregistrar" value="Registrar">
						<i class="fa-solid fa-plus"></i>
						Registrar
					</button>
					<a class="boton" href="../../mant_horario.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-xmark"></i> Cancelar
					</a>


					
				</div>
				<!-- <iframe id="modal-iframe" src="../../consulta_horario.php" frameborder="0" style="width: 100%; height: 100%;max-height:700px;"></iframe> -->
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

		</form>
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