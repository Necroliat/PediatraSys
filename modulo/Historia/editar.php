<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['IDdetalle_HC'];



$querybuscar = mysqli_query($conn, "SELECT dhc.ID_Hist_Clic,dhc.id_padecimiento,hc.ID_Paciente, pc.nombre_padecimiento,dhc.IDdetalle_HC, dhc.desde_cuando, dhc.notas
FROM historia_clinica hc
INNER JOIN detalle_historia_clinica dhc ON hc.ID_Hist_Clic = dhc.ID_Hist_Clic
INNER JOIN padecimientos_comunes pc ON dhc.id_padecimiento = pc.id_padecimiento
WHERE dhc.IDdetalle_HC = '$coddni'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$idpadecimiento = $mostrar['id_padecimiento'];
	$notas = $mostrar['notas'];
	$nombrepadecimiento = $mostrar['nombre_padecimiento'];
	$desdecuando = $mostrar['desde_cuando'];
	$iddetalle = $mostrar['IDdetalle_HC'];
	$idhistoria = $mostrar['ID_Hist_Clic'];
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<body>

	<div class="container">

		<form method="POST">

			<fieldset id="fieldsetContainer">
				<legend> EDITAR PADECIMIENTO DEL PACIENTE</legend>
				<label for="id_padecimiento">ID Padecimiento:</label>
				<input type="text" id="id_padecimiento" name="id_padecimiento" style="width:55px" value="<?php echo $idpadecimiento; ?>" required>

				<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalHistoriaClinica()"><i class="fa-solid fa-magnifying-glass"></i></button>

				<div>
					<label for="Nombre_padecimiento">Nombre del padecimiento:</label>
					<label id="nombre_padecimiento" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $nombrepadecimiento; ?></label>
				</div>
				<div id="ModalHistoriaClinica" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close" onclick="cerrarModalHistoriaClinica()"><span class="material-symbols-outlined">
								cancel
							</span></span>
						<iframe id="modal-iframe" src="../../consulta_padecimientos.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
					</div>
				</div>
				<script>
					// Función para mostrar el modal
					function mostrarModalHistoriaClinica() {
						var modal = document.getElementById('ModalHistoriaClinica');
						modal.style.display = 'block';
					}

					// Función para cerrar el modal
					function cerrarModalHistoriaClinica() {
						var modal = document.getElementById('ModalHistoriaClinica');
						modal.style.display = 'none';
					}
				</script>

				<label for="notas">Notas:</label>
				<input type="text" id="notas" name="notas" value="<?php echo $notas; ?>">
				<br>
				<label for="desde_cuando">Desde cuándo:</label>
				<input type="date" id="desde_cuando" name="desde_cuando" value="<?php echo $desdecuando; ?>" onchange="calculateYears()"><br>
				<span id="yearsSince"></span>
				<div class="botones-container">
					<button type="submit" name="btnmodificar" value="Registrar">
						<i class="fa-solid fa-file-pen"></i>
						MODIFICAR
					</button>
					<a class="boton" href="../../mant_paciente_historiaClinica.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-circle-xmark"></i> Cancelar
					</a>
				</div>
			</fieldset>
		</form>
	</div>
	<script>
		function buscarNombrePadecimiento() {
			var idPadecimiento = $("#id_padecimiento").val();
			$.ajax({
				type: "POST",
				url: "../../buscar_padecimiento.php",
				data: {
					id_padecimiento: idPadecimiento
				},
				dataType: "json",
				success: function(data) {
					$("#nombre_padecimiento").text(data ? data.nombre_padecimiento :
						"Valor no encontrado");
				},
				error: function(error) {
					console.log("Error:", error);
				}
			});
		}

		// Evento para ejecutar la búsqueda al cambiar el valor del campo ID de la vacuna
		$("#id_padecimiento").on("input", buscarNombrePadecimiento);



		function calculateYears() {
			const fechaSeleccionada = document.getElementById("desde_cuando").value;
			const fechaActual = new Date();
			const diferencia = fechaActual.getFullYear() - new Date(fechaSeleccionada).getFullYear();
			document.getElementById("yearsSince").textContent = "Lleva padeciendo esta enfermedad durante " + diferencia +
				" años.";
		}
	</script>
</body>

<?php

if (isset($_POST['btnmodificar'])) {

	$iddetalle2 = $iddetalle;
	$idhistoria2 = $idhistoria; // Esta variable está mal etiquetada, parece ser la hora y no el ID.
	$id_padecimiento2 = $_POST['id_padecimiento'];
	$notas2 = $_POST['notas'];
	$desde_cuando2 = $_POST['desde_cuando'];

	
	$stmt = $conn->prepare("UPDATE detalle_historia_clinica SET ID_Hist_Clic=?, id_padecimiento=?, notas=?, desde_cuando=? WHERE IDdetalle_HC=?");
	$stmt->bind_param("iissi", $idhistoria2, $id_padecimiento2, $notas2, $desde_cuando2, $iddetalle2);
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		echo "<script> alert('Registro actualizado con éxito.');</script>";
		echo "<script>window.location= '../../mant_paciente_historiaClinica.php?pag=$pagina';</script>";
	} else {
		echo "<script> alert('Error al actualizar el registro o ningún cambio necesario.');</script>";
	}

	$stmt->close();
}

?>

</html>