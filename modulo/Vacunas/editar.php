<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_vacuna_p'];



/* $querybuscar = mysqli_query($conn,"SELECT pv.id_vacuna_p, pv.id_paciente, pv.id_vacuna, pv.dosis, pv.refuerzo, pv.FECHA_APLICACION, tv.nombre AS nombre_vacuna
FROM pacientes_vacunas pv
INNER JOIN tipo_vacunas tv ON pv.id_vacuna = tv.id_vacuna
WHERE pv.id_vacuna_p =12"); */



$query = "SELECT pv.id_vacuna_p, pv.id_paciente, pv.id_vacuna, pv.dosis, pv.refuerzo, pv.FECHA_APLICACION, tv.nombre AS nombre_vacuna
          FROM pacientes_vacunas pv
          INNER JOIN tipo_vacunas tv ON pv.id_vacuna = tv.id_vacuna
          WHERE pv.id_vacuna_p = $coddni ";

$result = $conn->query($query);
while ($mostrar = mysqli_fetch_array($result)) {

	$idvacunap = $mostrar["id_vacuna_p"];
	$idpaciente = $mostrar["id_paciente"];
	$idvacuna = $mostrar["id_vacuna"];
	$nombrevacuna = $mostrar["nombre_vacuna"];
	$dosis = $mostrar["dosis"];
	$refuerzo = $mostrar["refuerzo"];
	$fecha = $mostrar["FECHA_APLICACION"];
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

		.centrado {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 20vh;
			/* Ajusta según tus necesidades */
		}
	</style>


	<?php
	//include("../../menu_lateral_header.php");
	?>
</head>
<?php
//include("../../menu_lateral.php");
?>

<body onload="checkFechaProvista()">

	<div class="container">

		<form method="POST">

			<fieldset>
				<legend style="text-transform: uppercase; text-align:center;">💉✏📅</legend>
				<div class="centrado">
					<img src="../../IMAGENES/vacunacion.png" class="" alt="Mantenimientos" style="width: 48px; height: 48px;">
					<h4>EDITAR VACUNA DEL PACIENTE</h4>
				</div>
				<div>
					<label for="id_vacuna">ID Vacuna:</label>
					<input type="text" id="id_vacuna" name="id_vacuna" style="width: 55px;" value="<?php echo $idvacuna; ?>" required>
					<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalvacuna()"><i class="fa-solid fa-magnifying-glass"></i></button>

				</div>
				<div>
					<label for="Nombre_vacuna">Nombre de la Vacuna:</label>
					<label id="nombre_vacuna" name="nombre_vacuna" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $nombrevacuna; ?></label>
				</div>
				<div id="Modalvacuna" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close" onclick="cerrarModalvacuna()"><span class="material-symbols-outlined">
								cancel
							</span></span>
						<iframe id="modal-iframe" src="../../consulta_vacunas.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
					</div>
				</div>
				<script>
					// Función para mostrar el modal
					function mostrarModalvacuna() {
						var modal = document.getElementById('Modalvacuna');
						modal.style.display = 'block';
					}

					// Función para cerrar el modal
					function cerrarModalvacuna() {
						var modal = document.getElementById('Modalvacuna');
						modal.style.display = 'none';
					}
				</script>


				<div style="border-top:20px;">
					<label for="dosis">Dosis:</label>
					<select id="dosis" name="dosis" style="width: 110px;" required>
						<?php
						$dosis_values = array("1era", "2da", "3ra", "4ta", "5ta", "6ta", "7ma", "8va", "9na", "10ma", "NA");
						foreach ($dosis_values as $value) {
							echo "<option value='$value'";
							if ($value == $dosis) {
								echo " selected";
							}
							echo ">$value</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label for="refuerzo">Refuerzo:</label>
					<select id="refuerzo" name="refuerzo" style="width: 110px;">
						<?php
						$refuerzo_values = array("1er", "2do", "3ro", "4to", "5to", "6to", "7mo", "8vo", "9no", "10mo", "NA");
						foreach ($refuerzo_values as $value) {
							echo "<option value='$value'";
							if ($value == $refuerzo) {
								echo " selected";
							}
							echo ">$value</option>";
						}
						?>
					</select>
				</div>
				<div>
					<label for="fecha_aplicacion">Fecha de Aplicación:</label>
					<select id="fecha_aplicacion_select" name="fecha_aplicacion_select" style="width: 180px;" onchange="checkFechaProvista()">
						<option value="fecha_provista" <?php if ($fecha) echo "selected"; ?>>Fecha Provista</option>
						<option value="fecha_no_provista" <?php if (!$fecha) echo "selected"; ?>>Fecha No Provista</option>
					</select>
					<input type="date" id="fecha_aplicacion_input" name="fecha_aplicacion_input" style="display: none;" value="<?php echo $fecha; ?>">
				</div>

				<div class="botones-container">
					<button type="submit" name="btnmodificar" value="Registrar">
						<i class="fa-solid fa-file-pen"></i>
						MODIFICAR
					</button>
					<a class="boton" href="../../mant-pacientevacuna.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-circle-xmark"></i> Cancelar
					</a>
				</div>
			</fieldset>
		</form>
	</div>
	<script>
     function checkFechaProvista() {
			var fechaAplicacionSelect = document.getElementById('fecha_aplicacion_select');
			var fechaAplicacionInput = document.getElementById('fecha_aplicacion_input');

			if (fechaAplicacionSelect.value === 'fecha_provista') {
				fechaAplicacionInput.style.display = 'inline-block';
			} else {
				fechaAplicacionInput.style.display = 'none';
			}
		}


		
					// Función para búsqueda dinámica del nombre de la vacuna por ID
					function buscarNombreVacuna() {
						var idVacuna = $("#id_vacuna").val();
						$.ajax({
							url: "../../buscar_nombre_vacuna.php", // Archivo PHP para buscar el nombre de la vacuna por ID
							type: "POST",
							data: {
								id_vacuna: idVacuna
							},
							dataType: "json",
							success: function(data) {
								$("#nombre_vacuna").text(data ? data.Nombre : "Valor no encontrado");
							},
							error: function(error) {
								console.log("Error:", error);
							}
						});
					}

					// Evento para ejecutar la búsqueda al cambiar el valor del campo ID de la vacuna
					$("#id_vacuna").on("input", buscarNombreVacuna);
				
	</script>
</body>

<?php

if (isset($_POST['btnmodificar'])) {
    $idvacunap2 = $idvacunap;
    $idpaciente2 = $idpaciente;
    $idvacuna2 = $_POST['id_vacuna'];
    $dosis2 = $_POST['dosis'];
    $refuerzo2 = $_POST['refuerzo'];
    if ($_POST['fecha_aplicacion_select'] == "fecha_provista") {
        $fecha2 = $_POST['fecha_aplicacion_input'];
    } else {
        $fecha2 = 'fecha_no_provista';
    }
    
    $stmt = $conn->prepare("UPDATE pacientes_vacunas SET id_vacuna_p=?, id_paciente=?, id_vacuna=?, dosis=?, refuerzo=?, FECHA_APLICACION=? WHERE id_vacuna_p=?");
    $stmt->bind_param("iiisssi", $idvacunap2, $idpaciente2, $idvacuna2, $dosis2, $refuerzo2, $fecha2, $idvacunap2);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script> alert('Registro actualizado con éxito.');</script>";
        echo "<script>window.location= '../../mant-pacientevacuna.php?pag=$pagina';</script>";
    } else {
        echo "<script> alert('Error al actualizar el registro o ningún cambio necesario.');</script>";
    }

    $stmt->close();
}

?>

</html>