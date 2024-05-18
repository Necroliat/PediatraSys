<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_paciente'];

//$coddni =5;

$querybuscar = mysqli_query($conn, "SELECT * FROM   seguro_paciente WHERE id_paciente =$coddni");

 while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$idpaciente = $mostrar['id_paciente'];
	$nss = $mostrar['NSS'];
	$idseguro= $mostrar['Id_seguro_salud'];
} 
$querybuscar2 = mysqli_query($conn, "SELECT * FROM paciente WHERE id_paciente =$coddni");

while ($mostrar2 = mysqli_fetch_array($querybuscar2)) {
	$idpaciente2 = $mostrar2['id_paciente'];
	$nombre = $mostrar2['nombre'];
	$apellido = $mostrar2['apellido'];
	$sexo = $mostrar2['sexo'];
	$fecnac = $mostrar2['fecha_nacimiento'];
	$nacion = $mostrar2['Nacionalidad'];
	$vivecon = $mostrar2['Con_quien_vive'];
	$direccion = $mostrar2['Direccion_reside'];
}


$querybuscar3 = mysqli_query($conn, "SELECT * FROM seguro WHERE Id_seguro_salud =$idseguro");

while ($mostrar3 = mysqli_fetch_array($querybuscar3)) {
    $segid     = $mostrar3['Id_seguro_salud'];
    $segnom     = $mostrar3['Nombre'];
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


	<?php
	//include("../../menu_lateral_header.php");
	?>
</head>
<?php
//include("../../menu_lateral.php");
?>

<body>
<?php ?>
	<div class="container">
		<fieldset style=" height:650px;">
			<form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
				<fieldset>
					<legend>Modificando seguro del paciente✏💳</legend>
					<fieldset class="caja" width="100%">
						<div>
							<label for="id_paciente">Id Paciente:</label>
							<input type="text" id="id_paciente" name="id_paciente"  value="<?php echo $idpaciente ;?>" required readonly>
							
							<div id="Modalpaciente" class="custom-modal">
								<div class="custom-modal-content">
									<span class="close" onclick="cerrarModalpaciente()"><span class="material-symbols-outlined">
											cancel
										</span></span>
									<iframe id="modal-iframe" src="../../consulta_paciente-sinseguro.php" frameborder="0" style="width: 100%; height: 70%;"></iframe>
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
						<script>
							$("#id_paciente").on("input", function() {
								var idPaciente = $(this).val();
								// Realizar la solicitud AJAX para obtener los datos del paciente
								$.ajax({
									url: '../../consulta_apellido_nombre_paciente-sinseguro.php', // Ruta al archivo PHP que creamos
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
							<label for="Nombre_paciente">Nombre del paciente:</label>
							<label id="nombre_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $nombre ;?></label>
						</div>
						<div>
							<label for="Apellido_paciente" style="margin-left:5px;">Apellido del paciente:</label>
							<label id="apellido_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $apellido ;?></label>
						</div>
					</fieldset>
					<div>
						<label for="NSS">Número de Seguro:</label>
						<input type="text" id="NSS" namNombre dele="NSS" title="Ingrese el número de seguro" placeholder="Número de Seguro" name="NSS" value="<?php echo $nss ;?>" required>
					</div>
					<div>
						<label for="Id_seguro_salud">ID Seguro de Salud:</label>
						<input type="text" id="Id_seguro_salud" name="Id_seguro_salud" title="Ingrese el ID del seguro de salud" placeholder="ID Seguro de Salud" oninput="buscarSeguro()" style="width:110px" value="<?php echo $idseguro ;?>" required>
						<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalSeguros()"><i class="fa-solid fa-magnifying-glass"></i></button>
						<script>
							function buscarSeguro() {
								var idSeguro = $("#Id_seguro_salud").val();
								$.ajax({
									url: "../../buscar_seguro.php",
									type: "POST",
									data: {
										id_seguro: idSeguro
									},
									dataType: "json",
									success: function(data) {
										$("#Nombre_seguro").text(data ? data.Nombre : "Dato no encontrado");
									},
									error: function(error) {
										console.log("Error:", error);
									}
								});
							}
						</script>
					</div>
					<div>
						<label for="Nombre_seguro">Nombre del Seguro:</label>
						<label id="Nombre_seguro" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"><?php echo $segnom ;?></label>
					</div>
					<br>
					<div id="ModalSeguros" class="custom-modal">
						<div class="custom-modal-content">
							<span class="close" onclick="cerrarModalSeguros()"><span class="material-symbols-outlined">
									cancel
								</span></span>
							<iframe id="modal-iframe" src="../../consulta_seguros.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
						</div>
					</div>
					<script>
						// Función para mostrar el modal
						function mostrarModalSeguros() {
							var modal = document.getElementById('ModalSeguros');
							modal.style.display = 'block';
						}
						// Función para cerrar el modal
						function cerrarModalSeguros() {
							var modal = document.getElementById('ModalSeguros');
							modal.style.display = 'none';
						}
					</script>
				</fieldset>

				<div class="botones-container">
					<button type="submit" name="btnmodificar" value="Registrar">
						<i class="fa-solid fa-file-pen"></i>
						Editar
					</button>
					<a class="boton" href="../../mant-paciente-seguro.php?pag=<?php echo $pagina; ?>">
						<i class="fa-solid fa-circle-xmark"></i> Cancelar
					</a>
				</div>
			</form>
		</fieldset>
		<script>
			function validarFormulario() {
				// Obtener todos los campos del formulario
				var id_paciente = document.getElementById('id_paciente').value.trim();
				var NSS = document.getElementById('NSS').value.trim();
				var Id_seguro_salud = document.getElementById('Id_seguro_salud').value.trim();

				// Obtener los valores de las etiquetas
				var nombre_paciente = document.getElementById('nombre_paciente').textContent.trim();
				var apellido_paciente = document.getElementById('apellido_paciente').textContent.trim();

				// Verificar que ningún campo del formulario esté vacío
				if (id_paciente === "" || NSS === "" || Id_seguro_salud === "") {
					alert("Por favor, complete todos los campos obligatorios.");
					return false; // Prevenir el envío del formulario
				}

				// Verificar que las etiquetas no estén vacías
				if (nombre_paciente === "" || apellido_paciente === "") {
					alert("El ID del paciente no es válido. Por favor, verifique.");
					return false; // Prevenir el envío del formulario
				}

				return true; // Permitir el envío del formulario
			}
		</script>
	</div>
</body>



</html>
<?php
if (isset($_POST['btnmodificar'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pediatra_sis";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $id_paciente = $_POST['id_paciente'];
    $NSS = $_POST['NSS'];
    $Id_seguro_salud = $_POST['Id_seguro_salud'];

    // Preparar la consulta SQL para actualizar datos en la tabla seguro_paciente
    $stmt = $conn->prepare("UPDATE seguro_paciente SET NSS = ?, Id_seguro_salud = ? WHERE id_paciente = ?");
    $stmt->bind_param("ssi", $NSS, $Id_seguro_salud, $id_paciente);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Datos actualizados exitosamente.'); window.location.href='../../mant-paciente-seguro.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar los datos: " . $stmt->error . "'); window.location.href='../../mant-paciente-seguro.php';</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
