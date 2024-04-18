<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
// Consultar el último ID de la tabla especialidad
$query = "SELECT MAX(ID_Localizador) AS max_id FROM localizador_padres_de_pacientes";
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
$idlocalizadorm = $newId;
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
	$camposRequeridos = ['txtid', 'id_padres', 'txtvalor', 'txtetiqueta'];
	if (validarCampos($camposRequeridos)) {
		$idlocalizador = $_POST['txtid'];
		$identificador = $_POST['id_padres'];
		$valor = $_POST['txtvalor'];
		$etiqueta = $_POST['txtetiqueta'];

		// Insertar datos en la tabla laboratorio
		$queryAdd = mysqli_query($conn, "INSERT INTO localizador_padres_de_pacientes (ID_Localizador, Identificador, Valor, Etiqueta) VALUES('$idlocalizadorm', '$identificador','$valor','$etiqueta')");

		if (!$queryAdd) {
			echo "Error con el registro: " . mysqli_error($conn);
		} else {
			echo "<script>window.location= '../../mant_localizadorp.php?pag=1' </script>";
		}
	} else {
		echo "<script>alert('Por favor, complete tolos campos');</script>";
	}
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	<style>
		/* Estilos personalizados aquí */
	</style>
	<script>
		// Función para validar campos antes de enviar el formulario
		function validarFormulario() {
			var idlocalizadorm = document.getElementById("txtid").value;
			var idenficador = document.getElementById("id_padres").value;
			var valor = document.getElementById("txtvalor").value;
			var etiqueta = document.getElementById("txtetiqueta").value;

			if (idlocalizadorm.trim() === '' || identificador.trim() === '' || valor.trim() === '' || etiqueta.trim() === '') {
				alert("Por favor, complete toos los campos");
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
			padding: 10px;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin: 10px;
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
			grid-gap: 6px 10px;
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
	</style>
<script>
		$(document).ready(function() {
			// Función para aplicar máscara y actualizar el ejemplo según la etiqueta seleccionada
			function applyMaskAndExample() {
				var etiqueta = $('#txtetiqueta').val();
				var valorInput = $('#txtvalor');
				switch (etiqueta) {
					case "Telefono":
					case "Telefono Principal":
					case "Telefono Alterno":
					case "Telefono Casa":
					case "Movil Principal":
					case "Movil Alterno":
					case "Movil Corporativo":
						// Aplicar máscara para teléfono
						valorInput.mask('(000) 000-0000', {
							autoclear: false
						});
						// Mostrar ejemplo de teléfono
						valorInput.attr('placeholder', '(123) 456-7890');
						// Limitar entrada a números y un máximo de 10 dígitos
						valorInput.attr('maxlength', '14').keypress(function(event) {
							return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 45 || event.which == 32 || event.which == 40 || event.which == 41 || event.which == 0;
						});
						break;
					case "Email Personal":
					case "Email Trabajo":
					case "Email Alternativo":
						// Quitar máscara de teléfono
						valorInput.unmask();
						// Mostrar ejemplo de correo electrónico
						valorInput.attr('placeholder', 'ejemplo@dominio.com');
						// Validar formato de correo electrónico
						valorInput.attr('type', 'email');
						// Permitir cualquier entrada para correos electrónicos
						valorInput.off('keypress').removeAttr('maxlength');
						break;
					default:
						// Quitar máscara de teléfono
						valorInput.unmask();
						// Quitar ejemplo
						valorInput.attr('placeholder', '');
						valorInput.attr('type', 'text');
						// Permitir cualquier entrada para otros tipos
						valorInput.off('keypress').removeAttr('maxlength');
						break;
				}
			}

			// Llamar a la función al cargar la página
			applyMaskAndExample();

			// Llamar a la función al cambiar la etiqueta seleccionada
			$('#txtetiqueta').change(function() {
				applyMaskAndExample();
			});
		});
	</script>
	
</head>


<body>
	<div class="container">
		<fieldset style="height:1000px;">
			<form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
				<legend>
					<h4 style="text-transform: uppercase;">REGISTRAR VALORES AGENDA PADRES</h4>
				</legend>
				<fieldset class="caja">
					<legend class="cajalegend" style="text-transform: uppercase;">══ Nuevo valor localizador ══<i class="fa-regular fa-address-book"></i> ══ 📠📮</legend>
					<p style="margin:0;">
						<label for="txtid">ID localizador</label>
						<input type="text" name="txtid" id="txtid" value="<?php echo $idlocalizadorm; ?>" required readonly>
					</p>

					<p>
					<div style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<label for="id_padres">ID padre:</label>
						<input type="text" id="id_padres" name="id_padres" style="width: 55px;" required>

						<button class="btn btn-primary " type="button" id="buscar_medico" onclick="mostrarModalpadres()"><i class="fa-solid fa-magnifying-glass"></i></button>
						<div id="Modalpadres" class="custom-modal">
							<div class="custom-modal-content">
								<span class="close" onclick="cerrarModalpadres()"><span class="material-symbols-outlined">cancel</span></span>
								<iframe id="modal-iframe" src="../../consulta_padrespacientes.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
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
							<label for="Nombre_padres">Nombre del padre:</label>
							<label id="nombre_padres" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
						</div>
						<div>
							<label for="Apellido_padres">Apellido del padre:</label>
							<label id="apellido_padres" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
						</div>
					</div>
					<script>
						$("#id_padres").on("input", function() {
							var idpadres = $(this).val();
							// Realizar la solicitud AJAX para obtener los datos del paciente
							$.ajax({
								url: 'consulta_apellido_nombre_padre.php', // Ruta al archivo PHP que creamos
								type: 'POST',
								data: {
									id_padres: idpadres
								},
								dataType: 'json',
								success: function(data) {
									$("#nombre_padres").text(data.nombre || '');
									$("#apellido_padres").text(data.apellido || '');
								},
								error: function() {
									alert('Hubo un error al obtener los datos padre.');
								}
							});
						});
					</script>
					</p>
					<div style="display: flex; flex-wrap: wrap;vertical-align: baseline;align-items: baseline;">
						<div>
							<label>Etiqueta</label>
							<select id="txtetiqueta" name="txtetiqueta" style="width: 110px;" autocomplete="off" change="applyMaskAndExample()"required>
								<option selected value="Telefono">Telefono</option>
								<option value="Telefono Principal">Telefono Principal</option>
								<option value="Telefono Alterno">Telefono Alterno</option>
								<option value="Telefono Casa">Telefono Casa</option>
								<option value="Movil Principal">Movil Principal</option>
								<option value="Movil Alterno">Movil Alterno</option>
								<option value="Movil Corporativo">Movil Corporativo</option>
								<option value="Email Personal">Email Personal</option>
								<option value="Email Trabajo">Email Trabajo</option>
								<option value="Email Alternativo">Email Alternativo</option>
							</select>
						</div>
						<p>
							<label for="txtvalor">Valor</label>
							<input type="text" name="txtvalor" id="txtvalor" required>
						</p>
					</div>
				</fieldset>
				<div class="botones-container">
					<button type="submit" name="btnregistrar" value="Registrar">
						<i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>
						Registrar
					</button>
					<a class="boton" href="../../mant_localizadorp.php?pag=<?php echo $pagina; ?>">
						<i class="material-icons" style='font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;'>close</i> Cancelar
					</a>
				</div>
				<iframe id="modal-iframe" src="../../consulta_localizadorp.php" frameborder="0" style="width: 100%; height: 100%;max-height:700px;"></iframe>
			</form>
		</fieldset>
	</div>
	
</body>
<script>
	$(document).ready(function() {
		// Función para aplicar máscara y actualizar el ejemplo según la etiqueta seleccionada
		function applyMaskAndExample() {
			var etiqueta = $('#txtetiqueta').val();
			var valorInput = $('#txtvalor');
			switch (etiqueta) {
				case "Telefono":
				case "Telefono Principal":
				case "Telefono Alterno":
				case "Telefono Casa":
				case "Movil Principal":
				case "Movil Alterno":
				case "Movil Corporativo":
					// Aplicar máscara para teléfono
					valorInput.mask('(000) 000-0000', {
						autoclear: false
					});
					// Mostrar ejemplo de teléfono
					valorInput.attr('placeholder', '(123) 456-7890');
					// Limitar entrada a números y un máximo de 10 dígitos
					valorInput.attr('maxlength', '14').keypress(function(event) {
						return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 45 || event.which == 32 || event.which == 40 || event.which == 41 || event.which == 0;
					});
					break;
				case "Email Personal":
				case "Email Trabajo":
				case "Email Alternativo":
					// Quitar máscara de teléfono
					valorInput.unmask();
					// Mostrar ejemplo de correo electrónico
					valorInput.attr('placeholder', 'ejemplo@dominio.com');
					// Validar formato de correo electrónico
					valorInput.attr('type', 'email');
					// Permitir cualquier entrada para correos electrónicos
					valorInput.off('keypress').removeAttr('maxlength');
					break;
				default:
					// Quitar máscara de teléfono
					valorInput.unmask();
					// Quitar ejemplo
					valorInput.attr('placeholder', '');
					valorInput.attr('type', 'text');
					// Permitir cualquier entrada para otros tipos
					valorInput.off('keypress').removeAttr('maxlength');
					break;
			}
		}

		// Llamar a la función al cargar la página
		applyMaskAndExample();

		// Llamar a la función al cambiar la etiqueta seleccionada
		$('#txtetiqueta').change(function() {
			applyMaskAndExample();
		});
	});
</script>
</html>