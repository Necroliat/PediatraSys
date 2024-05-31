<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php"; // Asegúrate de que el archivo de conexión esté correctamente configurado

$pagina = isset($_GET['pag']) ? $_GET['pag'] : 1;

if (isset($_POST['btnregistrar'])) {
	$id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
	$id_padres = isset($_POST['id_padres']) ? $_POST['id_padres'] : null;
	$tipo_padre = isset($_POST['Tipo_Padre']) ? $_POST['Tipo_Padre'] : null;
	$errores = [];

	// Verificar que el ID del paciente no esté vacío
	if (empty($id_paciente)) {
		$errores[] = "Por favor ingrese el ID del paciente.";
	}

	// Verificar que el ID de los padres no esté vacío
	if (empty($id_padres)) {
		$errores[] = "Por favor ingrese el ID del padre/madre/tutor.";
	}

	// Verificar que el tipo de padre no esté vacío
	if (empty($tipo_padre)) {
		$errores[] = "Por favor seleccione el tipo de padre.";
	}

	// Si no hay errores, proceder con la inserción
	if (count($errores) == 0) {
		// Preparar y ejecutar la consulta de inserción
		$query_insercion = "INSERT INTO nino_padre (id_paciente, ID_Padre, Tipo_Padre) VALUES (?, ?, ?)";
		$stmt_insercion = $conn->prepare($query_insercion);
		$stmt_insercion->bind_param("iss", $id_paciente, $id_padres, $tipo_padre);

		if ($stmt_insercion->execute()) {
			echo "<script>alert('Registro exitoso!');</script>";
			echo "<script>window.location.href = '../../MANT_PadresConPacientes.php?pag=$pagina';</script>";
		} else {
			echo "<script>alert('Error en la inserción: " . $stmt_insercion->error . "');</script>";
		}
		$stmt_insercion->close();
	} else {
		// Mostrar alertas si hay errores
		foreach ($errores as $error) {
			echo "<script>alert('$error');</script>";
		}
	}
}




/* session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];

if (isset($_POST['btnregistrar'])) {
	$id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : null;
	$id_padres = isset($_POST['id_padres']) ? $_POST['id_padres'] : null;
	$tipo_padre = isset($_POST['Tipo_Padre']) ? $_POST['Tipo_Padre'] : null;
	$errores = [];

	// Verificar que el ID del paciente no esté vacío
	if (empty($id_paciente)) {
		$errores[] = "alert('Por favor ingrese el ID del paciente.');";
	}

	// Verificar que el ID de los padres no esté vacío
	if (empty($id_padres)) {
		$errores[] = "alert('Por favor ingrese el ID del padre/madre/tutor.');";
	}

	// Verificar que el tipo de padre no esté vacío
	if (empty($tipo_padre)) {
		$errores[] = "alert('Por favor seleccione el tipo de padre.');";
	}

	// Si no hay errores, proceder con la inserción
	if (count($errores) == 0) {
		// Realizar la consulta para verificar si ya existe una relación entre el padre y el paciente
		$query_verificacion = "SELECT 
                                    MIN(np.ID_Padre) AS id_nino_padre,
                                    p.id_paciente,
                                    p.nombre AS nombre_paciente,
                                    p.apellido AS apellido_paciente,
                                    dpp.nombre AS nombre_padre,
                                    dpp.apellido AS apellido_padre,
                                    Tipo_Padre
                                FROM 
                                    nino_padre np
                                JOIN 
                                    paciente p ON np.id_paciente = p.id_paciente  
                                JOIN 
                                    datos_padres_de_pacientes dpp ON np.ID_Padre = dpp.Numidentificador  
                                WHERE 
                                    np.id_paciente = $id_paciente
                                    AND np.ID_Padre = '$id_padres'
                                GROUP BY 
                                    p.id_paciente";


		$result_verificacion = mysqli_query($conn, $query_verificacion);
		if (mysqli_num_rows($result_verificacion) > 0) {

			echo "<script>alert('El padre/madre/tutor ya está vinculado(a) a este paciente.');</script>";
		} else {

			$query_insercion = "INSERT INTO `nino_padre`(`id_paciente`, `ID_Padre`, `Tipo_Padre`) VALUES ('$id_paciente', '$id_padres', '$tipo_padre')";

			echo "<script>alert('Registro exitoso!');</script>";
			echo "<script>window.location= '../../MANT_PadresConPacientes.php?pag=$pagina';</script>";
		}
	} else {
		// Mostrar alertas si hay errores
		echo "<script>" . implode("", $errores) . "</script>";
	}
}
 */
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
		#id_trabajo_medico,
		#ID_Padre {
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
		function validarLabels() {
			// Obtener los valores de los labels
			var nombrePaciente = document.getElementById('nombre_paciente').innerText.trim();
			var apellidoPaciente = document.getElementById('apellido_paciente').innerText.trim();
			var nombrePadres = document.getElementById('nombre_padres').innerText.trim();
			var apellidoPadres = document.getElementById('apellido_padres').innerText.trim();

			// Verificar que los labels de nombre y apellido del paciente tengan contenido
			if (nombrePaciente === '' || apellidoPaciente === '') {
				alert('El nombre y el apellido del paciente deben ser proporcionados.');
				return false;
			}

			// Verificar que los labels de nombre y apellido del padre/madre/tutor tengan contenido
			if (nombrePadres === '' || apellidoPadres === '') {
				alert('El nombre y el apellido del padre/madre/tutor deben ser proporcionados.');
				return false;
			}

			// Si todas las validaciones pasan, retornar true para permitir enviar el formulario
			return true;
		}
	</script>




</head>


<body>
	<div class="container">
		<fieldset style=" height:650px;">
			<form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
				<fieldset class="caja">
					<legend style="text-transform: uppercase;text-align: center;">
						<h4><i class="fa-solid fa-person-breastfeeding"></i>&nbsp;VINCULAR PADRES CON PACIENTES &nbsp; <i class="fa-solid fa-children"></i></h4>
					</legend>
					<div>
						<label for="id_paciente">ID PACIENTE:</label>
						<input type="text" id="id_paciente" name="id_paciente" style="width: 55px;" required>
						<script>
							$("#id_paciente").on("input", function() {
								var idPaciente = $(this).val();
								// Realizar la solicitud AJAX para obtener los datos del paciente
								$.ajax({
									url: '../../consulta_apellido_nombre_paciente.php', // Ruta al archivo PHP que creamos
									type: 'POST',
									data: {
										id_paciente: idPaciente
									},
									dataType: 'json',
									success: function(data) {

										actualizarTablaPadres(idPaciente);
										$("#nombre_paciente").text(data.nombre || '');
										$("#apellido_paciente").text(data.apellido || '');
									},
									error: function() {
										alert('Hubo un error al obtener los datos del paciente.');
									}
								});
							});

							function actualizarTablaPadres(idPaciente) {
								// Realizar la solicitud AJAX para obtener los datos de los padres vinculados
								$.ajax({
									url: 'consulta_padres_vinculados.php',
									type: 'POST',
									data: {
										id_paciente: idPaciente
									},
									dataType: 'html',
									success: function(data) {

										$("#tabla_padres_vinculados").html(data);
									},
									error: function() {
										alert('Hubo un error al obtener los datos de los padres vinculados.');
									}
								});
							}
						</script>
						<button class="btn btn-primary " type="button" id="buscar_paciente" onclick="mostrarModalpaciente()"><i class="fa-solid fa-magnifying-glass"></i></button>
						<div id="Modalpaciente" class="custom-modal">
							<div class="custom-modal-content">
								<span class="close" onclick="cerrarModalpaciente()"><span class="material-symbols-outlined">
										cancel
									</span></span>
								<iframe id="modal-iframe" src="../../consulta_paciente.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
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

						<label id="nombre_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;" required></label>
						<label id="apellido_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;" required></label>
						<span style="padding:25px">.</span>


						<div id="tabla_padres_vinculados">
							<!-- Aquí se mostrará la tabla de padres vinculados -->
						</div>
						<script>

						</script>
					</div>

					<div style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<label for="id_padres">ID del Padre/Madre/Tutor:</label>
						<input type="text" id="id_padres" name="id_padres" style="width: 255px;" required>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
						<script>
							$("#id_padres").on("input", function() {
								var idPadres = $(this).val().trim();

								if (idPadres.length > 0) {
									// Realizar la solicitud AJAX para obtener los datos del padre
									$.ajax({
										url: '../../consulta_apellido_nombre_padre.php',
										type: 'POST',
										data: {
											id_padres: idPadres
										},
										dataType: 'json',
										success: function(data) {
											$("#nombre_padres").text(data.nombre || '');
											$("#apellido_padres").text(data.apellido || '');

											// Llamar a la función para actualizar la tabla de pacientes vinculados
											actualizarTablaPacientes(idPadres);
										},
										error: function() {
											alert('Hubo un error al obtener los datos del padre.');
										}
									});
								} else {
									// Limpiar los campos si no hay nada escrito
									$("#nombre_padres").text('');
									$("#apellido_padres").text('');
								}
							});


							/* function actualizarTablaPadres(idPaciente) {
								// Realizar la solicitud AJAX para obtener los datos de los padres vinculados
								$.ajax({
									url: 'consulta_padres_vinculados.php',
									type: 'POST',
									data: {
										id_paciente: idPaciente
									},
									dataType: 'html',
									success: function(data) {
										$("#tabla_padres_vinculados").html(data);
									},
									error: function() {
										alert('Hubo un error al obtener los datos de los padres vinculados.');
									}
								});
							} */

							function actualizarTablaPacientes(idPadres) {
								// Realizar la solicitud AJAX para obtener los datos de los pacientes vinculados
								$.ajax({
									url: 'consulta_pacientes_vinculados.php',
									type: 'POST',
									data: {
										id_padres: idPadres
									},
									dataType: 'html',
									success: function(data) {
										$("#tabla_pacientes_vinculados").html(data);
									},
									error: function() {
										alert('Hubo un error al obtener los datos de los pacientes vinculados.');
									}
								});
							}
						</script>
						<button class="btn btn-primary " type="button" id="buscar_medico" onclick="mostrarModalpadres()"><i class="fa-solid fa-magnifying-glass"></i></button>
						<div id="Modalpadres" class="custom-modal">
							<div class="custom-modal-content">
								<span class="close" onclick="cerrarModalpadres()"><span class="material-symbols-outlined">cancel</span></span>
								<iframe id="modal-iframe" src="../../consulta_padrespacientes.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
							</div>
						</div>
						<script>
							// Función para mostrar el modal
							function mostrarModalpadres() {
								var modal = document.getElementById('Modalpadres');
								modal.style.display = 'block';
							}

							// Función para cerrar el modal
							function cerrarModalpadres() {
								var modal = document.getElementById('Modalpadres');
								modal.style.display = 'none';
							}
						</script>
						<div>
							<label id="nombre_padres" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;" required></label>

							<label id="apellido_padres" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;" required></label>
						</div>
						<div id="tabla_pacientes_vinculados">
							<!-- Aquí se mostrará la tabla de pacientes vinculados -->
						</div>
					</div>

					<label for="Tipo_Padre">Tipo de Padre:</label>
					<select id="Tipo_Padre" name="Tipo_Padre" required>
						<option value="Padre">Padre</option>
						<option value="Madre">Madre</option>
						<option value="Tutor Legal">Tutor Legal</option>
					</select><br><br>
				</fieldset>
				<div class="botones-container2">
					<button class="btn btn-primary" type="submit" name="btnregistrar" value="Registrar" onclick="return validarLabels();">
						<i class="fa-solid fa-plus"></i>
						Vincular Padre y Paciente
					</button>
					<a class="btn btn-primary" href="../../MANT_PadresConPacientes.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-xmark"></i> Cancelar
					</a>
				</div>
		</fieldset>
		</form>
	</div>
</body>

</html>