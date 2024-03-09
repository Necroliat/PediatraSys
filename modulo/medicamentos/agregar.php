<?php
session_start();

error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
//require_once("../../mant_seguro.php");

$pagina = $_GET['pag'];

// Consultar el último ID de la tabla seguro
$query = "SELECT MAX(Id_medicamento) AS max_id FROM medicamento";
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
$segid = $newId;
?>
<html>

<head>
	<title>Sis_Pediátrico</title>
	<link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" type="text/css" href="../../css/estilo-paciente.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
		}
	</style>
	<script type="text/javascript">
		// Obtener el campo de entrada y el nuevo ID
		var txtId = document.getElementById("txtid");
		var newId = <?php echo $segid; ?>;

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
			} <
			script >
			function validarFormulario() {
				// Obtener referencias a los campos del formulario
				var txtmed = document.getElementById('txtseg');
				var txtdesc = document.getElementById('txtdesc');
				var txtform = document.getElementById('txtform');
				var txtcant = document.getElementById('txtcant');

				// Validar que los campos no estén vacíos
				if (txtmed.value === '' || txtdesc.value === '' || txtform.value === '' || txtcant.value === '') {
					alert('Todos los campos son obligatorios. Por favor, completa todos los campos.');
					return false; // Impide el envío del formulario
				}

				// Agrega otras validaciones según sea necesario

				return true; // Permite el envío del formulario si todas las validaciones pasan
			}
			
	</script>
	</script>
	<?php

	//include("../../menu_lateral_header.php");

	?>
</head>
<?php

///include("../../menu_lateral.php");

?>

<body>
	<div class="container">
		<form class="contenedor_popup" method="POST">
			<fieldset>
				<legend>Registrar NUEVO Medicamento 💉💊</legend>
				<fieldset class="caja">
					<legend class="cajalegend">══ Agregar Nuevo ══</legend>
					<label for="txtid">ID Medicamento</label>
					<input type="text" name="txtid" id="txtid" value="<?php echo $segid; ?>" required readonly>
					</br>
					<label for="txtmed">Nombre Medicamento</label>
					<input type="text" autofocus name="txtmed" id="txtseg" value="<?php echo $mednom; ?>" required><label for="txtmed"> (nombre comercial/casa farmacéutica)</label></br>
					</br>
					
					<label for="txtdesc">Descripcion</label>
					<textarea name="txtdesc" id="txtdesc" required><?php echo $meddesc; ?></textarea>
					<!-- <input type="text" name="txtdesc" id="txtdesc" value="<?php echo $meddesc; ?>" required> -->
					<label for="txtdesc">(componente o molécula/otros datos sobre producto)</label>
				</br>
				</br>
					<label for="txtform">Formato</label>
					<select name="txtform" id="txtform">
						<option value="Pastilla">Pastilla</option>
						<option value="Tableta">Tableta</option>
						<option value="Comprimido">Comprimido</option>
						<option value="Cápsula">Cápsula</option>
						<option value="Jarabe">Jarabe</option>
						<option value="Suspensión Oral">Suspensión Oral</option>
						<option value="Tableta Masticable">Tableta Masticable</option>
						<option value="Supositorio">Supositorio</option>
						<option value="Crema">Crema</option>
						<option value="Pomada">Pomada</option>
						<option value="Solución Inyectable">Solución Inyectable</option>
						<option value="Polvo para Reconstitución">Polvo para Reconstitución</option>
						<option value="Gotas Oftálmicas">Gotas Oftálmicas</option>
						<option value="Inhalador">Inhalador</option>
						<option value="Óvulo">Óvulo</option>
						<option value="Gel">Gel</option>
						<option value="Parche Transdérmico">Parche Transdérmico</option>
						<option value="Aerosol">Aerosol</option>
						<option value="Goma de Mascar Medicada">Goma de Mascar Medicada</option>
						<option value="Inyección Intravenosa (IV)">Inyección Intravenosa (IV)</option>
						<option value="Inyección Intramuscular (IM)">Inyección Intramuscular (IM)</option>
						<option value="Inyección Subcutánea (SC o Sub-Q)">Inyección Subcutánea (SC o Sub-Q)</option>
						<option value="Jeringa Precargada">Jeringa Precargada</option>
						<option value="Loción">Loción</option>
						<option value="Colirio">Colirio</option>
						<option value="Polvo">Polvo</option>
						<option value="Tableta">Tableta</option>
						<option value="Tintura">Tintura</option>
						<option value="Emulsión">Emulsión</option>
						<option value="Solución">Solución</option>
					</select>
					<!-- <input type="text" name="txtform" id="txtform" value="<?php echo $medform; ?>" required> -->
					</br>
					<label for="txtcant">Medida total</label>
					<input type="text" name="txtcant" id="txtcant" value="<?php echo $medcant; ?>" required>
					<label for="txtcant"> (medida en gramos, mililitros, onzas, etc.)</label>
					</br>
					<div class="botones-container">

						<button type="submit" name="btnregistrar" value="Registrar" onclick="return confirm('¿Deseas registrar a este *NUEVO* medicamento?');">
							<i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i> Registrar
						</button>


						<?php echo "<a class='boton' href=\"../../mant_medicamentos.php?pag=$pagina\"><i class='material-icons' style='font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;'  >close</i> Cancelar</a>"; ?>
					</div>
				</fieldset>

				<iframe id="modal-iframe" src="../../consulta_medicamento.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>


				<div class="botones-container">
					<a href="../../mant_medicamentos.php" class="boton"><i class="material-icons" style="font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;">arrow_back</i> Atrás</a>
					<a href="../../index.php" class="claseboton"><i class="material-icons" style="font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;">logout</i>Login</a>
					<a href="../../menu.php" class="claseboton"><i class="material-icons" style="font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;">menu</i>Menú Principal</a>

				</div>
			</fieldset>


		</form>
	</div>
</body>

</html>
<?php

// Inicializar variables para el formulario
$medid = '';
$mednom = '';
$meddesc = '';
$medform = '';
$medcant = '';

// Verificar si se envió el formulario
/*if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnregistrar'])) {
    // Validar y limpiar los datos del formulario
    $medid = htmlspecialchars($_POST['txtid']);
    $mednom = htmlspecialchars($_POST['txtmed']);
    $meddesc = htmlspecialchars($_POST['txtdesc']);
    $medform = htmlspecialchars($_POST['txtform']);
    $medcant = htmlspecialchars($_POST['txtcant']);

// Consulta preparada para la inserción
$insertQuery = "INSERT INTO medicamento (Id_medicamento, nombre_medicamento, descripcion, formato, Cantidad_total) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("isssi", $newId, $mednom, $meddesc, $medform, $medcant);

// Ejecutar la inserción
if ($stmt->execute()) {
	// Éxito al insertar
	echo "Inserción exitosa.";
} else {
	// Error al insertar
	echo "Error al insertar: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
}*/

function existeMedicamento($nombre, $conn)
{
	// Escapamos el nombre para evitar SQL injection
	$nombre = mysqli_real_escape_string($conn, $nombre);

	// Consultamos si ya existe un medicamento con ese nombre
	$query = "SELECT COUNT(*) AS cantidad FROM medicamento WHERE nombre_medicamento = '$nombre'";
	$result = $conn->query($query);

	if ($result && $result->num_rows > 0) {
		$row = $result->fetch_assoc();
		return $row['cantidad'] > 0;
	}

	return false;
}

// Uso de la función
$nombreMedicamento = $_POST['txtmed']; // Ajusta según tu formulario
if (existeMedicamento($nombreMedicamento, $conn)) {
	echo "<script>alert('Ya existe un medicamento con ese nombre. Por favor, elige otro o agrega otro detalle en el nombre.');</script>";
	exit;
} else {
	if (isset($_POST['btnregistrar'])) {
		$medid = htmlspecialchars($_POST['txtid']);
		$vaimed 	= $_POST['txtmed'];
		$vaides 	= $_POST['txtdesc'];
		$vaiform 	= $_POST['txtform'];
		$vaicant 	= $_POST['txtcant'];


		$queryadd	= mysqli_query($conn, "INSERT INTO medicamento(Id_medicamento,nombre_medicamento,descripcion,formato,Cantidad_total) VALUES('$medid ','$vaimed','$vaides','$vaiform','$vaicant')");

		if (!$queryadd) {
			echo "Error con el registro: " . mysqli_error($conn);
		} else {
			echo "<script>window.location= '../../mant_medicamentos.php?pag=1' </script>";
		}
	}
}
?>