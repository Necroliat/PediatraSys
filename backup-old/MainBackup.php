<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Backup SysPedicatrico</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
			max-width: 380px;
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

		input[type="number"]:read-only {
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
		input[type="number"],
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
			width: 65%;
			margin-left: 10%;
			margin-top: 20px;
		}

		legend {
			font-weight: bold;
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 1vw;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			border: solid 1px #45bac9db;
			border-radius: 10px;
			margin-left: 20px;
			width: 30%;
		}
		.boton {
      border: none;
      outline: none;
      height: 15px;
      color: #fff;
      font-size: 14px;
      background: linear-gradient(to right, #4a90e2, #63b8ff);
      cursor: pointer;
      border-radius: 2vw;
     width: 380px;
      margin-top: 2vw;
      text-decoration: none;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      height: auto;
      min-height: 20px;
    }

    .boton:hover {
      scale: 1.1;
      background: linear-gradient(to right, #63b8ff, #4a90e2);
      box-shadow: 2px 2px 4px #000000;
      margin-right: 10px;
      margin-left: 10px;
    }
	</style>
</head>

<body>
	<?php
	include './Connet.php';
	?>
	<div class="botones-container" style="margin-top:0%;">

		<a href="./Backup.php" id="btnatras" class="btn btn-primary boton " style="width: 320px; font-size:small;vertical-align: baseline; font-weight:bold;"> 🕒💾Realizar copia de seguridad </a>
	</div>

	<fieldset>
		<legend>Módulo de Backup🕒💾💾</legend>
		<form action="./Restore.php" method="POST" style="width: 400px;">
			<label>Selecciona un punto de restauración</label><br>
			<select name="restorePoint">
				<option value="" disabled="" selected="">Selecciona un punto de restauración</option>
				<?php
				//$ruta = BACKUP_PATH;
				$ruta = "Backup";
				if (is_dir($ruta)) {
					if ($aux = opendir($ruta)) {
						while (($archivo = readdir($aux)) !== false) {
							if ($archivo != "." && $archivo != "..") {
								$nombrearchivo = str_replace(".sql", "", $archivo);
								$nombrearchivo = str_replace("-", ":", $nombrearchivo);
								$ruta_completa = $ruta . $archivo;
								if (is_dir($ruta_completa)) {
								} else {
									echo '<option value="' . $ruta_completa . '">' . $nombrearchivo . '</option>';
								}
							}
						}
						closedir($aux);
					}
				} else {
					echo $ruta . " No es ruta válida";
				}
				?>
			</select>
			<button type="submit">Restaurar</button>
		</form>
	</fieldset>
	<div style="width:100%; padding: 6px; width: 100%; display: flex; flex-direction: column; align-items: center;">

		<div class="botones-container" style="margin-top:0%;">

			<a href="../menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
				<i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atras
			</a>
		</div>
	</div>
</body>

</html>