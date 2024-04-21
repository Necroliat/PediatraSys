<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Función para obtener el próximo ID de paciente
function obtenerProximoIdPaciente($conn)
{
	// Realizar la consulta SQL para obtener el próximo ID de paciente
	$query = "SELECT MAX(id_paciente) AS ultimoId FROM paciente";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$ultimoIdPaciente = $row['ultimoId'];

	// Si la tabla está vacía, asignamos el valor inicial de 1 al próximo ID de paciente
	if (empty($ultimoIdPaciente)) {
		$proximoIdPaciente = 1;
	} else {
		// Incrementar el último ID para obtener el próximo ID
		$proximoIdPaciente = $ultimoIdPaciente + 1;
	}

	return $proximoIdPaciente;
}

// Establecer la conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
	die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el próximo ID de paciente
$proximoIdPaciente = obtenerProximoIdPaciente($conn);

// Cerrar la conexión
mysqli_close($conn);
?>





<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Sis_Pediátrico</title>
	<link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<style>
		/* Agrega estilos para resaltar los campos incompletos */
		.campo-incompleto {
			border: 5px solid red;
			background-color: #ffdddd;
		}

		/* Estilo para el mensaje de error */
		#error-message {
			color: red;
			font-weight: bold;
			margin-bottom: 10px;

		}




		.campo-modificado {
			/*ESTILO PARA LA EDICION DE PADECIMIENTOS*/
			background-color: green;
			color: white;
		}

		.container {
			display: grid;
			grid-template-columns: repeat(2, 50%);
			grid-template-rows: repeat(3, 1fr);
			/* "1fr" representa una fracción del espacio disponible */
			grid-gap: 6px 10px;
		}

		fieldset {
			border: 1px solid #ddd;
			border-radius: 2vw;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			padding: 1vw;
			box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
			margin-bottom: 2vw;
		}

		fieldset fieldset {
			background-color: transparent;
		}

		fieldset fieldset legend {
			font-size: 16px;
			text-transform: uppercase;
			padding-left: 10%;
			padding-right: 10%;
			background-color: transparent;
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

		label {
			font-size: 14px;
			color: #444;
			margin: 8px;
			font-weight: bold;
		}

		button,
		input,
		optgroup,
		select,
		textarea {
			margin: 0;

			font-size: 12px;
			line-height: 14px;
			margin: 5%;
			padding-top: 5px;
			padding-bottom: 5px;
		}

		input[type="text"],
		input[type="date"],
		select {



			color: #444;
			margin-bottom: 6%;
			border: none;
			border-bottom: 0.1vw solid #444;
			outline: none;
			border-radius: 10px;
			margin: 10px;
		}

		button {
			border: none;
			outline: none;
			color: #fff;
			font-size: 1.6vw;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			padding: 10px;
			border-radius: 2vw;

			margin: 10px;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;
			min-height: 40px;
		}

		.boton {
			border: none;
			outline: none;
			height: 4vw;
			color: #fff;
			font-size: 14px;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			border-radius: 2vw;
			width: 110px;
			margin-top: 2vw;
			text-decoration: none;
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

		.claseboton {
			border: none;
			outline: none;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			border-radius: 30px;
			width: auto;
			text-decoration: none;
			height: 40px;
			color: #fff;
			font-size: 16px;
			padding-top: 2.5%;
			padding-bottom: 2%;
			padding-left: 5%;
			padding-right: 5%;
			font-size: 1.6vw;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;
			min-height: 40px;
			align-items: center;
		}

		.claseboton:hover {
			background: linear-gradient(to right, #63b8ff, #4a90e2);
		}

		input[type="submit"] {
			border: none;
			outline: none;
			height: 4vw;
			color: #fff;
			font-size: 1.6vw;
			background: linear-gradient(to right, #4a90e2, #63b8ff);
			cursor: pointer;
			border-radius: 2vw;
			width: 25%;
			margin-top: 2vw;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			height: auto;
			min-height: 40px;
		}

		input[type="submit"]:hover,
		button:hover {
			background: linear-gradient(to right, #63b8ff, #4a90e2);
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 1vw;
			text-align: left;
		}

		th {
			background-color: #f2f2f2;
		}

		td button {
			margin-right: 0.5vw;
			width: 65px;
			font-size: 12px;
		}

		@media (max-width: 800px) {
			.container {
				grid-template-columns: 100%;
				grid-gap: 20px;
			}
		}

		.error-banner {
			display: none;
			position: fixed;
			/* Hacer el banner de error fijo en la pantalla */
			top: 0;
			left: 0;
			width: 100%;
			background-color: #ff0000;
			color: #fff;
			padding: 10px;
			font-size: 16px;
			text-align: center;
			white-space: nowrap;
		}

		.error-banner p {
			display: inline;
			/* Hace que los mensajes de error aparezcan en línea */
			margin: 0;
			/* Elimina el margen entre los mensajes */
			padding-right: 10px;
			/* Agrega un espacio entre los mensajes (opcional) */
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
			height: 50%;
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

		.custom-modal-content p,
		table,
		th,
		td,
		tr {
			font-size: 1em;
			/* Tamaño de fuente relativo al tamaño del contenedor */
			max-width: 100%;
			/* Evitar que el texto se salga del contenedor */
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

		/*para las tablas de los fieldsets*/
		#fieldsetContainer {
			width: 100%;
			/* Ajusta el ancho del fieldset según tus necesidades */

			/* Márgenes para mejorar el aspecto visual */
			font-size: 16px;
			/* Tamaño de fuente inicial */
		}

		#tablaContainer {
			max-height: 100%;
			/* Altura máxima para el contenedor de la tabla, ajusta según tus necesidades */
			overflow-y: auto;
			/* Habilita la barra de desplazamiento vertical si la tabla es más grande que el contenedor */
		}

		#padecimientosTabla {
			margin-top: 10px;
			width: 100%;
			/* Hace que la tabla ocupe el 100% del contenedor */
			border-collapse: collapse;
		}

		table {
			margin-top: 10px;
			width: 100%;
			/* Hace que la tabla ocupe el 100% del contenedor */
			border-collapse: collapse;
		}

		th,
		td {
			border: 1px solid #ddd;
			/* Añade bordes a las celdas */
			padding: 8px;
			/* Espaciado interno */
			text-align: left;
			/* Alineación del texto */
		}

		#padecimientosTabla th,
		#padecimientosTabla td {
			border: 1px solid #ddd;
			/* Añade bordes a las celdas */
			padding: 8px;
			/* Espaciado interno */
			text-align: left;
			/* Alineación del texto */
		}

		body {
			background: linear-gradient(to right, #E8A9F7, #e4e5dc);
		}

		fieldset {
			background: linear-gradient(to right, #e4e5dc, #62c4f9);
		}

		input[type="text"]:read-only {
			background-color: rgb(115, 140, 136);
			color: #000;
			font-weight: bold;
			width: 65px;
		}

		.custom-modal-content p,
		table,
		th,
		td,
		tr {
			font-size: 10px;
			max-width: 100%;
		}
	</style>
	<script>
		document.getElementById('btnguardar').addEventListener('click', function() {
			var form = document.getElementById('myForm');
			form.classList.add('enviado');
			form.reportValidity();
		});
	</script>
	<?php

	//include("menu_lateral_header.php");

	?>

</head>



<body onload="checkFechaProvista()">

	<div id="error-banner" class="error-banner">
		Por favor, complete todos los campos obligatorios antes de guardar.
	</div>


	<form id="myForm" action="guardar_datos_paciente.php" method="post">

		<?php

		//include("menu_lateral.php");

		?>

		<div class="container">

			<fieldset>
				<legend>Datos del Paciente</legend>
				<DIV><label for="id_paciente">ID de Paciente:</label>
					<input type="text" id="id_paciente" style="width:115px; background-color:#979998 " name="id_paciente" value="<?php echo $proximoIdPaciente; ?>" readonly>
					<a class='btn btn-primary' href="mant-paciente.php"><i class='fa-solid fa-pencil'></i> Editar Pacientes</a>
				</DIV>

				<div>

					<label for="nombre">Nombre:</label>
					<input type="text" id="nombre" name="nombre" title="Ingrese su nombre" placeholder="Nombre del infante" required>
				</div>
				<div>
					<label for="apellido">Apellido:</label>
					<input type="text" id="apellido" name="apellido" title="Ingrese su apellido" placeholder="Apellido/s del/la niño/a" required>
				</div>
				<fieldset style="width:90%;">
					<legend>Sexo:</legend>
					<div style="width:35%;float:left; margin-left: 10%; padding: 1%;">
						<label for="masculino">Masculino</label>
						<input type="radio" id="masculino" name="sexo" value="masculino" required>
					</div>
					<div style="width:35%;float:left;padding: 1%;">
						<label for="femenino">Femenino</label>
						<input type="radio" id="femenino" name="sexo" value="femenino" required>
					</div>
				</fieldset>
				<div>
					<label for="fecha_nacimiento">Fecha de nacimiento:</label>
					<input type="date" id="fecha_nacimiento" name="fecha_nacimiento" title="Seleccione su fecha de nacimiento" required>
				</div>
				<!-- Select para países -->
				<div>
					<label for="pais">País:</label>
					<select id="pais" name="pais" title="Seleccione su país de origen" required>
						<option value="AF">Afganistán</option>
						<option value="AL">Albania</option>
						<option value="DE">Alemania</option>
						<option value="AD">Andorra</option>
						<option value="AO">Angola</option>
						<option value="AI">Anguilla</option>
						<option value="AQ">Antártida</option>
						<option value="AG">Antigua y Barbuda</option>
						<option value="AN">Antillas Holandesas</option>
						<option value="SA">Arabia Saudí</option>
						<option value="DZ">Argelia</option>
						<option value="AR">Argentina</option>
						<option value="AM">Armenia</option>
						<option value="AW">Aruba</option>
						<option value="AU">Australia</option>
						<option value="AT">Austria</option>
						<option value="AZ">Azerbaiyán</option>
						<option value="BS">Bahamas</option>
						<option value="BH">Bahrein</option>
						<option value="BD">Bangladesh</option>
						<option value="BB">Barbados</option>
						<option value="BE">Bélgica</option>
						<option value="BZ">Belice</option>
						<option value="BJ">Benin</option>
						<option value="BM">Bermudas</option>
						<option value="BY">Bielorrusia</option>
						<option value="MM">Birmania</option>
						<option value="BO">Bolivia</option>
						<option value="BA">Bosnia y Herzegovina</option>
						<option value="BW">Botswana</option>
						<option value="BR">Brasil</option>
						<option value="BN">Brunei</option>
						<option value="BG">Bulgaria</option>
						<option value="BF">Burkina Faso</option>
						<option value="BI">Burundi</option>
						<option value="BT">Bután</option>
						<option value="CV">Cabo Verde</option>
						<option value="KH">Camboya</option>
						<option value="CM">Camerún</option>
						<option value="CA">Canadá</option>
						<option value="TD">Chad</option>
						<option value="CL">Chile</option>
						<option value="CN">China</option>
						<option value="CY">Chipre</option>
						<option value="VA">Ciudad del Vaticano (Santa Sede)</option>
						<option value="CO">Colombia</option>
						<option value="KM">Comores</option>
						<option value="CG">Congo</option>
						<option value="CD">Congo, República Democrática del</option>
						<option value="KR">Corea</option>
						<option value="KP">Corea del Norte</option>
						<option value="CI">Costa de Marfíl</option>
						<option value="CR">Costa Rica</option>
						<option value="HR">Croacia (Hrvatska)</option>
						<option value="CU">Cuba</option>
						<option value="DK">Dinamarca</option>
						<option value="DJ">Djibouti</option>
						<option value="DM">Dominica</option>
						<option value="EC">Ecuador</option>
						<option value="EG">Egipto</option>
						<option value="SV">El Salvador</option>
						<option value="AE">Emiratos Árabes Unidos</option>
						<option value="ER">Eritrea</option>
						<option value="SI">Eslovenia</option>
						<option value="ES">España</option>
						<option value="US">Estados Unidos</option>
						<option value="EE">Estonia</option>
						<option value="ET">Etiopía</option>
						<option value="FJ">Fiji</option>
						<option value="PH">Filipinas</option>
						<option value="FI">Finlandia</option>
						<option value="FR">Francia</option>
						<option value="GA">Gabón</option>
						<option value="GM">Gambia</option>
						<option value="GE">Georgia</option>
						<option value="GH">Ghana</option>
						<option value="GI">Gibraltar</option>
						<option value="GD">Granada</option>
						<option value="GR">Grecia</option>
						<option value="GL">Groenlandia</option>
						<option value="GP">Guadalupe</option>
						<option value="GU">Guam</option>
						<option value="GT">Guatemala</option>
						<option value="GY">Guayana</option>
						<option value="GF">Guayana Francesa</option>
						<option value="GN">Guinea</option>
						<option value="GQ">Guinea Ecuatorial</option>
						<option value="GW">Guinea-Bissau</option>
						<option value="HT">Haití</option>
						<option value="HN">Honduras</option>
						<option value="HU">Hungría</option>
						<option value="IN">India</option>
						<option value="ID">Indonesia</option>
						<option value="IQ">Irak</option>
						<option value="IR">Irán</option>
						<option value="IE">Irlanda</option>
						<option value="BV">Isla Bouvet</option>
						<option value="CX">Isla de Christmas</option>
						<option value="IS">Islandia</option>
						<option value="KY">Islas Caimán</option>
						<option value="CK">Islas Cook</option>
						<option value="CC">Islas de Cocos o Keeling</option>
						<option value="FO">Islas Faroe</option>
						<option value="HM">Islas Heard y McDonald</option>
						<option value="FK">Islas Malvinas</option>
						<option value="MP">Islas Marianas del Norte</option>
						<option value="MH">Islas Marshall</option>
						<option value="UM">Islas menores de Estados Unidos</option>
						<option value="PW">Islas Palau</option>
						<option value="SB">Islas Salomón</option>
						<option value="SJ">Islas Svalbard y Jan Mayen</option>
						<option value="TK">Islas Tokelau</option>
						<option value="TC">Islas Turks y Caicos</option>
						<option value="VI">Islas Vírgenes (EEUU)</option>
						<option value="VG">Islas Vírgenes (Reino Unido)</option>
						<option value="WF">Islas Wallis y Futuna</option>
						<option value="IL">Israel</option>
						<option value="IT">Italia</option>
						<option value="JM">Jamaica</option>
						<option value="JP">Japón</option>
						<option value="JO">Jordania</option>
						<option value="KZ">Kazajistán</option>
						<option value="KE">Kenia</option>
						<option value="KG">Kirguizistán</option>
						<option value="KI">Kiribati</option>
						<option value="KW">Kuwait</option>
						<option value="LA">Laos</option>
						<option value="LS">Lesotho</option>
						<option value="LV">Letonia</option>
						<option value="LB">Líbano</option>
						<option value="LR">Liberia</option>
						<option value="LY">Libia</option>
						<option value="LI">Liechtenstein</option>
						<option value="LT">Lituania</option>
						<option value="LU">Luxemburgo</option>
						<option value="MK">Macedonia, Ex-República Yugoslava de</option>
						<option value="MG">Madagascar</option>
						<option value="MY">Malasia</option>
						<option value="MW">Malawi</option>
						<option value="MV">Maldivas</option>
						<option value="ML">Malí</option>
						<option value="MT">Malta</option>
						<option value="MA">Marruecos</option>
						<option value="MQ">Martinica</option>
						<option value="MU">Mauricio</option>
						<option value="MR">Mauritania</option>
						<option value="YT">Mayotte</option>
						<option value="MX">México</option>
						<option value="FM">Micronesia</option>
						<option value="MD">Moldavia</option>
						<option value="MC">Mónaco</option>
						<option value="MN">Mongolia</option>
						<option value="MS">Montserrat</option>
						<option value="MZ">Mozambique</option>
						<option value="NA">Namibia</option>
						<option value="NR">Nauru</option>
						<option value="NP">Nepal</option>
						<option value="NI">Nicaragua</option>
						<option value="NE">Níger</option>
						<option value="NG">Nigeria</option>
						<option value="NU">Niue</option>
						<option value="NF">Norfolk</option>
						<option value="NO">Noruega</option>
						<option value="NC">Nueva Caledonia</option>
						<option value="NZ">Nueva Zelanda</option>
						<option value="OM">Omán</option>
						<option value="NL">Países Bajos</option>
						<option value="PA">Panamá</option>
						<option value="PG">Papúa Nueva Guinea</option>
						<option value="PK">Paquistán</option>
						<option value="PY">Paraguay</option>
						<option value="PE">Perú</option>
						<option value="PN">Pitcairn</option>
						<option value="PF">Polinesia Francesa</option>
						<option value="PL">Polonia</option>
						<option value="PT">Portugal</option>
						<option value="PR">Puerto Rico</option>
						<option value="QA">Qatar</option>
						<option value="UK">Reino Unido</option>
						<option value="CF">República Centroafricana</option>
						<option value="CZ">República Checa</option>
						<option value="ZA">República de Sudáfrica</option>
						<option value="DO" selected>República Dominicana</option>
						<option value="SK">República Eslovaca</option>
						<option value="RE">Reunión</option>
						<option value="RW">Ruanda</option>
						<option value="RO">Rumania</option>
						<option value="RU">Rusia</option>
						<option value="EH">Sahara Occidental</option>
						<option value="KN">Saint Kitts y Nevis</option>
						<option value="WS">Samoa</option>
						<option value="AS">Samoa Americana</option>
						<option value="SM">San Marino</option>
						<option value="VC">San Vicente y Granadinas</option>
						<option value="SH">Santa Helena</option>
						<option value="LC">Santa Lucía</option>
						<option value="ST">Santo Tomé y Príncipe</option>
						<option value="SN">Senegal</option>
						<option value="SC">Seychelles</option>
						<option value="SL">Sierra Leona</option>
						<option value="SG">Singapur</option>
						<option value="SY">Siria</option>
						<option value="SO">Somalia</option>
						<option value="LK">Sri Lanka</option>
						<option value="PM">St Pierre y Miquelon</option>
						<option value="SZ">Suazilandia</option>
						<option value="SD">Sudán</option>
						<option value="SE">Suecia</option>
						<option value="CH">Suiza</option>
						<option value="SR">Surinam</option>
						<option value="TH">Tailandia</option>
						<option value="TW">Taiwán</option>
						<option value="TZ">Tanzania</option>
						<option value="TJ">Tayikistán</option>
						<option value="TF">Territorios franceses del Sur</option>
						<option value="TP">Timor Oriental</option>
						<option value="TG">Togo</option>
						<option value="TO">Tonga</option>
						<option value="TT">Trinidad y Tobago</option>
						<option value="TN">Túnez</option>
						<option value="TM">Turkmenistán</option>
						<option value="TR">Turquía</option>
						<option value="TV">Tuvalu</option>
						<option value="UA">Ucrania</option>
						<option value="UG">Uganda</option>
						<option value="UY">Uruguay</option>
						<option value="UZ">Uzbekistán</option>
						<option value="VU">Vanuatu</option>
						<option value="VE">Venezuela</option>
						<option value="VN">Vietnam</option>
						<option value="YE">Yemen</option>
						<option value="YU">Yugoslavia</option>
						<option value="ZM">Zambia</option>
						<option value="ZW">Zimbabue</option>
					</select>
				</div>
				<!-- Select para con quién vive -->
				<div>
					<label for="con_quien_vive">Con quién vive:</label>
					<select id="con_quien_vive" name="con_quien_vive" title="Seleccione con quién vive actualmente" required>
						<option value="padre_madre" selected>Ambos Padres</option>
						<option value="padre">Padre</option>
						<option value="madre">Madre</option>
						<option value="tutor_legal">Tutor Legal</option>
						<!-- Agregar más opciones si es necesario -->
					</select>
				</div>
				<div>
					<label for="direccion">Dirección:</label>
					<input type="text" id="direccion" name="direccion" title="Ingrese su dirección actual" placeholder="Dirección que reside el infante" required>
				</div>
				<script>
					// Definimos una variable global en JavaScript para el ID de paciente
					var globalIdPaciente = <?php echo $proximoIdPaciente; ?>;
				</script>
			</fieldset>

			<!--▓▓▓▓▓▓  (┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)  ▓▓▓▓▓▓ -->
			<!--▓▓▓▓▓▓  (┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)  ▓▓▓▓▓▓ -->
			<fieldset id="fieldsetContainer">
				<legend>Historia Clínica</legend>
				<label for="id_padecimiento">ID Padecimiento:</label>
				<input type="text" id="id_padecimiento" style="width:110px">
				<!-- <button id="busquedaHC" class="boton_bus"  title="Buscar Padecimientos/enfermedades registrados/as">
					<i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
				</button> -->
				<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalHistoriaClinica()"><i class="fa-solid fa-magnifying-glass"></i></button>

				<div>
					<label for="Nombre_padecimiento">Nombre del padecimiento:</label>
					<label id="nombre_padecimiento" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
				</div>
				<div id="ModalHistoriaClinica" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close" onclick="cerrarModalHistoriaClinica()"><span class="material-symbols-outlined">
								cancel
							</span></span>
						<iframe id="modal-iframe" src="consulta_padecimientos.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
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
				<!-- <div id="ModalHistoriaClinica" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close">&times;</span>
						<iframe id="modal-iframe" src="consulta_padecimientos.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>

					</div>
				</div> -->




				<label for="notas">Notas:</label>
				<input type="text" id="notas">
				<br>
				<label for="desde_cuando">Desde cuándo:</label>
				<input type="date" id="desde_cuando" onchange="calculateYears()"><br>
				<span id="yearsSince"></span>

				<button id="btnAgregarPadecimiento" type="button" class="btn btn-primary" style="width: 120px;vertical-align: baseline; font-weight:bold;">
					<i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i> Agregar
				</button>
				<!-- Botones adicionales para Modificar y Cancelar -->
				<button id="btnModificarPadecimiento" style="display: none;">Modificar</button>
				<button id="btnCancelarEdicion" style="display: none;">Cancelar</button>
				<div id="tablaContainer">
					<table id="padecimientosTabla" style="display: none; font: 9px;">
						<thead>
							<tr>
								<th>ID Padecimiento</th>
								<th>Nombre del Padecimiento</th>
								<th>Notas</th>
								<th>Desde cuándo</th>
								<th>Modificar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<script>
					function buscarNombrePadecimiento() {
						var idPadecimiento = $("#id_padecimiento").val();
						$.ajax({
							type: "POST",
							url: "buscar_padecimiento.php",
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
				</script>
				<input type="hidden" id="tieneDatosPadecimientos" name="tieneDatosPadecimientos" value="">
			</fieldset>
			<!--▓▓▓▓╰(*°▽°*)╯╰(*°▽°*)╯(^///^)╰(*°▽°*)╯╰(*°▽°*)╯╰(*°▽°*)╯▓▓▓▓▓▓▓▓ -->
			<!--▓▓▓▓╰(*°▽°*)╯╰(*°▽°*)╯(^///^)╰(*°▽°*)╯╰(*°▽°*)╯╰(*°▽°*)╯▓▓▓▓▓▓▓▓ -->
			<fieldset>
				<legend>Datos de Seguro del paciente</legend>
				<div>
					<label for="NSS">Número de Seguro:</label>
					<input type="text" id="NSS" namNombre dele="NSS" title="Ingrese el número de seguro" placeholder="Número de Seguro" required>
				</div>
				<div>
					<label for="Id_seguro_salud">ID Seguro de Salud:</label>
					<input type="text" id="Id_seguro_salud" name="Id_seguro_salud" title="Ingrese el ID del seguro de salud" placeholder="ID Seguro de Salud" oninput="buscarSeguro()" style="width:110px" required>
					<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalSeguros()"><i class="fa-solid fa-magnifying-glass"></i></button>
					<!-- <button id="busquedaseguro" class="boton_bus" title="Buscar aseguradoras de salud registradas registrados/as">
						<i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
					</button> -->
				</div>
				<div>
					<label for="Nombre_seguro">Nombre del Seguro:</label>
					<label id="Nombre_seguro"></label>
				</div>
				<br>
				<div id="ModalSeguros" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close" onclick="cerrarModalSeguros()"><span class="material-symbols-outlined">
								cancel
							</span></span>
						<iframe id="modal-iframe" src="consulta_seguros.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
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

				<!-- <div id="myModal" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close">&times;</span>
						<iframe id="modal-iframe" src="consulta_seguros.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
					</div>
				</div> -->
				<!-- Agrega un div para mostrar mensajes de error -->
				<!--<div id="error-message"></div> -->
			</fieldset>

			<!--(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁) -->
			<!--(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁) -->
			<fieldset>
				<legend>Paciente-vacunas</legend>
				<div>
					<label for="id_vacuna">ID Vacuna:</label>
					<input type="text" id="id_vacuna" style="width: 115px;">
					<button class="btn btn-primary " type="button" id="buscar_consulta" onclick="mostrarModalvacuna()"><i class="fa-solid fa-magnifying-glass"></i></button>
					<!-- <button id="buscarvacuna" class="boton_bus" title="Buscar en los Seguros registrados">
						<i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
					</button> -->
				</div>
				<div>
					<label for="Nombre_vacuna">Nombre de la Vacuna:</label>
					<label id="nombre_vacuna" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
				</div>
				<div id="Modalvacuna" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close" onclick="cerrarModalvacuna()"><span class="material-symbols-outlined">
								cancel
							</span></span>
						<iframe id="modal-iframe" src="consulta_vacunas.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
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

				<!-- <div id="Modalvacuna" class="custom-modal">
					<div class="custom-modal-content">
						<span class="close">&times;</span>
						<iframe id="modal-iframe" src="consulta_vacunas.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
					</div>
				</div> -->


				<div style="border-top:20px;">
					<label for="dosis">Dosis:</label>
					<select id="dosis" style=" width: 110px; ">
						<option value="1era">1era</option>
						<option value="2da">2da</option>
						<option value="3ra">3ra</option>
						<option value="4ta">4ta</option>
						<option value="5ta">5ta</option>
						<option value="6ta">6ta</option>
						<option value="7ma">7ma</option>
						<option value="8va">8va</option>
						<option value="9na">9na</option>
						<option value="10ma">10ma</option>
						<option value="NA">NA</option>
					</select>
				</div>
				<div>
					<label for="refuerzo">Refuerzo:</label>
					<select id="refuerzo" style=" width: 110px; ">
						<option value="1er">1era</option>
						<option value="2do">2da</option>
						<option value="3ro">3ra</option>
						<option value="4to">4ta</option>
						<option value="5to">5ta</option>
						<option value="6to">6ta</option>
						<option value="7mo">7ma</option>
						<option value="8vo">8va</option>
						<option value="9no">9na</option>
						<option value="10mo">10ma</option>
						<option value="NA">NA</option>
					</select>
				</div>
				<div>
					<label for="fecha_aplicacion">Fecha de Aplicación:</label>
					<select id="fecha_aplicacion_select" style="width: 180px;">
						<option value="fecha_provista">Fecha Provista</option>
						<option value="fecha_no_provista">Fecha No Provista</option>
					</select>
					<input type="date" id="fecha_aplicacion_input" style="display: none;">
				</div>
				<button id="agregarVacuna" onclick="agregarVacuna(); return false;" type="button" class="btn btn-primary" style="width: 120px;vertical-align: baseline; font-weight:bold;">
					<i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>
					Agregar
				</button>

				<button id="modificarVacuna" class="boton" style="display: none;">
					<i class="material-icons" style="font-size:32px;color:#f33112;text-shadow:2px 2px 4px #000000;">edit</i>
					Modificar
				</button>

				<button id="cancelarEdicion" class="boton" style="display: none;">
					<i class="material-icons" style="font-size:32px;color:#f33112;text-shadow:2px 2px 4px #000000;">cancel</i>
					Cancelar
				</button>
				<table id="vacunasTabla" style=" font-size: 14px;">
					<thead>
						<tr>
							<th>ID Vacuna</th>
							<th>Nombre de Vacuna</th>
							<th>Dosis</th>
							<th>Refuerzo</th>
							<th>Fecha de Aplicación</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>

				<script>
					// Función para búsqueda dinámica del nombre de la vacuna por ID
					function buscarNombreVacuna() {
						var idVacuna = $("#id_vacuna").val();
						$.ajax({
							url: "buscar_nombre_vacuna.php", // Archivo PHP para buscar el nombre de la vacuna por ID
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
			</fieldset>

			<!--(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁) -->
			<!--(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁)(❁´◡`❁) -->







			<div style="width: 100%;">
				<button class="boton" id="btnguardar">
					<i class="material-icons" style="font-size:32px;color:#f0f0f0;text-shadow:2px 2px 4px #000;">save</i> Guardar
				</button>
				<button class="boton" onclick="resetForm()" id="btnreset">
					<i class="material-icons" style="font-size:32px;color:#f0f0f0;text-shadow:2px 2px 4px #000;">autorenew</i> Reset
				</button>
				<a href="menu-pacientes.php" class="claseboton" id="btnatras">
					<i class="material-icons" style="font-size:32px;color:#f0f0f0;text-shadow:2px 2px 4px #000;">arrow_back</i> Atrás
				</a>
			</div>
			<!-- Agrega un div para mostrar mensajes de error -->
			<!-- <div id="error-message"></div>-->



		</div>
	</form>

	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒FUNCIONES DE HISTORIA CLINICA░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
		//✨✨✨búsqueda de la historia clínica✨✨✨//
		document.addEventListener("DOMContentLoaded", function() {
			// Obtener referencia al botón y al modal
			const btnBusquedaHC = document.getElementById("busquedaHC");
			const modalHC = document.getElementById("ModalHistoriaClinica");

			// Función para mostrar el modal
			function mostrarModal() {
				modalHC.style.display = "block";
			}

			// Función para ocultar el modal
			function ocultarModal() {
				modalHC.style.display = "none";
			}

			// Asignar evento de clic al botón para mostrar u ocultar el modal y evitar recargar la página
			btnBusquedaHC.addEventListener("click", function(event) {
				event.preventDefault(); // Evitar recargar la página
				if (modalHC.style.display === "none") {
					mostrarModal();
				} else {
					ocultarModal();
				}
			});

			// Asignar evento de clic al botón de cierre dentro del modal para ocultarlo
			modalHC.querySelector(".close").addEventListener("click", ocultarModal);

			// Evitar que el evento de clic en el contenido del modal cierre el modal
			modalHC.querySelector(".modal-content").addEventListener("click", function(event) {
				event.stopPropagation();
			});
		});
		//✨✨✨ fin búsqueda de la historia clínica✨✨✨//

		// Función para cambiar el estilo del fieldset de Historia Clínica
		function changeFieldsetStyle() {
			var fieldset = $("fieldset");
			var inputs = fieldset.find('input[type="text"], input[type="date"], select');
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].style.backgroundColor = 'blue';
				inputs[i].style.color = 'white';
			}
		}

		// Función para restaurar el estilo original del fieldset de Historia Clínica
		function restoreFieldsetStyle() {
			var fieldset = $("fieldset");
			var inputs = fieldset.find('input[type="text"], input[type="date"], select');
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].style.backgroundColor = '';
				inputs[i].style.color = '';
			}
			$("#btnModificarPadecimiento, #btnCancelarEdicion").hide();
		}

		// Función para ocultar el botón "Agregar"
		function hideAgregarButton() {
			$("#btnAgregarPadecimiento").hide();
		}

		// Función para mostrar el botón "Agregar"
		function showAgregarButton() {
			$("#btnAgregarPadecimiento").show();
		}

		function padecimientoExiste(idPadecimiento) {
			const ids = $("#padecimientosTabla tbody td:first-child").map(function() {
				return $(this).text();
			}).get();

			return ids.includes(idPadecimiento);
		}

		$(document).ready(function() {
			// Restaurar estilos del fieldset y ocultar botones "Modificar" y "Cancelar"
			restoreFieldsetStyle();

			// Función para agregar un nuevo padecimiento a la tabla
			function agregarPadecimiento() {
				const idPadecimiento = $("#id_padecimiento").val();
				const nombrePadecimiento = $("#nombre_padecimiento").text();
				let notas = $("#notas").val();
				const desdeCuando = $("#desde_cuando").val();
				// Verificar si el padecimiento ya existe en la tabla
				if (padecimientoExiste(idPadecimiento)) {
					alert("Este padecimiento ya está en la tabla. Inserta otro padecimiento.");
					return;
				}
				// Si notas está vacío, asignar un valor por defecto
				if (!notas.trim()) {
					notas = "ninguna nota/descripción";
				}

				if (idPadecimiento && desdeCuando) {
					const table = $("#padecimientosTabla");
					const tbody = table.find("tbody");
					const row = $("<tr>");

					row.html(`
            <td>${idPadecimiento}</td>
            <td>${nombrePadecimiento}</td>
            <td>${notas}</td>
            <td>${desdeCuando}</td>
            <td><button class="modificarPadecimiento">Modificar</button></td>
			<td><button class="eliminarPadecimiento eliminar">Eliminar</button></td>
            <!--td><button class="eliminarPadecimiento" onclick="confirm('¿Realmente desea eliminar este padecimiento?')">Eliminar</button></td>-->
        `);

					tbody.append(row);
					table.css("display", "table");
				}

				$("#id_padecimiento").val("");
				$("#nombre_padecimiento").text("");
				$("#notas").val("");
				$("#desde_cuando").val("");
				$("#yearsSince").text("");

				// Actualizar el valor del campo oculto tieneDatosPadecimientos
				// const tieneDatosPadecimientos = document.getElementById("padecimientosTabla").getElementsByTagName(
				// 	"tbody")[0].hasChildNodes();
				// document.getElementById("tieneDatosPadecimientos").value = tieneDatosPadecimientos;
				const tieneDatosPadecimientos = $("#padecimientosTabla tbody tr").length > 0;
				document.getElementById("tieneDatosPadecimientos").value = tieneDatosPadecimientos;

				// Limpiar los campos después de agregar el padecimiento
				$("#id_padecimiento").val("");
				$("#nombre_padecimiento").text("");
				$("#notas").val("");
				$("#desde_cuando").val("");
				$("#yearsSince").text("");

			}



			$("#btnAgregarPadecimiento").click(function() {
				const idPadecimiento = $("#id_padecimiento").val();
				const desdeCuando = $("#desde_cuando").val();

				// Validar que idPadecimiento no esté vacío y desdeCuando sea una fecha válida
				if (!idPadecimiento) {
					alert("Por favor, seleccione un padecimiento.");
					return false;
				}

				if (!isValidDate(desdeCuando)) {
					alert("Por favor, ingrese una fecha válida.");
					return false;
				}

				agregarPadecimiento();
				return false; // Evita el envío del formulario
			});

			// Función para validar si una cadena es una fecha válida
			function isValidDate(dateString) {
				const regexDate = /^\d{4}-\d{2}-\d{2}$/;
				return regexDate.test(dateString);
			}

			// Evento delegado para los botones "Eliminar" dentro de la tabla
			// Código de evento delegado para los botones "Eliminar", sin cambios

			// Evento delegado para los botones "Modificar" dentro de la tabla
			$("#padecimientosTabla").on("click", ".modificarPadecimiento", function(event) {
				event.preventDefault();
				// Lógica para modificar el padecimiento
				// Aquí puedes implementar la lógica para editar los datos del padecimiento
				// Por ejemplo, mostrar un modal con un formulario de edición

				// Aplicar estilos al fieldset y mostrar botones "Modificar" y "Cancelar"
				changeFieldsetStyle();
				$("#btnModificarPadecimiento, #btnCancelarEdicion").show();

				// Ocultar el botón "Agregar" mientras se realiza la modificación
				hideAgregarButton();

				// Obtener la fila actual y guardarla en una variable global para su posterior modificación
				filaActual = $(this).closest("tr");
				const idPadecimiento = filaActual.find("td:eq(0)").text();
				const nombrePadecimiento = filaActual.find("td:eq(1)").text();
				const notas = filaActual.find("td:eq(2)").text();
				const desdeCuando = filaActual.find("td:eq(3)").text();

				// Colocar los valores en los campos del fieldset
				$("#id_padecimiento").val(idPadecimiento);
				$("#nombre_padecimiento").text(nombrePadecimiento);
				$("#notas").val(notas);
				$("#desde_cuando").val(desdeCuando);
			});

			// Evento click del botón "Modificar"
			$("#btnModificarPadecimiento").click(function() {
				// Lógica para aplicar la modificación a la fila de la tabla
				const idPadecimiento = $("#id_padecimiento").val();
				const nombrePadecimiento = $("#nombre_padecimiento").text();
				const notas = $("#notas").val();
				const desdeCuando = $("#desde_cuando").val();

				// Actualizar los valores de la fila actual con los datos modificados
				filaActual.find("td:eq(0)").text(idPadecimiento);
				filaActual.find("td:eq(1)").text(nombrePadecimiento);
				filaActual.find("td:eq(2)").text(notas);
				filaActual.find("td:eq(3)").text(desdeCuando);

				// Restaurar estilos del fieldset y ocultar botones "Modificar" y "Cancelar"
				restoreFieldsetStyle();

				// Mostrar nuevamente el botón "Agregar"
				showAgregarButton();

				// Restaurar los valores originales en los campos del fieldset
				$("#id_padecimiento").val("");
				$("#nombre_padecimiento").text("");
				$("#notas").val("");
				$("#desde_cuando").val("");
				return false; // Evitar el envío del formulario
			});

			// Evento click del botón "Cancelar"
			$("#btnCancelarEdicion").click(function() {
				// Lógica para cancelar la edición y restaurar los valores originales
				// Puedes hacer aquí lo que necesites para cancelar la modificación
				event.preventDefault();
				// Restaurar estilos del fieldset y ocultar botones "Modificar" y "Cancelar"
				restoreFieldsetStyle();

				// Mostrar nuevamente el botón "Agregar"
				showAgregarButton();

				// Restaurar los valores originales en los campos del fieldset
				$("#id_padecimiento").val("");
				$("#nombre_padecimiento").text("");
				$("#notas").val("");
				$("#desde_cuando").val("");
				return false; // Evitar el envío del formulario
			});

			// Función para eliminar una fila al hacer clic en el botón "Eliminar"
			function eliminarFila(event) {
				// Obtener la fila correspondiente al botón clicado
				const fila = $(event.target).closest("tr");

				// Eliminar la fila
				fila.remove();
			}

			// Asignar un evento de clic a los botones "Eliminar"
			$("#padecimientosTabla").on("click", ".eliminar", eliminarFila);





		});

		function ajustarTamanoFuente() {
			const tablaContainer = document.getElementById('tablaContainer');
			const fuenteBase = 12; // Tamaño de fuente base
			const espacioDisponible = tablaContainer.clientHeight; // Altura disponible del contenedor

			// Ajustar la fuente según el espacio disponible
			const nuevoTamanoFuente = Math.min(fuenteBase, fuenteBase * (espacioDisponible /
				400)); // Ajusta según tus necesidades

			// Aplicar el nuevo tamaño de fuente a la tabla
			document.getElementById('padecimientosTabla').style.fontSize = `${nuevoTamanoFuente}px`;
		}
		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒ FIN DE FUNCIONES DE HISTORIA CLINICA░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓


		//╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬
		//╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬
		//╬╬FUNCIONES DEL BOTON MOFICAR DE LA TABLA AGREGAR --VACUNA A PACIENTE*///

		///////////MODAL DE VACUNA FUNCIONES////////////////////


		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓MODAL VACUNA▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒
		document.addEventListener("DOMContentLoaded", function() {
			// Obtener referencia al botón y al modal
			const btnBuscarVacuna = document.getElementById("buscarvacuna");
			const modalVacuna = document.getElementById("Modalvacuna");

			// Función para mostrar el modal
			function mostrarModal() {
				modalVacuna.style.display = "block";
			}

			// Función para ocultar el modal
			function ocultarModal() {
				modalVacuna.style.display = "none";
			}

			// Asignar evento de clic al botón para mostrar u ocultar el modal y evitar recargar la página
			btnBuscarVacuna.addEventListener("click", function(event) {
				event.preventDefault(); // Evitar recargar la página
				if (modalVacuna.style.display === "none") {
					mostrarModal();
				} else {
					ocultarModal();
				}
			});

			// Asignar evento de clic al botón de cierre dentro del modal para ocultarlo
			modalVacuna.querySelector(".close").addEventListener("click", ocultarModal);

			// Evitar que el evento de clic en el contenido del modal cierre el modal
			modalVacuna.querySelector(".modal-content").addEventListener("click", function(event) {
				event.stopPropagation();
			});
		});

		//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓MODAL VACUNA▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒
		////////////////FIN FUNCIONES PARA EL MODAL DE VACUNA////////////////////

		// Función para verificar y mostrar el input de fecha al cargar la página
		function checkFechaProvista() {
			var fechaAplicacionSelect = document.getElementById('fecha_aplicacion_select');
			var fechaAplicacionInput = document.getElementById('fecha_aplicacion_input');

			if (fechaAplicacionSelect.value === 'fecha_provista') {
				fechaAplicacionInput.style.display = 'inline-block';
			} else {
				fechaAplicacionInput.style.display = 'none';
			}
		}

		// Variables para mantener los registros
		var registros = [];

		// Obtener referencias a los elementos del DOM
		var idVacunaInput = document.getElementById('id_vacuna');
		var nombreVacunaLabel = document.getElementById('nombre_vacuna');
		var dosisSelect = document.getElementById('dosis');
		var refuerzoSelect = document.getElementById('refuerzo');
		var fechaAplicacionSelect = document.getElementById('fecha_aplicacion_select');
		var fechaAplicacionInput = document.getElementById('fecha_aplicacion_input');
		var vacunasTabla = document.getElementById('vacunasTabla').getElementsByTagName('tbody')[0];
		var agregarVacunaBtn = document.getElementById('agregarVacuna');
		var modificarVacunaBtn = document.getElementById('modificarVacuna');
		var cancelarEdicionBtn = document.getElementById('cancelarEdicion');

		// Agregar evento al botón Agregar
		agregarVacunaBtn.addEventListener('click', function(event) {
			event.preventDefault(); // Evitar la recarga de la página al hacer clic en Agregar
			agregarVacuna();
		});

		// Agregar evento al botón Modificar (en el fieldset)
		modificarVacunaBtn.addEventListener('click', function(event) {
			event.preventDefault(); // Evitar la recarga de la página al hacer clic en Modificar
			guardarEdicion();
		});

		// Agregar evento al botón Cancelar (en el fieldset)
		cancelarEdicionBtn.addEventListener('click', function(event) {
			event.preventDefault(); // Evitar la recarga de la página al hacer clic en Cancelar
			cancelarEdicion();
		});

		// Agregar evento para eliminar registros
		vacunasTabla.addEventListener('click', function(event) {
			if (event.target.classList.contains('eliminar')) {
				var fila = event.target.closest('tr');
				var index = fila.rowIndex - 1;
				registros.splice(index, 1);
				fila.remove();
			} else if (event.target.classList.contains('modificar')) {
				var fila = event.target.closest('tr');
				var index = fila.rowIndex - 1;
				var registro = registros[index];
				cargarFormularioEdicion(registro, index);
			}
		});

		// Agregar evento para cambiar el input de fecha según la opción seleccionada
		fechaAplicacionSelect.addEventListener('change', function() {
			if (fechaAplicacionSelect.value === 'fecha_provista') {
				fechaAplicacionInput.style.display = 'inline-block';
			} else {
				fechaAplicacionInput.style.display = 'none';
			}
		});

		// Función para agregar una vacuna
		function agregarVacuna() {
			// Restaurar estilo de los campos de entrada
			resetFieldsetStyle();

			// Obtener valores de los campos
			var idVacuna = idVacunaInput.value;
			var nombreVacuna = nombreVacunaLabel.innerText;
			var dosis = dosisSelect.value;
			var refuerzo = refuerzoSelect.value;
			var fechaAplicacion = fechaAplicacionSelect.value;
			if (fechaAplicacion === 'fecha_provista') {
				fechaAplicacion = fechaAplicacionInput.value;
			}

			// Verificar que los campos requeridos no estén vacíos antes de agregar la vacuna
			if (idVacuna.trim() === '' || fechaAplicacion.trim() === '') {
				alert('Debe completar los campos de ID de Vacuna y Fecha de Aplicación.');
				return;
			}

			// Crear objeto de vacuna
			var vacuna = {
				id: idVacuna,
				nombre: nombreVacuna,
				dosis: dosis,
				refuerzo: refuerzo,
				fechaAplicacion: fechaAplicacion
			};

			// Agregar vacuna al arreglo de registros
			registros.push(vacuna);

			// Agregar fila a la tabla
			var fila = vacunasTabla.insertRow();
			var idVacunaCell = fila.insertCell();
			var nombreVacunaCell = fila.insertCell();
			var dosisCell = fila.insertCell();
			var refuerzoCell = fila.insertCell();
			var fechaAplicacionCell = fila.insertCell();
			var modificarCell = fila.insertCell();
			var eliminarCell = fila.insertCell();

			idVacunaCell.innerHTML = idVacuna;
			nombreVacunaCell.innerHTML = nombreVacuna;
			dosisCell.innerHTML = dosis;
			refuerzoCell.innerHTML = refuerzo;
			fechaAplicacionCell.innerHTML = fechaAplicacion;
			modificarCell.innerHTML = '<button type="button" class="modificar">Modificar</button>';
			eliminarCell.innerHTML = '<button type="button" class="eliminar">Eliminar</button>';

			// Limpiar campos de entrada
			idVacunaInput.value = '';
			nombreVacunaLabel.innerText = '';
			dosisSelect.value = '1era';
			refuerzoSelect.value = '1era';
			fechaAplicacionSelect.value = 'fecha_provista';
			fechaAplicacionInput.style.display = 'none';
			fechaAplicacionInput.value = '';
		}

		// Función para cargar el formulario de edición
		function cargarFormularioEdicion(registro, index) {
			// Restaurar estilo de los campos de entrada
			resetFieldsetStyle();

			idVacunaInput.value = registro.id;
			nombreVacunaLabel.innerText = registro.nombre;
			dosisSelect.value = registro.dosis;
			refuerzoSelect.value = registro.refuerzo;
			fechaAplicacionSelect.value = registro.fechaAplicacion;
			if (registro.fechaAplicacion === 'fecha_provista') {
				fechaAplicacionInput.style.display = 'inline-block';
				fechaAplicacionInput.value = registro.fechaAplicacion;
			} else {
				fechaAplicacionInput.style.display = 'none';
			}

			agregarVacunaBtn.style.display = 'none';
			modificarVacunaBtn.style.display = 'block';
			cancelarEdicionBtn.style.display = 'block';

			// Cambiar el estilo de los campos al modo de edición
			changeFieldsetStyle();

			// Guardar el índice del registro en un atributo personalizado en el botón Modificar (en el fieldset)
			modificarVacunaBtn.setAttribute('data-index', index);
		}

		// Función para guardar la edición
		function guardarEdicion() {
			var index = parseInt(modificarVacunaBtn.getAttribute('data-index'));

			var idVacuna = idVacunaInput.value;
			var nombreVacuna = nombreVacunaLabel.innerText;
			var dosis = dosisSelect.value;
			var refuerzo = refuerzoSelect.value;
			var fechaAplicacion = fechaAplicacionSelect.value;
			if (fechaAplicacion === 'fecha_provista') {
				fechaAplicacion = fechaAplicacionInput.value;
			}

			// Actualizar el registro en el arreglo
			registros[index] = {
				id: idVacuna,
				nombre: nombreVacuna,
				dosis: dosis,
				refuerzo: refuerzo,
				fechaAplicacion: fechaAplicacion
			};

			// Actualizar los valores en la tabla
			var fila = vacunasTabla.rows[index];
			fila.cells[0].innerText = idVacuna;
			fila.cells[1].innerText = nombreVacuna;
			fila.cells[2].innerText = dosis;
			fila.cells[3].innerText = refuerzo;
			fila.cells[4].innerText = fechaAplicacion;

			// Restaurar formulario de edición
			resetForm();
			agregarVacunaBtn.style.display = 'block';
			modificarVacunaBtn.style.display = 'none';
			cancelarEdicionBtn.style.display = 'none';

			// Restaurar el estilo de los campos
			resetFieldsetStyle();
		}

		// Función para cancelar la edición
		function cancelarEdicion() {
			// Restaurar formulario de edición
			resetForm();
			agregarVacunaBtn.style.display = 'block';
			modificarVacunaBtn.style.display = 'none';
			cancelarEdicionBtn.style.display = 'none';

			// Restaurar el estilo de los campos
			resetFieldsetStyle();
		}

		// Función para resetear el formulario de edición
		function resetForm() {
			idVacunaInput.value = '';
			nombreVacunaLabel.innerText = '';
			dosisSelect.value = '1era';
			refuerzoSelect.value = '1era';
			fechaAplicacionSelect.value = 'fecha_provista';
			fechaAplicacionInput.style.display = 'none';
			fechaAplicacionInput.value = '';
		}

		// Función para cambiar el estilo de los campos de entrada al modo de edición
		function changeFieldsetStyle() {
			var inputs = document.querySelectorAll('input[type="text"], input[type="date"], select');
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].style.backgroundColor = 'blue';
				inputs[i].style.color = 'white';
			}
		}

		// Función para restaurar el estilo de los campos de entrada al modo original
		function resetFieldsetStyle() {
			var inputs = document.querySelectorAll('input[type="text"], input[type="date"], select');
			for (var i = 0; i < inputs.length; i++) {
				inputs[i].style.backgroundColor = '';
				inputs[i].style.color = '';
			}
		}








		//FIN DE FUNCIONES DEL BOTON MOFICAR DE LA TABLA AGREGAR VACUNA A PACIENTE*///
		//▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒
		//😎😎😎Funciones de Aseguradora de salud😁😁////
		//▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒▓▓▓▒
		///╬╬╬Botón con el id "busquedaseguro" y el nuevo modal con id "myModal"╬╬╬
		document.addEventListener("DOMContentLoaded", function() {
			// Obtener referencia al botón y al modal
			const btnBusquedaSeguro = document.getElementById("busquedaseguro");
			const modalSeguro = document.getElementById("myModal");

			// Función para mostrar el modal
			function mostrarModal() {
				modalSeguro.style.display = "block";
			}

			// Función para ocultar el modal
			function ocultarModal() {
				modalSeguro.style.display = "none";
			}

			// Asignar evento de clic al botón para mostrar u ocultar el modal y evitar recargar la página
			btnBusquedaSeguro.addEventListener("click", function(event) {
				event.preventDefault(); // Evitar recargar la página
				if (modalSeguro.style.display === "none") {
					mostrarModal();
				} else {
					ocultarModal();
				}
			});

			// Asignar evento de clic al botón de cierre dentro del modal para ocultarlo
			modalSeguro.querySelector(".close").addEventListener("click", ocultarModal);

			// Evitar que el evento de clic en el contenido del modal cierre el modal
			modalSeguro.querySelector(".modal-content").addEventListener("click", function(event) {
				event.stopPropagation();
			});

			document.addEventListener("dblclick", function(event) {
				// Verificar si el doble clic ocurrió dentro del modal
				if (event.target.closest('.modal-content')) {
					ocultarModal();
				}
			});
		});

		//╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬╬
		//Evento click celda del modal
		$(document).ready(function() {
			// Obtener la tabla generada por DataTables
			var tablaSeguros = $("#tabla_seguros").DataTable();


			// Asignar un evento de clic a las celdas de la tabla
			$("#tabla_seguros tbody").on("click", "td", function() {
				// Obtener la fila y las celdas de la tabla
				var fila = $(this).closest("tr");
				var celdas = fila.find("td");

				// Obtener los datos de la fila
				var idSeguro = celdas.eq(0).text();
				var nombreSeguro = celdas.eq(1).text();
				// ... Obtener los demás datos que necesites

				// Mostrar los datos en un alert
				alert("ID Seguro: " + idSeguro + "\nNombre Seguro: " + nombreSeguro);
			});
		});

		///Fin del Evento click del modal

		//funcion para busqueda dinamica seguro por text-change
		function buscarSeguro() {
			var idSeguro = $("#Id_seguro_salud").val();
			$.ajax({
				url: "buscar_seguro.php",
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
		// fin de  funcion para busqueda dinamica seguro por text-change
		function mostrarModal() {
			var idSeguro = $("#Id_seguro_salud").val();
			$.ajax({
				url: "obtener_datos_seguro.php",
				type: "POST",
				data: {
					id_seguro: idSeguro
				},
				dataType: "json",
				success: function(data) {
					$("#datos_seguro_table").remove();
					var table = $("<table>").attr("id", "datos_seguro_table").addClass("datos-seguro-table");
					var thead = $("<thead>").appendTo(table);
					var tbody = $("<tbody>").appendTo(table);
					var trHead = $("<tr>").appendTo(thead);
					$("<th>").text("ID Seguro de Salud").appendTo(trHead);
					$("<th>").text("Nombre del Seguro").appendTo(trHead);
					$.each(data, function(index, row) {
						var tr = $("<tr>").appendTo(tbody);
						$("<td>").text(row.Id_seguro_salud).appendTo(tr);
						$("<td>").text(row.Nombre).appendTo(tr);
					});
					table.insertAfter($("#Nombre_seguro"));
				},
				error: function(error) {
					console.log("Error:", error);
				}
			});
		}

		function resetForm() {
			document.getElementById("myForm").reset();
		}

		function calculateYears() {
			const fechaSeleccionada = document.getElementById("desde_cuando").value;
			const fechaActual = new Date();
			const diferencia = fechaActual.getFullYear() - new Date(fechaSeleccionada).getFullYear();
			document.getElementById("yearsSince").textContent = "Lleva padeciendo esta enfermedad durante " + diferencia +
				" años.";
		}

		///▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░
		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░


		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░
		///▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░
		// Variable global para almacenar el resultado de la verificación datos vacunas
		var tieneDatosVacuna = false;

		// Función para verificar si la tabla tiene filas (datos agregados)
		function verificarTabla() {
			var tabla = document.getElementById("vacunasTabla");
			var tbody = tabla.getElementsByTagName("tbody")[0];
			tieneDatosVacuna = tbody.hasChildNodes();
		}

		// Variable global para almacenar el resultado de la verificación datos padecimientos
		var tieneDatosPadecimientos = false;

		// Función para verificar si la tabla tiene filas (datos agregados)
		function verificarTablaPadecimientos() {
			var tabla = document.getElementById("padecimientosTabla");
			var tbody = tabla.getElementsByTagName("tbody")[0];
			tieneDatosPadecimientos = tbody.hasChildNodes();
		}

		// Llamar a la función para verificar inicialmente al cargar la página
		verificarTablaPadecimientos();

		///▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░
		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒
		function datosCompletos(campo) {
			if (campo.value.trim() === "") {
				campo.classList.add("campo-incompleto");
				campo.focus();
				return false;
			} else {
				campo.classList.remove("campo-incompleto");
				return true;
			}
		}

		// Función para validar el formato de la fecha (dd/mm/yyyy)
		function validarFecha(campo) {
			const regexFecha = /^\d{2}\/\d{2}\/\d{4}$/;
			return regexFecha.test(campo.value.trim());
		}

		// Función para validar los campos antes de guardar
		function validarCampos() {
			const campos = [{
					id: "nombre",
					label: "Nombre"
				},
				{
					id: "apellido",
					label: "Apellido"
				},
				{
					id: "fecha_nacimiento",
					label: "Fecha de nacimiento"
				},
				{
					id: "pais",
					label: "País"
				},
				{
					id: "con_quien_vive",
					label: "Con quien vive"
				},
				{
					id: "direccion",
					label: "Dirección"
				},
				{
					id: "NSS",
					label: "NSS"
				},
				{
					id: "Id_seguro_salud",
					label: "Seguro de salud"
				}
			];

			let formCompleto = true;
			const mensajeErrorDiv = document.getElementById("error-banner");
			mensajeErrorDiv.innerHTML = ""; // Limpiar mensajes de error anteriores
			mensajeErrorDiv.style.display = "none"; // Ocultar el banner de error por defecto

			campos.forEach(campo => {
				const inputCampo = document.getElementById(campo.id);
				const valor = inputCampo.value.trim();

				if (!valor) {
					formCompleto = false;
					inputCampo.classList.add("campo-incompleto");

					// Agregar mensaje de error al div
					const mensajeError = document.createElement("p");
					mensajeError.textContent = `El campo "${campo.label}" es obligatorio.`;
					mensajeErrorDiv.appendChild(mensajeError);
				} else if (campo.id === "fecha_nacimiento" && !esFechaValida(valor)) {
					formCompleto = false;
					inputCampo.classList.add("campo-incompleto");

					// Agregar mensaje de error al div
					const mensajeError = document.createElement("p");
					mensajeError.textContent =
						`El campo "Fecha de nacimiento" debe contener una fecha válida en formato dd/mm/yyyy.`;
					mensajeErrorDiv.appendChild(mensajeError);
				} else {
					inputCampo.classList.remove("campo-incompleto");
				}
			});

			// Verificar si el campo de seguro de salud tiene un valor válido en el label
			const labelNombreSeguro = document.getElementById("Nombre_seguro").textContent.trim();
			const idSeguroSalud = document.getElementById("Id_seguro_salud").value.trim();
			if (labelNombreSeguro === "" || labelNombreSeguro === "Dato no encontrado") {
				formCompleto = false;
				const inputSeguroSalud = document.getElementById("Id_seguro_salud");
				inputSeguroSalud.classList.add("campo-incompleto");

				// Agregar mensaje de error al div
				const mensajeError = document.createElement("p");
				mensajeError.textContent = `El campo "Seguro de salud" debe contener un ID de seguro válido.`;
				mensajeErrorDiv.appendChild(mensajeError);
			}

			if (!formCompleto) {
				// Mostrar el banner de error en la parte superior
				mensajeErrorDiv.style.display = "block";
			}

			return formCompleto;
		}

		function esFechaValida(fecha) {
			// Verificar si el valor ingresado es un número
			if (!isNaN(Date.parse(fecha))) {
				return true;
			}

			// Validar si el valor ingresado es una fecha válida en formato dd/mm/yyyy
			const regexFecha = /^(\d{1,2})\/(\d{1,2})\/(\d{2}|\d{4})$/;
			if (!regexFecha.test(fecha)) {
				return false;
			}

			// Verificar si es una fecha válida
			const partesFecha = fecha.split("/");
			const dia = parseInt(partesFecha[0]);
			const mes = parseInt(partesFecha[1]);
			let anio = parseInt(partesFecha[2]);

			// Determinar el siglo actual para años de dos dígitos
			const sigloActual = new Date().getFullYear().toString().slice(0, 2);
			anio = anio < 100 ? parseInt(sigloActual + anio) : anio;

			if (dia < 1 || dia > 31 || mes < 1 || mes > 12 || anio < 1900 || anio > 2100) {
				return false;
			}

			return true;
		}



		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒
		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒
		function guardar() {
			// Restaurar estilo de los campos
			const campos = document.querySelectorAll(".campo-incompleto");
			campos.forEach((campo) => campo.classList.remove("campo-incompleto"));

			// Validar campos antes de guardar
			const formCompleto = validarCampos();

			if (formCompleto) {
				// Obtener valores de los campos de paciente y seguro-paciente
				const nombre = document.getElementById("nombre").value;
				const apellido = document.getElementById("apellido").value;
				const masculino = document.getElementById("masculino").checked;
				const femenino = document.getElementById("femenino").checked;
				const fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
				const pais = document.getElementById("pais").value;
				const con_quien_vive = document.getElementById("con_quien_vive").value;
				const direccion = document.getElementById("direccion").value;
				const NSS = document.getElementById("NSS").value;
				const Id_seguro_salud = document.getElementById("Id_seguro_salud").value;

				// Recopilar datos de la tabla de padecimientos
				const datosPadecimientos = [];
				const tablaPadecimientos = document.getElementById("padecimientosTabla");
				const filasPadecimientos = tablaPadecimientos.getElementsByTagName("tr");
				for (let i = 1; i < filasPadecimientos.length; i++) {
					const filaPadecimiento = filasPadecimientos[i];
					const celdasPadecimiento = filaPadecimiento.getElementsByTagName("td");
					const id_padecimiento = celdasPadecimiento[0].innerText;
					const nombre_padecimiento = celdasPadecimiento[1].innerText;
					const notas = celdasPadecimiento[2].innerText;
					const desde_cuando = celdasPadecimiento[3].innerText;
					datosPadecimientos.push({
						id_padecimiento,
						nombre: nombre_padecimiento,
						notas,
						desde_cuando,
					});
				}

				// Recopilar datos de la tabla de pacientes_vacunas
				const datosVacunas = [];
				const tablaVacunas = document.getElementById("vacunasTabla");
				const filasVacunas = tablaVacunas.getElementsByTagName("tr");
				for (let i = 1; i < filasVacunas.length; i++) {
					const filaVacuna = filasVacunas[i];
					const celdasVacuna = filaVacuna.getElementsByTagName("td");
					const id_vacuna = celdasVacuna[0].innerText;
					const nombre_vacuna = celdasVacuna[1].innerText;
					const dosis = celdasVacuna[2].innerText;
					const refuerzo = celdasVacuna[3].innerText;
					const fecha_aplicacion = celdasVacuna[4].innerText;
					datosVacunas.push({
						id_vacuna,
						nombre_vacuna,
						dosis,
						refuerzo,
						fecha_aplicacion,
					});
				}

				// Hacer una petición AJAX a PHP para guardar los datos en la base de datos
				const xhr = new XMLHttpRequest();
				xhr.open("POST", "guardar_datos_paciente.php", true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function() {
					if (xhr.readyState === 4 && xhr.status === 200) {
						alert(xhr.responseText); // Mostrar el mensaje de éxito o error retornado desde PHP
					} else if (xhr.readyState === 4 && xhr.status !== 200) {
						alert("Error al guardar los datos. Por favor, intente nuevamente.");
					}
				};

				// Convertir el array de datos a formato JSON
				const datosJSON = JSON.stringify({
					nombre,
					apellido,
					sexo: masculino ? "masculino" : "femenino",
					fecha_nacimiento,
					pais,
					con_quien_vive,
					direccion,
					NSS,
					Id_seguro_salud,
					tieneDatosPadecimientos: datosPadecimientos.length > 0,
					historiaClinica: datosPadecimientos,
					tieneDatosVacunas: datosVacunas.length > 0,
					pacientesVacunas: datosVacunas,
				});

				// Enviar la petición AJAX para guardar los datos
				xhr.send(datosJSON);
			} else {
				// Si hay campos vacíos, mostramos un mensaje de error
				const mensajeErrorDiv = document.getElementById("error-message");
				mensajeErrorDiv.style.color = "red";
				mensajeErrorDiv.textContent = "Por favor, complete todos los campos obligatorios antes de guardar.";
			}
		}

		// Asignar evento de clic al botón guardar
		document.getElementById("btnguardar").addEventListener("click", function(event) {
			event.preventDefault(); // Evitar que el formulario se envíe directamente

			// Llamar a la función guardar()
			guardar();
			//location.reload();
		});


		////▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░▓▒░

		// Enviar la petición AJAX para guardar los datos
		//console.log(datosJSON); // Agregar esta línea para verificar los datos enviados al servidor
		//xhr.send(datosJSON);
	</script>
</body>

</html>