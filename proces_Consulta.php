<?php
session_start();

error_reporting(E_ALL & ~E_WARNING);
require_once "include/conec.php";

// Consultar el último ID de la tabla consulta
$query = "SELECT MAX(id_consulta) AS max_id FROM consultas";
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
$idConsulta = $newId;


function obtenerDatosPaciente($idPaciente, $conn)
{
    $query = "SELECT nombre, apellido FROM paciente WHERE id_paciente = '$idPaciente'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $datosPaciente = array('nombre' => $row['nombre'], 'apellido' => $row['apellido']);
        return $datosPaciente;
    } else {
        // Si no se encuentra el paciente, devolver un array vacío
        return array();
    }
}


// Función para obtener el historial de consultas del paciente
function obtenerHistorialConsultas($idPaciente, $idMedico, $conn)
{
    // Consulta para obtener el historial de consultas del paciente con el médico específicos
    $query = "SELECT fecha, diagnostico, tratamiento 
              FROM consultas 
              WHERE id_paciente = '$idPaciente' AND id_medico = '$idMedico'";
    $result = $conn->query($query);

    // Inicializar un arreglo para almacenar el historial de consultas
    $historialConsultas = array();

    if ($result->num_rows > 0) {
        // Iterar sobre los resultados y agregarlos al arreglo de historialConsultas
        while ($row = $result->fetch_assoc()) {
            $historialConsultas[] = array(
                'fecha' => $row['fecha'],
                'diagnostico' => $row['diagnostico'],
                'tratamiento' => $row['tratamiento']
            );
        }
    } else {
        echo "ningún historial que presentar";
    }

    // Retornar el historial de consultas
    return $historialConsultas;
}
?>
<html>

<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
    <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .container {
            display: grid;
            grid-template-columns: 80%;
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 6px 10px;
            margin-left: 10%;
            margin-right: 10%;
        }

        .botones-container2 {
            margin: 2px;
            padding: 2px;
            box-sizing: unset;
            width: 100%;
            float: left;
            text-align: left;
            /*justify-content: center;*/
        }

        .botones-container {
            display: flex;
            flex-wrap: wrap;
            margin: 2px;
            padding: 2px;
            box-sizing: border-box;
            justify-content: left;
        }

        .botones-container>a,
        .botones-container>input[type="button"],
        .botones-container>input[type="submit"],
        .botones-container>button {
            margin: 5px;
            padding: 5px 5px;
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
            max-width: 200px;
            /* Establece el ancho máximo para mantener la responsividad */
            font-size: 1.2em;
        }

        .botones-container>a:hover,
        .botones-container>input[type="button"]:hover,
        .botones-container>input[type="submit"]:hover,
        .botones-container>button:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            align-content: space-between;
            gap: 10px;
            width: 55%;
            margin-bottom: 10px;

        }


        label {
            width: auto;
            text-align: left;
            margin-top: 15px;
            font-weight: bold;

        }


        input:read-only {
            background-color: #63b8ff;
            border: 2px solid #fff;
            width: 70px;

        }

        option {
            width: 75PX;
        }

        input,
        select {
            border: none;
            width: 30%;
            border-radius: 6px;
            padding: 5px;

        }


        .claseboton {
            border: none;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
            padding: 7px;

        }

        .claseboton:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        .botones-container {
            margin: 2px;
            padding: 2px;
            box-sizing: unset;
            width: 100%;
            float: left;
            text-align: center;
            /*justify-content: center;*/
        }

        fieldset {
            border: 1px solid #ddd;
            border-radius: 2vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            padding: 1vw;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin-bottom: 2vw;
        }


        .clasebotonVER {
            border: none;
            outline: none;
            background: linear-gradient(to right, #05c20e, #84e788);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #080808;
            font-size: 16px;
            padding: 7px;

        }

        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

        .dt-button.dtbotopersonal {
            border: none;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
            padding: 7px;
        }

        .dt-button.dtbotopersonal:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        fieldset fieldset legend {
            font-size: 20px;
            text-transform: uppercase;
            padding-left: 10%;
            padding-right: 10%;
            background-color: transparent;
        }

        legend {
            font-weight: bold;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 1vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            border: solid 1px #45bac9db;
            border-radius: 10px;
        }

        input[type="search"],
        select {
            /* Tus estilos personalizados aquí */
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            background-color: #f2f2f2;
            color: #333;
            width: 200px;
            /* Ancho personalizado */
        }

        .dataTables_filter input {
            color: white;
            background-color: red;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 170px;
            padding: 10px;
            font-size: 1vw;
            color: #444;
            margin-bottom: 2vw;
            border: none;
            border-bottom: 0.1vw solid #444;
            outline: none;
            border-radius: 15px;
            margin: 10px;
            background-color: white;

        }

        .dataTables_wrapper .dataTables_length,
        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_info {
            color: black;
            font-weight: bold;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            /*padding: 0.5em 1em;*/
            margin-left: 2px;
            text-align: center;
            /*text-decoration: none !important;*/
            cursor: pointer;
            color: #fff;
            border: 1px solid transparent;


            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            font-size: 16px;
            padding: 7px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;

            margin-left: 2px;
            text-align: center;

            cursor: pointer;
            color: #fff;
            border: 1px solid transparent;


            background: linear-gradient(to right, #63b8ff, #4a90e2);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            font-size: 16px;
            padding: 7px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

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


        /* .custom-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .custom-modal-content {
            opacity: 95% ;
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 20PX;
            width: 80%;
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
        } */

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
    </style>


    <style>
        /* Agrega algún estilo si lo deseas */

        input[type="password"] {
            padding-right: 30px;
            /* Ajusta el espacio para el ojo */
            transition: background-color 0.3s;
            /* Agrega una transición suave para el cambio de color */
        }

        .eye-icon {

            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        input[type="password"].visible {
            background-color: #87CEEB;
            /* Cambia a un color azul cielo cuando es visible */
        }

        body {
            background: linear-gradient(to right, #E8A9F7, #e4e5dc);
        }

        fieldset {
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
            text-align: left;
        }
    </style>

    <script type="text/javascript">
        // Obtener el campo de entrada y el nuevo ID
        var txtId = document.getElementById("txtid");
        var newId = <?php echo $userid; ?>;

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
            var input = document.getElementById("txtnom");

            if (obj.addEventListener) {
                obj.addEventListener("focus", placeCursorAtEnd, false);
            } else if (obj.attachEvent) {
                obj.attachEvent('onfocus', placeCursorAtEnd);
            }

            input.focus();
        }
    </script>
    <?php



    ?>
</head>
<?php



?>

<body>
    <div class="container">
        <form id="formulario_consulta">

            <!-- Encabezado de consulta -->
            <fieldset style="width: 60%; float: left;">
                <legend>Consulta de Pacientes</legend>
                <label for="id_consulta">ID Consulta:</label>
                <input type="text" id="id_consulta" name="id_consulta" value="<?php echo $idConsulta; ?>" readonly>

                <!-- Fieldset del paciente -->
                <fieldset>
                    <legend>Paciente</legend>
                    <input type="text" id="id_paciente" name="id_paciente" placeholder="ID Paciente">
                    <button type="button" onclick="mostrarModal()" class="boton_bus" title="Buscar pacientes registrados"><i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i></button><br>
                    <p style=" text-align:left"><label for="nombre_paciente1">Nombre:</label>
                        <label id="nombre_paciente" style="background-color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                        <label for="apellido_paciente1">Apellido:</label>
                        <label id="apellido_paciente" style="background-color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    </p>
                </fieldset>

                <div id="Modalpaciente" class="custom-modal">
                    <div class="custom-modal-content">

                        <span class="close" onclick="cerrarModal()"><span class="material-symbols-outlined">
                                cancel
                            </span></span>
                        <iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                    </div>
                </div>

                <script>
                    // Función para mostrar el modal
                    function mostrarModal() {
                        var modal = document.getElementById('Modalpaciente');
                        modal.style.display = 'block';
                    }

                    // Función para cerrar el modal
                    function cerrarModal() {
                        var modal = document.getElementById('Modalpaciente');
                        modal.style.display = 'none';
                    }

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
                                cargarHistorialConsultas();
                            },
                            error: function() {
                                alert('Hubo un error al obtener los datos del paciente.');
                            }
                        });
                    });
                </script>



                <!-- fin del Fieldset del paciente -->
                <!-- Fieldset del médico -->
                <fieldset>

                    <legend>Médico</legend>
                    <input type="text" id="id_medico" name="id_medico" placeholder="ID Médico" onchange="cargarHistorialConsultas()">

                    <!-- <button id="btnCargarHistorial" type="button" onclick="cargarHistorialConsultas()" class="" title="Buscar medicos registrados">Cargar</button> -->


                    <script>
                        function mostrarModal2() {
                            var modal = document.getElementById('Modalmedico');
                            modal.style.display = 'block';
                        }

                        // Función para cerrar el modal
                        function cerrarModal2() {
                            var modal = document.getElementById('Modalmedico');
                            modal.style.display = 'none';
                        }


                        $("#id_medico").on("input", function() {
                            var idmedico = $(this).val();
                            // Realizar la solicitud AJAX para obtener los datos del paciente
                            $.ajax({
                                url: 'consulta_apellido_nombre_medico.php', // Ruta al archivo PHP que creamos
                                type: 'POST',
                                data: {
                                    id_medico: idmedico
                                },
                                dataType: 'json',
                                success: function(data) {
                                    // Llamar a la función para cargar el historial de consultas
                                    //cargarHistorialConsultas();
                                    $("#nombre_medico").text(data.nombre || '');
                                    $("#apellido_medico").text(data.apellido || '');
                                    cargarHistorialConsultas();
                                },
                                error: function() {
                                    alert('Hubo un error al obtener los datos del medico.');
                                }
                            });
                        });
                    </script>
                    <button id="buscarmedico" type="button" onclick="buscarMedico()" class="boton_bus" title="Buscar medicos registrados"><i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i></button><br>
                    <label for="nombre_medico1">Nombre:</label>
                    <label id="nombre_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    <!-- <input type="text" id="nombre_medico" name="nombre_medico" readonly> -->
                    <label for="apellido_medico1">Apellido:</label>
                    <label id="apellido_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    <!-- <input type="text" id="apellido_medico" name="apellido_medico" readonly> -->

                    <div id="Modalmedico" class="custom-modal">
                        <div class="custom-modal-content">
                            <span class="close" onclick="cerrarModal2()">&times;</span>
                            <iframe id="modal-iframe" src="consulta_medico.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                        </div>
                    </div>



                </fieldset>



                <p><label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha">
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" name="hora">
                </p>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        cargarFechaHoraActual();
                    });

                    function cargarFechaHoraActual() {
                        var fechaInput = document.getElementById('fecha');
                        var horaInput = document.getElementById('hora');

                        var fechaActual = new Date();
                        var fechaFormateada = fechaActual.getFullYear() + '-' + ('0' + (fechaActual.getMonth() + 1)).slice(-2) + '-' + ('0' + fechaActual.getDate()).slice(-2);
                        var horaFormateada = ('0' + fechaActual.getHours()).slice(-2) + ':' + ('0' + fechaActual.getMinutes()).slice(-2);

                        fechaInput.value = fechaFormateada;
                        horaInput.value = horaFormateada;
                    }
                </script>

                <label for="diagnostico">Cuatro clínico/Diagnostico/Motivo consulta</label><br>
                <textarea id="diagnostico" name="diagnostico" rows="4" cols="50"></textarea><br>

                <label for="tratamiento">Tratamiento:</label><br>
                <textarea id="tratamiento" name="tratamiento" rows="4" cols="50"></textarea>

                <fieldset>
                    <legend>Detalle de Consulta</legend>
                    <!-- Input para el ID del trabajo médico -->
                    <input type="text" id="id_trabajo_medico" placeholder="ID del Trabajo Médico">
                    <!-- Label para la descripción -->
                    <label id="descripcion_trabajo_medico" style="background-color: #fffff1; padding: 8px; border-radius: 10px; box-shadow: 2px 2px 4px #000000;"></label>
                    <!-- Botón para agregar fila -->
                    <button type="button" onclick="mostrarModal3()" class="btn btn-primary boton"><i class="fa-solid fa-magnifying-glass"></i> buscar</button>
                    <button type="button" onclick="agregarFila()" class="btn btn-primary boton"><i class="fa-solid fa-circle-plus"></i> Agregar</button>


                    <div id="Modaltrabajomedico" class="custom-modal">
                        <div class="custom-modal-content">

                            <span class="close" onclick="cerrarModal3()"><span class="material-symbols-outlined">
                                    cancel
                                </span></span>
                            <iframe id="modal-iframe" src="consulta_trabajomedico.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                        </div>
                    </div>
                    <script>
                        function mostrarModal3() {
                            var modal = document.getElementById('Modaltrabajomedico');
                            modal.style.display = 'block';
                        }

                        // Función para cerrar el modal
                        function cerrarModal3() {
                            var modal = document.getElementById('Modaltrabajomedico');
                            modal.style.display = 'none';
                        }
                    </script>

                    <table id="tabla_detalle_consulta">
                        <thead>
                            <tr>
                                <th>ID Trabajo Médico</th>
                                <th>Descripción Trabajo Médico</th>
                                <th>Observación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se agregarán dinámicamente las filas -->
                        </tbody>
                    </table>
                </fieldset>

                <button type="submit" class="btn btn-primary boton"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>




            </fieldset>

            <!-- Historial de consultas -->
            <fieldset style="width: 40%; float: right;">
                <legend>Historial de Consultas</legend>
                <!--  <table id="historial_consultas"> -->
                <div id="historial_consultas" style="font-size:14px;"></div>
                <!-- Aquí se mostrará dinámicamente el historial de consultas -->
                </table>
                <script>
                    //▓▓▒░▓▒▓▓▓▒░▓// Función para cargar el historial de consultas//▓▓▒░▓▒▓▓▓▒░▓
                    function cargarHistorialConsultas() {
                        var idPaciente = document.getElementById('id_paciente').value;
                        var idDoctor = document.getElementById('id_medico').value;
                        var historialConsultasDiv = document.getElementById('historial_consultas');

                        if (idPaciente === '' || idDoctor === '') {
                            historialConsultasDiv.innerHTML = '<p>Historial de consultas no encontrado.</p>';
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: 'consulta_historial_consultas_pacientes.php',
                                data: {
                                    id_paciente: idPaciente,
                                    id_medico: idDoctor
                                },
                                success: function(data) {
                                    historialConsultasDiv.innerHTML = data;
                                },
                                error: function() {
                                    historialConsultasDiv.innerHTML = '<p>Error al cargar el historial de consultas.</p>';
                                }
                            });
                        }
                    }
                    //▓▓▒░FIN ▓▒▓▓▓▒░▓// Función para cargar el historial de 
                </script>
            </fieldset>

            <!-- Detalle de consulta -->

        </form>
        <div class="botones-container2">
            <a href="../../menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i>
                Menú Gnral
            </a>
            <a href="../../index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i>
                Login
            </a>
            <a href="../../mant-Agregaruser.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atrás
            </a>


        </div>

        <script>
            // Funciones JavaScript para la búsqueda de pacientes y médicos, y para agregar y eliminar filas en la tabla
            function buscarPaciente() {
                // Implementa la lógica para buscar un paciente y llenar los campos correspondientes
            }

            function buscarMedico() {
                // Implementa la lógica para buscar un médico y llenar los campos correspondientes
            }

            function agregarFila() {
                // Implementa la lógica para agregar una nueva fila a la tabla
            }

            function eliminarFila(idFila) {
                // Implementa la lógica para eliminar una fila de la tabla
            }
        </script>



        <script>
            var idmedicoActual = "";
            // Obtener referencia al botón y al modal del paciente
            const btnbusquedamedico = document.getElementById("buscarmedico");
            const modalmedico = document.getElementById("Modalmedico");
            // Función para mostrar el modal de vacuna
            function mostrarModalm() {
                modalmedico.style.display = "block";
            }
            // Función para ocultar el modal vacuna
            function ocultarModalm() {
                modalmedico.style.display = "none";
            }
            // Asignar evento de clic al botón para mostrar u ocultar el modal DE VACUNA y evitar recargar la página
            btnbusquedamedico.addEventListener("click", function(event) {
                event.preventDefault(); // Evitar recargar la página
                if (modalmedico.style.display === "none") {
                    mostrarModalm();
                } else {
                    ocultarModalm();
                }
            });

            var idpacienteActual = "";
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
        </script>



</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
    $vaiusu     = $_POST['txtnom'];
    $vaipass     = $_POST['txtpass1'];
    $vaiconf     = $_POST['txtconfi'];
    $vaiestado     = $_POST['txtest'];
    $vainomcom     = $_POST['txtnomcom'];
    $vairol     = $_POST['txtrol'];

    $queryadd    = mysqli_query($conn, "INSERT INTO usuario(id_usuario,nombre_usuario,pass1,confirm_pass,estado,nombre_completo,rol) VALUES('$userid','$vaiusu','$vaipass','$vaiconf','$vaiestado','$vainomcom','$vairol')");

    if (!$queryadd) {
        echo "Error con el registro: " . mysqli_error($conn);
        //echo "<script>alert('DNI duplicado, intenta otra vez');</script>";

    } else {
        echo "<script>window.location= '../../mant-Agregaruser.php?pag=1' </script>";
    }
}
?>