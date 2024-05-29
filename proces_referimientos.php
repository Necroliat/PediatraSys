<?php

session_start();

error_reporting(E_ALL & ~E_WARNING);
require_once "include/conec.php";

function generarNuevoNumeroReceta($conn)
{
    // Consultar el último ID de la tabla receta
    $query = "SELECT MAX(ID_Referimiento) AS max_id FROM referimientos";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastId = $row["max_id"];
        $newId = $lastId + 1;
    } else {
        // Si no hay registros en la tabla, asignar el ID inicial
        $newId = 1;
    }

    // Retornar el nuevo ID de receta
    return $newId;
}

// Llamada a la función para obtener el nuevo número de receta
$nuevoNumeroreferimiento = generarNuevoNumeroReceta($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_Referimiento = $_POST['ID_Referimiento'];
    $id_centro = $_POST['id_centro'];
    $id_paciente = $_POST['id_paciente'];
    $id_medico = $_POST['id_medico'];
    $medico_referido = $_POST['medicoref'];
    $motivo = $_POST['Motivo'];
    $observaciones = $_POST['Observaciones'];
    $fecha_referimiento = date("Y-m-d"); //

    // Prepara la sentencia SQL para insertar
    $stmt = $conn->prepare("INSERT INTO referimientos (ID_Referimiento, medico_referido, Fecha_Referimiento, Motivo, Observaciones, id_centro, id_medico, id_paciente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssiis", $ID_Referimiento, $medico_referido, $fecha_referimiento, $motivo, $observaciones, $id_centro, $id_medico, $id_paciente);

    // Ejecutar la sentencia
    if ($stmt->execute()) {
        $last_id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        // Redireccionar a la página de reporte con TCPDF
        header("Location: reporteReferimiento.php?ID_Referimiento=" . $ID_Referimiento); // Corregido aquí
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }
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
            grid-template-columns: 100%;
            grid-template-rows: repeat(2, 1fr);
            grid-gap: 6px 10px;
            margin-left: 00%;
            margin-right: 00%;
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
            font-size: 14;
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
            font-size: 14;
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
            margin-bottom: 10px;
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
            font-size: 14;
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
            font-size: 14;
            padding: 7px;
        }

        .dt-button.dtbotopersonal:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
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
            font-size: 14;
            color: #000000;
            margin-bottom: 2vw;
            border: none;
            border-bottom: 0.1vw solid #000000;
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
            font-size: 14;
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
            font-size: 14;
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
            font-size: 14;
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
            font-size: 14;
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
            font-size: 14;
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
            font-size: 14;
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

        .resaltado {
            background-color: #A8A4DE;
        }

        #tabla_detalle_consulta {
            width: 100%;
            border-collapse: collapse;
        }

        #tabla_detalle_consulta th,
        #tabla_detalle_consulta td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #tabla_detalle_consulta th {
            background-color: #f2f2f2;
        }

        #tabla_detalle_consulta tbody tr:hover {
            background-color: #f2f2f2;
        }

        #tabla_detalle_consulta .resaltado {
            background-color: #ffc107 !important;
            /* Cambiar el color de fondo resaltado */
        }

        #tabla_detalle button {
            padding: 6px 10px;
            border: none;
            background-color: #dc3545;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        #tabla_detalle button:hover {
            background-color: #c82333;
        }

        /* Resaltar la fila al hacer clic en ella */
        #tabla_detalle tbody tr.resaltado {
            background-color: #A8A4DE;
            /* Cambia el color de fondo como prefieras */
        }

        /* Resaltar la fila al pasar el mouse sobre ella */
        #tabla_detalle tbody tr.resaltado-hover {
            background-color: #E0E0E0;
            /* Cambia el color de fondo como prefieras */
        }

        #tabla_detalle tbody tr.nueva-fila {
            background-color: yellow;
            /* Estilo de resaltado */
        }

        #id_receta,
        #id_consulta,
        #id_centro,
        #id_medicamento,
        #cantidad,
        #tiempo_uso,
        #id_paciente {
            width: 55px;
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

        #tabla_detalle th {
            background-color: #ddd;
            border: 1px solid WHITE;
            padding: 8px;
            /* Espaciado interno */
            text-align: left;
        }

        #tabla_detalle td {
            border: 1px solid #ddd;
            /* Añade bordes a las celdas */
            padding: 8px;
            /* Espaciado interno */
            text-align: left;
           
            /* Alineación del texto */
        }

        #tabla_detalle tr:hover {
            background-color: rgb(181, 144, 208, 0.6);
        }

    </style>

   
    
</head>


<body style="font-size:14;">
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Encabezado de la Certificado Médico -->
            <fieldset>
                <legend> <h4 style=' text-transform: uppercase;text-align: center;'><i class="fa-solid fa-file-medical"></i>&nbsp;&nbsp;Realizar Referimiento Médico &nbsp;<b style="color:#c549ee;"><i class="fa-solid fa-user-doctor"></i></b><b style="color:green;"><i class="fa-solid fa-right-left"></i></b><b style="color:blue;"><i class="fa-solid fa-user-doctor"></i></b> </h4></legend>
                <!-- ID Certificado Médico -->
                <label for="ID_Referimiento">ID Referimiento</label>
                <input type="text" id="ID_Referimiento" name="ID_Referimiento" value="<?php echo $nuevoNumeroreferimiento; ?>" readonly>
                <!-- ID Centro -->
                <hr>
                <label for="id_centro">ID Centro</label>
                <input type="text" id="id_centro" name="id_centro" required>
                <button class="btn btn-primary " type="button" id="buscar_centro" onclick="mostrarModal2()"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div id="ModalCENTRO" class="custom-modal">
                    <div class="custom-modal-content">
                        <span class="close" onclick="cerrarModal2()"><span class="material-symbols-outlined">
                                cancel
                            </span></span>
                        <iframe id="modal-iframe" src="consulta_centromedicoX.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                    </div>
                </div>
                <label id="nombre" style=" background-Color:#fffff1;padding:5px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                <hr>
                <div>
                    <label for="id_paciente">ID PACIENTE:</label>
                    <input type="text" id="id_paciente" name="id_paciente" style="width: 55px;" required>
                    <button class="btn btn-primary " type="button" id="buscar_paciente" onclick="mostrarModalpaciente()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <div id="Modalpaciente" class="custom-modal">
                        <div class="custom-modal-content">
                            <span class="close" onclick="cerrarModalpaciente()"><span class="material-symbols-outlined">
                                    cancel
                                </span></span>
                            <iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                        </div>
                    </div>
                    <label id="nombre_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    <label id="apellido_paciente" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    <span style="padding:25px">.</span>
                    <label for="id_medico"> ID MÉDICO:</label>
                    <input type="text" id="id_medico" name="id_medico" style="width: 55px;" required>
                    <button class="btn btn-primary " type="button" id="buscar_medico" onclick="mostrarModalmedico()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <div id="Modalmedico" class="custom-modal">
                        <div class="custom-modal-content">
                            <span class="close" onclick="cerrarModalmedico()"><span class="material-symbols-outlined">
                                    cancel
                                </span></span>
                            <iframe id="modal-iframe" src="consulta_medico2.php" frameborder="0" style="width: 100%; height: 50%;"></iframe>
                        </div>
                    </div>
                    <label id="nombre_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    <label id="apellido_medico" style=" background-Color:#fffff1;padding:8px; border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                </div>
                <div>
                <label for="medicoref">Médico al que refiere:</label><br>
                <input type="text" id="medicoref" name="medicoref"  required><br>
                <label for="Motivo">Motivo:</label><br>
                <textarea id="Motivo" name="Motivo" rows="4" cols="50" required></textarea><br>
                <label for="Observaciones">Observaciones:</label><br>
                <textarea id="Observaciones" name="Observaciones" rows="4" cols="50"></textarea>
                </div><br>
                <button type="submit" class="btn btn-primary "><i class="fa-solid fa-floppy-disk"></i>Guardar e <i class="fa-solid fa-print"></i>Imprimir</button>
            </fieldset>
        </form>
        <script>
                    // Función para mostrar el modal
                    function mostrarModal2() {
                        var modal = document.getElementById('ModalCENTRO');
                        modal.style.display = 'block';
                    }

                    // Función para cerrar el modal
                    function cerrarModal2() {
                        var modal = document.getElementById('ModalCENTRO');
                        modal.style.display = 'none';
                    }
                </script>
        <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var checkbox = document.getElementById("id_centro_na");
                        var nombreLabel = document.getElementById("nombre");

                        checkbox.addEventListener("change", function() {
                            if (checkbox.checked) {
                                nombreLabel.textContent = "";
                            }
                        });
                    });
                </script>
                <script>
                    $("#id_centro").on("input", function() {
                        var idcentro = $(this).val();
                        // Realizar la solicitud AJAX para obtener los datos del medicamento
                        $.ajax({
                            url: 'consulta_centromedico_Simple.php', // Ruta al archivo PHP adaptado para medicamento
                            type: 'POST',
                            data: {
                                id_centro: idcentro
                            },
                            dataType: 'json',
                            success: function(data) {
                                $("#nombre").text(data.nombre || '');
                                //  $("#descripcion_medicamento").text(data.descripcion || '');
                            },
                            error: function() {
                                alert('Hubo un error al obtener los datos del medicamento.');
                            }
                        });
                    });
                </script>

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

        <script>
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
                                    $("#nombre_medico").text(data.nombre || '');
                                    $("#apellido_medico").text(data.apellido || '');
                                },
                                error: function() {
                                    alert('Hubo un error al obtener los datos del medico.');
                                }
                            });
                        });
                    </script>





        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Obtener todos los elementos <input type="number">
                var inputsNumber = document.querySelectorAll("input[type=number]");

                // Iterar sobre cada elemento y agregar un evento input
                inputsNumber.forEach(function(input) {
                    input.addEventListener("input", function() {
                        // Obtener el valor actual del input como un número
                        var valor = parseFloat(this.value);

                        // Verificar si el valor es menor que cero
                        if (valor < 0) {
                            // Si es menor que cero, establecer el valor del input como cero
                            this.value = 0;
                        }
                    });
                });
            });







            function gestionarCheckBox(idCheckbox, idInput, idBoton) {
                const checkbox = document.getElementById(idCheckbox);
                const input = document.getElementById(idInput);
                const boton = document.getElementById(idBoton);

                // Función para actualizar el estado de los campos según el estado del checkbox
                function actualizarCampos() {
                    if (checkbox.checked) {
                        input.value = 'na'; // Establecer el valor 'na' en el input
                        input.setAttribute('readonly', 'true'); // Establecer el atributo readonly en el input
                        boton.setAttribute('disabled', 'true'); // Deshabilitar el botón
                    } else {
                        input.value = ''; // Limpiar el valor del input
                        input.removeAttribute('readonly'); // Quitar el atributo readonly del input
                        boton.removeAttribute('disabled'); // Habilitar el botón
                    }
                }

                // Llamar a la función actualizarCampos al cargar la página
                actualizarCampos();

                // Agregar un event listener para detectar cambios en el checkbox
                checkbox.addEventListener('change', actualizarCampos);
            }

            // Llamar a la función para gestionar el checkbox de ID Consulta
            gestionarCheckBox('id_consulta_na', 'id_consulta', 'buscar_consulta');

            // Llamar a la función para gestionar el checkbox de ID Centro
            gestionarCheckBox('id_centro_na', 'id_centro', 'buscar_centro');

            function verificarMedicamentoExistente(idMedicamento) {
                // Obtener todas las filas de la tabla de detalles de la receta
                var filas = document.querySelectorAll("#tabla_detalle tbody tr");

                // Iterar sobre las filas para verificar si el medicamento ya está en la tabla
                for (var i = 0; i < filas.length; i++) {
                    // Obtener el ID del medicamento de la fila actual
                    var idMedicamentoActual = filas[i].cells[0].textContent;

                    // Verificar si el ID del medicamento actual coincide con el ID del medicamento que se quiere agregar
                    if (idMedicamentoActual === idMedicamento) {
                        // Si el medicamento ya está en la tabla, mostrar un mensaje de error y devolver true para indicar que ya existe
                        alert("El medicamento ya está agregado en el detalle de la receta.");
                        return true;
                    }
                }

                // Si el medicamento no está en la tabla, devolver false para indicar que no existe
                return false;
            }

            function agregarDetalle() {
                // Obtener el ID del medicamento que se quiere agregar
                var idMedicamento = document.getElementById("id_medicamento").value;

                // Verificar si el medicamento ya está en el detalle de la receta
                if (verificarMedicamentoExistente(idMedicamento)) {
                    // Si el medicamento ya existe, no hacer nada más
                    return;
                }

                // Verificar si todos los campos del fieldset de detalle de receta están llenos
                const nombreMedicamento = document.getElementById("nombre_medicamento").textContent;
                /* const nombreMedicamento = document.getElementById("nombre_medicamento").value; */
                const cantidad = document.getElementById("cantidad").value;
                const unidadMedida = document.getElementById("unidad_medida").value;
                const frecuencia = document.getElementById("frecuencia").value;
                const tiempoUso = document.getElementById("tiempo_uso").value;

                if (idMedicamento === "" || nombreMedicamento === "" || cantidad === "" || unidadMedida === "" || frecuencia === "" || tiempoUso === ""|| cantidad === "0"|| tiempoUso === "0") {
                    // Mostrar mensaje de error si algún campo está vacío
                    const errorMessageDiv = document.getElementById("error-message");
                    errorMessageDiv.textContent = "Error: Todos los campos del detalle de receta son obligatorios.";
                    if (cantidad === "0"|| tiempoUso === "0"){
                        errorMessageDiv.textContent =errorMessageDiv.textContent+" Cantidad y/o tiempo tiene que ser mayor que 0(cero)";
                    }
                    errorMessageDiv.style.display = "block"; // Mostrar el mensaje de error
                    errorMessageDiv.style.color = "red";
                    return;
                }

                // Agregar una nueva fila a la tabla de detalle de receta
                const tablaDetalle = document.getElementById("tabla_detalle").getElementsByTagName("tbody")[0];
                const nuevaFila = tablaDetalle.insertRow();
                const celdaIdMedicamento = nuevaFila.insertCell(0);
                const celdaNombreMedicamento = nuevaFila.insertCell(1);
                const celdaCantidad = nuevaFila.insertCell(2);
                const celdaUnidadMedida = nuevaFila.insertCell(3);
                const celdaFrecuencia = nuevaFila.insertCell(4);
                const celdaTiempoUso = nuevaFila.insertCell(5);
                const celdaAcciones = nuevaFila.insertCell(6);

                // Asignar valores a las celdas de la nueva fila
                celdaIdMedicamento.textContent = idMedicamento;
                celdaNombreMedicamento.textContent = nombreMedicamento;
                celdaCantidad.textContent = cantidad;
                celdaUnidadMedida.textContent = unidadMedida;
                celdaFrecuencia.textContent = frecuencia;
                celdaTiempoUso.textContent = tiempoUso;
                celdaAcciones.innerHTML = '<button class="btn btn-warning"type="button" onclick="borrarFila(this)"><i class="fa-solid fa-square-minus"></i> Eliminar</button>';

                // Limpiar los campos del fieldset de detalle de receta
                document.getElementById("id_medicamento").value = "";
                document.getElementById("nombre_medicamento").textContent = "";
                document.getElementById("descripcion_medicamento").textContent = ""; //descripcion_medicamento
                document.getElementById("cantidad").value = "";
                document.getElementById("unidad_medida").value = "";
                document.getElementById("frecuencia").value = "";
                document.getElementById("tiempo_uso").value = "";

                // Ocultar el mensaje de error si estaba visible
                document.getElementById("error-message").style.display = "none";
            }

            // Función para eliminar una fila de la tabla de detalle de receta
            function borrarFila(boton) {
                const fila = boton.parentNode.parentNode;
                fila.parentNode.removeChild(fila);
            }




            function guardarReceta() {
                // Obtener los datos del formulario de receta
                const id_consulta = document.getElementById("id_consulta").value;
                const id_centro = document.getElementById("id_centro").value;
                const id_paciente = document.getElementById("id_paciente").value;
                const id_medico = document.getElementById("id_medico").value;

                // Crear objeto de receta
                const receta = {
                    id_consulta: id_consulta,
                    id_centro: id_centro,
                    id_paciente: id_paciente,
                    id_medico: id_medico
                };

                // Obtener los detalles de la receta
                const detallesReceta = [];
                const tablaDetalle = document.getElementById("tabla_detalle");
                const filasDetalle = tablaDetalle.getElementsByTagName("tr");

                if (filasDetalle.length > 1) {
                    for (let i = 1; i < filasDetalle.length; i++) {
                        const fila = filasDetalle[i];
                        const id_medicamento = fila.cells[0].textContent;
                        const cantidad = fila.cells[2].textContent;
                        const unidad_medida = fila.cells[3].textContent;
                        const frecuencia = fila.cells[4].textContent;
                        const tiempo_uso = fila.cells[5].textContent;

                        detallesReceta.push({
                            id_medicamento,
                            cantidad,
                            unidad_medida,
                            frecuencia,
                            tiempo_uso
                        });
                    }
                }

                // Crear objeto de detalles de la receta
                const datosReceta = {
                    receta: receta,
                    detalles_receta: detallesReceta
                };

                // Hacer una petición AJAX para guardar los datos
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "guardar_receta.php", true);
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText); // Mostrar respuesta del servidor
                        location.reload(); // Recargar la página después de guardar
                    }
                };

                xhr.send(JSON.stringify(datosReceta)); // Enviar datos al servidor en formato JSON
            }


 

            function verificarCamposCompletos() {
                const camposVacios = []; // Array para almacenar los campos vacíos

                // Obtener valores de los campos del formulario
                const id_paciente = document.getElementById("id_paciente").value.trim();
                const id_consulta = document.getElementById("id_consulta").value.trim();
                const id_centro = document.getElementById("id_centro").value.trim();
                const nombre_paciente = document.getElementById("nombre_paciente").textContent.trim();
                const apellido_paciente = document.getElementById("apellido_paciente").textContent.trim();
                const id_medico = document.getElementById("id_medico").value.trim();
                const nombre_medico = document.getElementById("nombre_medico").textContent.trim();
                const apellido_medico = document.getElementById("apellido_medico").textContent.trim();
                const nombrecentro = document.getElementById("nombre").textContent.trim();
                // Verificar si los campos están vacíos
                if (id_consulta === "") {
                    camposVacios.push("ID consulta (Información faltante)");
                }
                if (id_centro === "") {
                    camposVacios.push("ID Centro Salud (Información faltante)");
                }
                if (id_paciente === "") {
                    camposVacios.push("ID Paciente (Información faltante)");
                }
                if (nombre_paciente === "") {
                    camposVacios.push("Nombre del Paciente (Información faltante)");
                }
                if (apellido_paciente === "") {
                    camposVacios.push("Apellido del Paciente (Información faltante)");
                }
                if (id_medico === "") {
                    camposVacios.push("ID Médico (Información faltante)");
                }
                if (nombre_medico === "") {
                    camposVacios.push("Nombre del Médico (Información faltante)");
                }
                if (apellido_medico === "") {
                    camposVacios.push("apellido del Médico (Información faltante)");
                }
                if (nombrecentro === "") {
                    camposVacios.push("Nombre del Centro de Salud (Información faltante)");
                }
                // Validar si hay detalles de receta
                const tablaDetalle = document.getElementById("tabla_detalle");
                 const filasDetalle = tablaDetalle.getElementsByTagName("tr");

                 if (filasDetalle.length <= 1) {
                     camposVacios.push("No hay ni 1 solo Medicamento (Detalle de receta vacío)");
                 } else {
                     // Iterar sobre las filas de detalles de receta para verificar campos vacíos
                     for (let i = 1; i < filasDetalle.length; i++) {
                         const fila = filasDetalle[i];
                         const idMedicamento = fila.cells[0].textContent.trim();
                         const cantidad = fila.cells[2].textContent.trim();
                         const unidadMedida = fila.cells[3].textContent.trim();
                         const frecuencia = fila.cells[4].textContent.trim();
                         const tiempoUso = fila.cells[5].textContent.trim();

                         // Verificar si algún campo de detalle de receta está vacío
                         if (idMedicamento === "" || cantidad === "" || unidadMedida === "" || frecuencia === "" || tiempoUso === "") {
                             camposVacios.push(`Medicamento en fila ${i} (Información faltante detalle de receta)`);
                         }
                     }
                 }
                // Mostrar mensaje si hay campos vacíos
                if (camposVacios.length > 0) {
                    const mensaje = "Por favor, complete o corrija la información en los siguientes campos:\n" + camposVacios.join("\n");
                    mostrarMensaje(mensaje, "red");
                    return false; // Devolver falso si hay campos vacíos
                }

                return true; // Devolver verdadero si todos los campos están completos
            }

            function mostrarMensaje(mensaje, color) {
                alert(mensaje); // Mostrar el mensaje con una alerta
            }

            /*  function mostrarMensaje(mensaje, color) {
                  alert(mensaje); // Mostrar el mensaje con una alerta
              }*/







            // Define la función verificarYGuardarReceta fuera del evento click
            function verificarYGuardarReceta() {
                if (verificarCamposCompletos()) {
                    guardarReceta();
                }
            }

            // Agrega el evento click al botón
            document.getElementById("btnguardar").addEventListener("click", function(event) {
                event.preventDefault(); // Previene el comportamiento predeterminado del botón
                verificarYGuardarReceta(); // Llama a la función para verificar y guardar la receta
            });
        </script>



      <!--   <div class="botones-container2">
            <a href="menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i>
                Menú Gnral
            </a>
            <a href="index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i>
                Login
            </a>
            <a href="menu-proces.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atrás
            </a>


        </div> -->
</body>

</html>