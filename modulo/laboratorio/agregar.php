<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
// Consultar el último ID de la tabla laboratorio
$query = "SELECT MAX(id_laboratorio) AS max_id FROM laboratorio";
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
$idLaboratorio = $newId;
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
    $camposRequeridos = ['txtid', 'txtnombre', 'txtdireccion', 'txttelefono', 'txtemail'];
    if (validarCampos($camposRequeridos)) {
        $idLaboratorio = $_POST['txtid'];
        $nombre = $_POST['txtnombre'];
        $direccion = $_POST['txtdireccion'];
        $telefono = $_POST['txttelefono'];
        $email = $_POST['txtemail'];
        // Insertar datos en la tabla laboratorio
        $queryAdd = mysqli_query($conn, "INSERT INTO laboratorio(id_laboratorio, nombre_laboratorio, Direccion, Telefono, email) VALUES('$idLaboratorio', '$nombre', '$direccion', '$telefono', '$email')");

        if (!$queryAdd) {
            echo "Error con el registro: " . mysqli_error($conn);
        } else {
            echo "<script>window.location= '../../mant_laboratorio.php?pag=1' </script>";
        }
    } else {
        echo "<script>alert('Por favor, complete todos los campos');</script>";
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
    <style>
        /* Estilos personalizados aquí */
    </style>
 <script>
        // Función para validar campos antes de enviar el formulario
        function validarFormulario() {
            var idLaboratorio = document.getElementById("txtid").value;
            var nombre = document.getElementById("txtnombre").value;
            var direccion = document.getElementById("txtdireccion").value;
            var telefono = document.getElementById("txttelefono").value;
            var email = document.getElementById("txtemail").value;

            if (idLaboratorio.trim() === '' || nombre.trim() === '' || direccion.trim() === '' || telefono.trim() === '' || email.trim() === '') {
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
<body>
    <div class="container">
	<fieldset style=" height:1000px;">
        <form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
                <legend>Registrar nuevo laboratorio</legend>
                <fieldset class="caja">
                    <legend class="cajalegend">══ Nuevo Laboratorio ══</legend>
                    <p style="margin:0;">
                        <label for="txtid">ID Laboratorio</label>
                        <input type="text" name="txtid" id="txtid" value="<?php echo $idLaboratorio; ?>" required readonly>
                    </p>
                    <p>
                        <label for="txtnombre">Nombre del Laboratorio</label>
                        <input type="text" autofocus name="txtnombre" id="txtnombre" value="<?php echo $nombre; ?>" required>
                    </p>
                    <p>
                        <label for="txtdireccion">Dirección</label>
                        <textarea name="txtdireccion" id="txtdireccion" required><?php echo $direccion; ?></textarea>
                    </p>
                    <p>
                        <label for="txttelefono">Teléfono</label>
                        <input type="text" name="txttelefono" id="txttelefono" value="<?php echo $telefono; ?>" required>
                    </p>
                    <p>
                        <label for="txtemail">Email</label>
                        <input type="email" name="txtemail" id="txtemail" value="<?php echo $email; ?>" required>
                    </p>
                </fieldset>
                <div class="botones-container">
                    <button type="submit" name="btnregistrar" value="Registrar">
                        <i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>
                        Registrar
                    </button>
                    <a class="boton" href="../../mant_laboratorio.php?pag=<?php echo $pagina; ?>">
                        <i class="material-icons" style='font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;'>close</i> Cancelar
                    </a>
                </div>
                <iframe id="modal-iframe" src="../../consulta_laboratorio.php" frameborder="0" style="width: 100%; height: 100%;max-height:700px;"></iframe>
            </fieldset>
        </form>
    </div>
</body>

</html>