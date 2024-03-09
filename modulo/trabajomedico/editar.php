<?php
session_start();


error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_trabajo_medico'];
//INSERT INTO `especialidad`(`id_trabajo_medico`, `nombre_especialidad`, `Direccion`, `Telefono`, `email`)

$querybuscar = mysqli_query($conn, "SELECT * FROM trabajos_medicos WHERE id_trabajo_medico=$coddni");
while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$idtrabajos = $mostrar['id_trabajo_medico'];
	$fechacreacion = $mostrar['fecha_creacion'];
	$descripcion = $mostrar['descripcion_trabajo_medico'];
	
}
?>


<?php

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
            var idtrabajos = document.getElementById("txtid").value;
            var fechacreacion = document.getElementById("txtfecha").value;
            var descripcion = document.getElementById("txtdescripcion").value;

            if (idtrabajos.trim() === '' || fechacreacion.trim() === '' || descripcion.trim() === ''  ) {
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

<?php
//include("../../menu_lateral_header.php");
?>
</head>
<?php
//include("../../menu_lateral.php");
?>
<body>
    <div class="container">
	<fieldset style=" height:1200px;">
        <form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
                <legend>✏️ Editando trabajos_medicos 🔬</legend>
                <fieldset class="caja">
                    <legend class="cajalegend">══ Modificando trabajos_medicos ══</legend>
                    <p style="margin:0;">
                        <label for="txtid">ID trabajos_medicos</label>
                        <input type="text" name="txtid" id="txtid" value="<?php echo $idtrabajos; ?>" required readonly>
                    </p>
                    <p>
                        <label for="txtnombre">fecha de creacion</label>
                        <input type="date" autofocus name="txtfecha" id="txtfecha" value="<?php echo $fechacreacion; ?>" required>
                    </p>
                    
					<p>
                        <label for="txtdescripcion">Descripción</label>
						<textarea name="txtdescripcion" id="txtdescripcion" required><?php echo $descripcion; ?></textarea>
                        <!-- <input type="text" name="txtdescripcion" id="txtdescripcion" value="<?php //echo $vacunades; 
                                                                                                    ?>" required> -->
                    </p>
                    
                </fieldset>
                <div class="botones-container">
				<button class="btn btn-primary boton" type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas Modificar este trabajo?');"> <i class="material-icons" style="font-size:21px;color:white;text-shadow:2px 2px 4px #000000;">edit</i> modificar</button>

                    <a class="boton" href="../../mant_trabajosmedicos.php?pag=<?php echo $pagina; ?>">
                        <i class="material-icons" style='font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;'>close</i> Cancelar
                    </a>
                </div>
                <iframe id="modal-iframe" src="../../consulta_trabajos.php" frameborder="0" style="width: 100%; height: 100%;max-height:800px;"></iframe>
            </fieldset>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['btnmodificar'])) {

    $idtrabajos = $_POST['txtid'];
	   $fechacreacion = $_POST['txtfecha'];
	   $descripcion = $_POST['txtdescripcion'];
	 
    $querymodificar = mysqli_query($conn, "UPDATE trabajos_medicos SET id_trabajo_medico='$idtrabajos',fecha_creacion='$fechacreacion', descripcion_trabajo_medico='$descripcion' WHERE id_trabajo_medico=$idtrabajos");
    echo "<script>window.location= '../../mant_trabajosmedicos.php?pag=$pagina' </script>";
}
?>