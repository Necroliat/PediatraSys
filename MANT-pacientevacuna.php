<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Sis_Pediátrico</title>
	<link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
	<link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
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
			grid-template-columns: 60% 40%;
			/* Cambiado a una relación de 60/40 */
			grid-template-rows: repeat(2, 1fr);
			grid-gap: 6px 10px;
			margin-left: 2%;
			margin-right: 2%;
			padding: 0;
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
			margin-bottom: 6%;
			border: none;
			border-bottom: 0.1vw solid #444;
			outline: none;
			border-radius: 10px;

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
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.7);
		}

		.custom-modal-content {
			width: 80%;
			height: 80%;
			margin: auto;
			background: linear-gradient(to right, #e4e5dc, #45bac9db);
			padding: 20px;
			border-radius: 20px;

			/* Agregado para permitir desplazamiento si el contenido es demasiado grande */
			box-sizing: border-box;
			/* Asegura que el padding no afecte el tamaño total */
			font-size: 12px;
			/* Tamaño de fuente relativo al tamaño del contenedor */
			max-width: 100%;
			/* Evitar que el texto se salga del contenedor */
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

		body {
			background: linear-gradient(to right, #E8A9F7, #e4e5dc);
		}

		fieldset {
			background: linear-gradient(to right, #e4e5dc, #62c4f9);
		}

		#tabla_consultas th,
		#tabla_consultas td {
			max-width: 100px;
			/* Ancho máximo de las celdas */
			word-wrap: break-word;
			/* Permitir que el texto largo se divida en múltiples líneas */
		}
	</style>
	<?php

	//include("menu_lateral_header.php");

	?>

</head>
<?php

//include("menu_lateral.php");

?>

<body>
	<form>
		<div class="container" style="height: 750px;">
			<fieldset>
				<legend>Paciente-vacunas</legend>
				<fieldset class="caja">
					<legend class="cajalegend">══ Datos del Paciente ══</legend>
					<div>
						<label for="id_paciente">ID PACIENTE:</label>
						<input type="text" id="id_paciente" name="id_paciente" style="width: 115px;" onblur="cargarHistorialVacunas()" focus="cargarHistorialVacunas()" change="cargarHistorialVacunas()" required>
						<button id="buscarpaciente" class="boton_bus" title="Buscar pacientes registrados">
							<i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
						</button>
					</div>


					<!-- Agregar un event listener para el evento input      //oninput="cargarDatosPaciente()"-->
					<script>
						$("#id_paciente").on("input", function() {
							var idPaciente = $(this).val();
							// Realizar la solicitud AJAX para obtener los datos del paciente
							$.ajax({
								url: 'consulta_apellido_nombre_paciente.php', // Ruta al archivo PHP que creamos
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
						<label id="nombre_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
					</div>
					<div>
						<label for="Apellido_paciente">Apellido del paciente:</label>
						<label id="apellido_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
					</div>
					<!-- <div id="Modalpaciente" class="custom-modal">
					<div class="custom-modal-content" >
						<span class="close">&times;</span>
						<iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
					</div>
				</div> -->

					<div id="Modalpaciente" class="custom-modal">
						<div class="custom-modal-content">
							<span class="close">&times;</span>
							<iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
						</div>
					</div>


				</fieldset>



				<fieldset class="caja">
					<legend class="cajalegend">══ Datos de la Vacuna ══</legend>
					<div>
						<label for="id_vacuna">ID Vacuna:</label>
						<input type="text" id="id_vacuna" style="width: 115px;" required>
						<button id="buscarvacuna" class="boton_bus" title="Buscar vacunas registras en el sistema">
							<i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
						</button>
					</div>
					<div>
						<label for="Nombre_vacuna">Nombre de la Vacuna:</label>
						<label id="nombre_vacuna" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
					</div>


					<div id="Modalvacuna" class="custom-modal">
						<div class="custom-modal-content">
							<span class="close">&times;</span>
							<iframe id="modal-iframe" src="consulta_vacunas.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>

						</div>
					</div>



					<div style="border-top:20px;">
						<label for="dosis">Dosis:</label>
						<select id="dosis" style=" width: 110px; ">
							<option selected value="1era">1era</option>
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
							<option selected value="NA">NA</option>
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

					<!-- <button id="agregarVacuna" class="boton" onclick="agregarVacuna(); return false;">
					<i class="material-icons" style="font-size:32px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>
					Agregar
				</button> -->

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
				</fieldset>
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

			<fieldset>
				<legend>historico-vacunas</legend>
				<div id="historial_vacunas" style="font-size:14px;"></div>

			</fieldset>
			<div style=" margin-top:-20;padding:0; height:0cm;">
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
			<div id="error-message" style="color: red;"></div>
		</div>


		<script>
			var idPacienteActual = "";
			var cantidadFilasPadecimientos = 0;
			//▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓MODAL VACUNA▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒
			////////////////FIN FUNCIONES PARA EL MODAL DE VACUNA////////////////////
			//═════════════════════════════════════════════════════════
			// Obtener referencia al botón y al modal de vacuna
			const btnbusquedavacuna = document.getElementById("buscarvacuna");
			const modalvacuna = document.getElementById("Modalvacuna");
			// Función para mostrar el modal de vacuna
			function mostrarModalv() {
				modalvacuna.style.display = "block";
			}
			// Función para ocultar el modal vacuna
			function ocultarModalv() {
				modalvacuna.style.display = "none";
			}
			// Asignar evento de clic al botón para mostrar u ocultar el modal DE VACUNA y evitar recargar la página
			btnbusquedavacuna.addEventListener("click", function(event) {
				event.preventDefault(); // Evitar recargar la página
				if (modalvacuna.style.display === "none") {
					mostrarModalv();
				} else {
					ocultarModalv();
				}
			});
			//═════════════════════════════════════════════════════════
			//═════════════════════════════════════════════════════════
			function cargarHistorialVacunas() {
				var idPaciente = document.getElementById('id_paciente').value;
				var historialVacunasDiv = document.getElementById('historial_vacunas');

				if (idPaciente === '') {
					historialVacunasDiv.innerHTML = '<p>Historial de Vacunas no encontrado.</p>';
				} else {
					$.ajax({
						type: 'POST',
						url: 'consulta_paciente_vacuna.php',
						data: {
							id_paciente: idPaciente
						},
						success: function(data) {
							historialVacunasDiv.innerHTML = data;
						}
					});
				}
			}
			//═════════════════════════════════════════════════════════
			//═════════════════════════════════════════════════════════

			// Agregar evento oninput al elemento input
			document.getElementById('id_paciente').addEventListener('input', cargarHistorialVacunas);
			document.getElementById('id_paciente').addEventListener('change', cargarHistorialVacunas);
			document.getElementById('id_paciente').addEventListener('blur', cargarHistorialVacunas);

			function cargarHistorialVacunas() {
				var idPaciente = document.getElementById('id_paciente').value;
				var historialVacunasDiv = document.getElementById('historial_vacunas');

				if (idPaciente === '') {
					historialVacunasDiv.innerHTML = '<p>Historial de Vacunas no encontrado.</p>';
				} else {
					$.ajax({
						type: 'POST',
						url: 'consulta_paciente_vacuna.php',
						data: {
							id_paciente: idPaciente
						},
						success: function(data) {
							historialVacunasDiv.innerHTML = data;
						}
					});
				}
			}

			//═════════════════════════════════════════════════════════
			///////////////////////////////////////////////////////////
			//═════════════════════════════════════════════════════════





			//═════════════════════════════════════════════════════════
			//////////////////////////////////////////////////////////
			//═════════════════════════════════════════════════════════
			// Obtener referencia al botón y al modal del paciente
			const btnbusquedapaciente = document.getElementById("buscarpaciente");
			const modalpaciente = document.getElementById("Modalpaciente");
			// Función para mostrar el modal de vacuna
			function mostrarModalp() {
				modalpaciente.style.display = "block";
			}
			// Función para ocultar el modal vacuna
			function ocultarModalp() {
				modalpaciente.style.display = "none";
			}
			// Asignar evento de clic al botón para mostrar u ocultar el modal DE VACUNA y evitar recargar la página
			btnbusquedapaciente.addEventListener("click", function(event) {
				event.preventDefault(); // Evitar recargar la página
				if (modalpaciente.style.display === "none") {
					mostrarModalp();
				} else {
					ocultarModalp();
				}
			});
			//═════════════════════════════════════════════════════════




			// Variable global para almacenar el resultado de la verificación datos vacunas
			var tieneDatosVacuna = false;
			// Función para verificar si la tabla tiene filas (datos agregados)
			function verificarTabla() {
				var tabla = document.getElementById("vacunasTabla");
				var tbody = tabla.getElementsByTagName("tbody")[0];
				tieneDatosVacuna = tbody.hasChildNodes();
			}
			// Función para verificar y mostrar el input de **Fecha** al cargar la página
			function checkFechaProvista() {
				var fechaAplicacionSelect = document.getElementById('fecha_aplicacion_select');
				var fechaAplicacionInput = document.getElementById('fecha_aplicacion_input');

				if (fechaAplicacionSelect.value === 'fecha_provista') {
					fechaAplicacionInput.style.display = 'inline-block';
				} else {
					fechaAplicacionInput.style.display = 'none';
				}
			}

			// Función para establecer la **Fecha** de hoy por defecto
			function setFechaHoy() {
				var fechaAplicacionInput = document.getElementById('fecha_aplicacion_input');
				var today = new Date();
				var dd = String(today.getDate()).padStart(2, '0');
				var mm = String(today.getMonth() + 1).padStart(2, '0');
				var yyyy = today.getFullYear();

				var fechaHoy = yyyy + '-' + mm + '-' + dd;
				fechaAplicacionInput.value = fechaHoy;
			}

			// Llamada a las funciones REFERENTES A LAS FECHAS al cargar la página
			window.addEventListener('DOMContentLoaded', function() {
				checkFechaProvista();
				setFechaHoy();
			});

			// También puedes llamar a setFechaHoy() cuando se cambie la opción del select
			document.getElementById('fecha_aplicacion_select').addEventListener('change', setFechaHoy);

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
				checkFechaProvista();
				setFechaHoy();
			});

			// Agregar evento al botón Modificar (en el fieldset)
			modificarVacunaBtn.addEventListener('click', function(event) {
				event.preventDefault(); // Evitar la recarga de la página al hacer clic en Modificar
				guardarEdicion();
				checkFechaProvista();
				setFechaHoy();
			});

			// Agregar evento al botón Cancelar (en el fieldset)
			cancelarEdicionBtn.addEventListener('click', function(event) {
				event.preventDefault(); // Evitar la recarga de la página al hacer clic en Cancelar
				cancelarEdicion();
				checkFechaProvista();
				setFechaHoy();
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



			/////▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
			///▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓
			// Crear una instancia del observador después de que se hayan definido los elementos relevantes
			var tablaObserver = document.getElementById('vacunasTabla');
			var config = {
				childList: true,
				subtree: true
			};



			// Modificar la función de callback del observador
			var tablaCallback = function(mutationsList, observer) {
				for (var mutation of mutationsList) {
					if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
						var addedNodes = mutation.addedNodes;
						for (var i = 0; i < addedNodes.length; i++) {
							var addedNode = addedNodes[i];
							if (addedNode.nodeName === 'TR') {
								var nuevaFila = addedNode;
								var idVacunaNuevaFila = nuevaFila.cells[0].innerText;
								var dosisNuevaFila = nuevaFila.cells[2].innerText;
								var refuerzoNuevaFila = nuevaFila.cells[3].innerText;

								// Obtener los datos del historial de vacunas
								var historialVacunasDiv = document.getElementById('historial_vacunas');
								var historialFilas = historialVacunasDiv.getElementsByTagName('tr');

								var existeEnHistorial = false;

								// Verificar si la fila recién agregada coincide con algún registro en el historial
								for (var j = 0; j < historialFilas.length; j++) {
									var historialFila = historialFilas[j];
									var idVacunaHistorial = historialFila.cells[0].innerText;
									var dosisHistorial = historialFila.cells[2].innerText;
									var refuerzoHistorial = historialFila.cells[3].innerText;

									if (idVacunaNuevaFila === idVacunaHistorial && dosisNuevaFila === dosisHistorial && refuerzoNuevaFila === refuerzoHistorial) {
										existeEnHistorial = true;
										break;
									}
								}

								if (existeEnHistorial) {
									alert('Esta vacuna ya existe en el historial de vacunas.');
								}

								// Realiza otras acciones aquí si es necesario
							}
						}
					}
				}
			};


			var observer = new MutationObserver(tablaCallback);

			observer.observe(tablaObserver, config);

			/////▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓

			function verificarIdPacienteCompleto() {
				var idPaciente = document.getElementById('id_paciente').value;

				if (idPaciente === '') {
					alert('Por favor, complete el campo "id_paciente" antes de agregar una nueva vacuna.');
					return false;
				}

				return true;
			}
			///▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓

			function verificarVacunaExistente(nombre, dosis, refuerzo) {
				// Obtener la tabla y las filas
				var tabla = document.getElementById("vacunasTabla");
				var filas = tabla.getElementsByTagName("tr");

				// Iterar sobre las filas (comenzando desde 1 para omitir la fila de encabezado)
				for (var i = 1; i < filas.length; i++) {
					var celdas = filas[i].getElementsByTagName("td");

					// Obtener los valores de nombre, dosis y refuerzo de la fila actual
					var nombreActual = celdas[1].innerText;
					var dosisActual = celdas[2].innerText;
					var refuerzoActual = celdas[3].innerText;

					// Verificar si la combinación ya existe
					if (nombre === nombreActual && dosis === dosisActual && refuerzo === refuerzoActual) {
						return true; // La combinación ya existe
					}
				}

				return false; // La combinación no existe
			}




			// Función para agregar una vacuna
			function agregarVacuna() {
				// Verificar si la combinación ya existe en la tabla
				var nombre = nombreVacunaLabel.innerText;
				var dosis = dosisSelect.value;
				var refuerzo = refuerzoSelect.value;

				if (verificarVacunaExistente(nombre, dosis, refuerzo)) {
					alert('Esta combinación de nombre, dosis y refuerzo ya existe en la tabla.');
					return;
				}
				// Verificar si el campo "id_paciente" está completo
				if (!verificarIdPacienteCompleto()) {
					return; // Salir de la función si no está completo
				}

				// Restaurar estilo de los campos de entrada
				resetFieldsetStyle();

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

				// Verificar si la vacuna ya existe en el historial
				var existeEnHistorial = verificarExistenciaEnHistorial(idVacuna, dosis, refuerzo);

				if (existeEnHistorial) {
					alert('Esta vacuna ya existe en el historial de vacunas.');
				} else


				{
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

				idPacienteActual = $("#id_paciente").val();
				cantidadFilasPadecimientos = $("#vacunasTabla tbody tr").length;

			}

			///▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓

			// Función para verificar si la vacuna ya existe en el historial
			function verificarExistenciaEnHistorial(idVacuna, dosis, refuerzo) {
				// Obtener los datos del historial de vacunas
				var historialVacunasDiv = document.getElementById('historial_vacunas');
				var historialFilas = historialVacunasDiv.getElementsByTagName('tr');

				for (var i = 0; i < historialFilas.length; i++) {
					var historialFila = historialFilas[i];
					var idVacunaHistorial = historialFila.cells[0].innerText;
					var dosisHistorial = historialFila.cells[2].innerText;
					var refuerzoHistorial = historialFila.cells[3].innerText;

					if (idVacuna === idVacunaHistorial && dosis === dosisHistorial && refuerzo === refuerzoHistorial) {
						return true;
					}
				}

				return false;
			}



			///▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓


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
			///██▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓███
			///██▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓███

			function limpiarFormulario() {
				// Limpiar campos del formulario
				idVacunaInput.value = '';
				nombreVacunaLabel.innerText = '';
				dosisSelect.value = '1era';
				refuerzoSelect.value = '1era';
				fechaAplicacionSelect.value = 'fecha_provista';
				fechaAplicacionInput.style.display = 'none';
				fechaAplicacionInput.value = '';

				// Limpiar el campo id_paciente
				document.getElementById('id_paciente').value = '';

				// Limpiar el apellido del paciente
				document.getElementById('apellido_paciente').innerText = '';

				// Limpiar la tabla
				var tabla = document.getElementById("vacunasTabla");
				var filas = tabla.getElementsByTagName("tr");

				// Eliminar todas las filas (comenzando desde la última).
				for (var i = filas.length - 1; i > 0; i--) {
					tabla.deleteRow(i);
				}

				// Restablecer el arreglo de registros
				registros = [];

				// Restablecer otros elementos del paciente (agrega más según sea necesario)
				document.getElementById('nombre_paciente').innerText = '';
				document.getElementById('edad_paciente').innerText = '';
				// Agrega más líneas según sea necesario para otros elementos del paciente

				// Limpiar historial de vacunas
				document.getElementById('historial_vacunas').innerHTML = '';
			}

			function verificarCamposCompletos() {
				var idPaciente = document.getElementById('id_paciente').value;
				var tablaVacunas = document.getElementById('vacunasTabla');

				// Verificar el ID del paciente
				if (idPaciente.trim() === '') {
					alert('Campo ID del paciente está vacío. Por favor, complétalo.');
					document.getElementById('id_paciente').style.backgroundColor = 'red';
					return false;
				}

				// Verificar si la tabla de vacunas tiene datos
				if (tablaVacunas.rows.length <= 1) {
					alert('La tabla de vacunas está vacía. Por favor, agregue al menos una vacuna.');
					tablaVacunas.style.backgroundColor = 'red';
					return false;
				}

				// Restablecer estilos si todo está completo
				document.getElementById('id_paciente').style.backgroundColor = '';
				tablaVacunas.style.backgroundColor = '';

				return true;
			}


			function guardar() {
				// Obtener el valor del ID del paciente
				const id_paciente = document.getElementById("id_paciente").value;

				// Recopilar datos de la tabla de pacientes_vacunas
				const datosVacunas = [];
				const tablaVacunas = document.getElementById("vacunasTabla");
				const filasVacunas = tablaVacunas.getElementsByTagName("tr");
				for (let i = 1; i < filasVacunas.length; i++) {
					const filaVacuna = filasVacunas[i];
					const celdasVacuna = filaVacuna.getElementsByTagName("td");
					const id_vacuna = celdasVacuna[0].innerText;
					const dosis = celdasVacuna[2].innerText;
					const refuerzo = celdasVacuna[3].innerText;
					const fecha_aplicacion = celdasVacuna[4].innerText;
					datosVacunas.push({
						id_paciente,
						id_vacuna,
						dosis,
						refuerzo,
						fecha_aplicacion,
					});


				}

				// Hacer una petición AJAX a PHP para guardar los datos en la base de datos
				const xhr = new XMLHttpRequest();
				xhr.open("POST", "guardar_pacientes_vacunas.php", true);
				xhr.setRequestHeader("Content-Type", "application/json");
				xhr.onreadystatechange = function() {
					// Si hay un error al guardar los datos, mostrar el mensaje de error en el elemento "error-message"
					if (xhr.readyState === 4 && xhr.status === 200) {
						// Mostrar el mensaje de error en el elemento "error-message"
						const errorMessageDiv = document.getElementById("error-message");
						errorMessageDiv.textContent = "Notificación: " + xhr.responseText;
						errorMessageDiv.style.display = "block"; // Mostrar el elemento de error
						errorMessageDiv.style.color = "blue";
					} else if (xhr.readyState === 4 && xhr.status !== 200) {
						// Mostrar el mensaje de alerta
						alert("Error al guardar los datos. Por favor, intente nuevamente.");
					}
				};

				// Convertir el array de datos a formato JSON
				const datosJSON = JSON.stringify({
					pacientesVacunas: datosVacunas,
				});

				// Enviar la petición AJAX para guardar los datos
				xhr.send(datosJSON);
				limpiarFormulario();
			}

			// Asignar evento de clic al botón guardar
			document.getElementById("btnguardar").addEventListener("click", function(event) {
				event.preventDefault(); // Evitar que el formulario se envíe directamente

				// Verificar si los campos están completos
				if (verificarCamposCompletos()) {
					// Llamar a la función guardar solo si los campos están completos
					guardar();
				}
				//location.reload();
			});


			//////////////////////////////////////////
			//////////////////////////////////////
			///////////////////////////////////
			function limpiarTablaPadecimientos() {
				$("#vacunasTabla tbody").empty();
				cantidadFilasPadecimientos = 0;

			}

			document.getElementById('id_paciente').addEventListener('change', function() {
				// Verificar si hay un paciente actual y filas en la tabla
				if (idPacienteActual !== "" && cantidadFilasPadecimientos > 0) {
					// Pregunta al usuario si desea cambiar de paciente
					var respuesta = confirm('¿Desea cambiar de paciente?, al hacerlo se reiniciará el formulario');

					if (respuesta) {
						// Limpiar la tabla de padecimientos y actualizar el id del paciente actual
						limpiarTablaPadecimientos();
						idPacienteActual = this.value;
					} else {
						// Restaurar el valor anterior del input
						this.value = idPacienteActual;
					}
				} else {
					// Si no hay paciente actual o la tabla está vacía, simplemente actualizar el id del paciente actual
					idPacienteActual = this.value;
				}
				cargarHistorialVacunas();
			});
		</script>
	</form>
</body>

</html>