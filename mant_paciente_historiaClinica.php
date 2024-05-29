<html>

<head>
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
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 6px 10px;
        }

        label {
            font-size: 14px;
            color: #000000;
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
            color: #000000;
            margin-bottom: 6%;
            border: none;
            border-bottom: 0.1vw solid #000000;
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
        #padecimientosTabla{
            word-wrap: break-word;
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

    <form id="formpadecimientos">
        <div class="container">
            <fieldset style=" height:1100px">
                <legend>Padecimientos del Paciente</legend>
                <fieldset class="caja">
                    <legend class="cajalegend">══ Datos del Paciente ══</legend>
                    <div>
                        <label for="id_paciente">ID PACIENTE:</label>
                        <input type="text" id="id_paciente" name="id_paciente" style="width: 45px;" onblur="cargarHistorialVacunas()" required>
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

                    <div id="Modalpaciente" class="custom-modal">
                        <div class="custom-modal-content">
                            <span class="close">&times;</span>
                            <iframe id="modal-iframe" src="consulta_paciente.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </div>
                </fieldset>

                <!--▓▓▓▓▓▓  (┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)  ▓▓▓▓▓▓ -->
                <!--▓▓▓▓▓▓  (┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)(┬┬﹏┬┬)  ▓▓▓▓▓▓ -->
                <fieldset class="caja" style="border-radius:15px; padding: 10px;">
                    <legend class="cajalegend">══ Datos |PADECIMIENTO | ENFERMEDAD | CONDICIÓN MEDICA ══</legend>

                    <div style="margin-bottom: 15px;">
                        <label for="id_padecimiento">ID Padecimiento:</label>
                        <input type="text" id="id_padecimiento" style="width:110px">
                        <button id="busquedaHC" class="boton_bus" title="Buscar Padecimientos/enfermedades registrados/as">
                            <i class="material-icons" style="font-size:32px;color:#a4e5dfe8;text-shadow:2px 2px 4px #000000;">search</i>
                        </button>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="Nombre_padecimiento">Nombre del padecimiento:</label>
                        <label id="nombre_padecimiento" style="background-color:#fffff1;padding:8px;border-radius:10px;box-shadow:2px 2px 4px #000000;"></label>
                    </div>

                    <div id="ModalHistoriaClinica" class="custom-modal">
                        <div class="custom-modal-content">
                            <span class="close">&times;</span>
                            <iframe id="modal-iframe" src="consulta_padecimientos.php" frameborder="0" style="width: 100%; height: 100%;font-size:12px;"></iframe>
                        </div>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="notas">Notas:</label>
                        <input type="text" id="notas">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="desde_cuando">Desde cuándo:</label>
                        <input type="date" id="desde_cuando" onchange="calculateYears()">
                        <br>
                        <span id="yearsSince" style="padding:8px;border-radius:10px;"></span>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <button id="btnAgregarPadecimiento" onclick="agregarPadecimiento(); return false;" type="button" class="btn btn-primary" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                            <i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>
                            Agregar
                        </button>
                        <button id="btnModificarPadecimiento" style="display: none;">Modificar</button>
                        <button id="btnCancelarEdicion" style="display: none;">Cancelar</button>
                    </div>

                    <div style="overflow-x:auto; margin-bottom: 15px;">
                        <table id="padecimientosTabla" style="font-size: 12px; width: 100%;">
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

                    <div style="text-align: center;">
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

                    <div id="error-message" style="color: red; text-align: center;"></div>
                </fieldset>

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
                                $("#nombre_padecimiento").text(data ? data.nombre_padecimiento : "Valor no encontrado");
                            },
                            error: function(error) {
                                console.log("Error:", error);
                            }
                        });
                    }

                    // Evento para ejecutar la búsqueda al cambiar el valor del campo ID del padecimiento
                    $("#id_padecimiento").on("input", buscarNombrePadecimiento);
                </script>
                <input type="hidden" id="tieneDatosPadecimientos" name="tieneDatosPadecimientos" value="">





                <div id="mensajePadecimientoCapturado"></div>


            </fieldset>

            <fieldset>
                <legend>Historico-Padecimientos</legend>
                <div id="historial_padecimientos" style="font-size:14px;"></div>
            </fieldset>

            <!--▓▓▓▓╰(*°▽°*)╯╰(*°▽°*)╯(^///^)╰(*°▽°*)╯╰(*°▽°*)╯╰(*°▽°*)╯▓▓▓▓▓▓▓▓ -->





    </form>

</body>

<script>
    //▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓

    var idPacienteActual = "";
    var cantidadFilasPadecimientos = 0;

    //▓▓▒░▓▒▓▓▓▒░▓// Función para cargar el historial de padecimientos//▓▓▒░▓▒▓▓▓▒░▓
    function cargarHistorialPadecimientos() {
        var idPaciente = document.getElementById('id_paciente').value;
        var historialPadecimientosDiv = document.getElementById('historial_padecimientos');

        if (idPaciente === '') {
            historialPadecimientosDiv.innerHTML = '<p>Historial de Padecimientos no encontrado.</p>';
        } else {
            $.ajax({
                type: 'POST',
                url: 'consulta_padecimientos_pacientes.php',
                data: {
                    id_paciente: idPaciente
                },
                success: function(data) {
                    historialPadecimientosDiv.innerHTML = data;
                }
            });
        }
    }
    //▓▓▒░FIN ▓▒▓▓▓▒░▓// Función para cargar el historial de padecimientos//▓▓▒░▓▒▓▓▓▒░▓
    // Agregar evento oninput al elemento input
    document.getElementById('id_paciente').addEventListener('input', cargarHistorialPadecimientos);

    // Llamada inicial para cargar el historial al cargar la página
    cargarHistorialPadecimientos();






    //═════════════════════════════════════════════════════════
    /////////////////////modal del paciente/////////////////////////////////////
    //═════════════════════════════════════════════════════════
    // Obtener referencia al botón y al modal del paciente
    const btnbusquedapaciente = document.getElementById("buscarpaciente");
    const modalpaciente = document.getElementById("Modalpaciente");
    // Función para mostrar el modal de padecimiento
    function mostrarModalp() {
        modalpaciente.style.display = "block";
    }
    // Función para ocultar el modal padecimiento
    function ocultarModalp() {
        modalpaciente.style.display = "none";
    }
    // Asignar evento de clic al botón para mostrar u ocultar el modal DE padecimiento y evitar recargar la página
    btnbusquedapaciente.addEventListener("click", function(event) {
        event.preventDefault(); // Evitar recargar la página
        if (modalpaciente.style.display === "none") {
            mostrarModalp();
        } else {
            ocultarModalp();
        }
    });

    ///////////fin//////////modal del paciente////////////

    //▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒FUNCIONES DE HISTORIA CLINICA░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
    //▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
    //✨✨✨busqueda de la historia clinina✨✨✨//
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
    //✨✨✨ fin busqueda de la historia clinina✨✨✨//

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

    /////▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓

    function verificarIdPacienteCompleto() {
        var idPaciente = document.getElementById('id_paciente').value;

        if (idPaciente === '') {
            alert('Por favor, complete el campo "id_paciente" antes de agregar una nuevo Padecimiento.');
            return false;
        }

        return true;
    }

    function verificarPadecimientoExistente(nombrePadecimiento) {
        // Obtener las celdas de la columna de nombres de padecimientos
        var nombresPadecimientos = Array.from(document.querySelectorAll("#historial_padecimientos table tr td:nth-child(2)"));

        // Verificar si el padecimiento ya existe
        return nombresPadecimientos.some(function(celda) {
            return celda.innerText.trim() === nombrePadecimiento;
        });
    }




    // function verificarPadecimientoExistente(nombrePadecimiento) {
    //     // Obtener la tabla y las filas del historial de padecimientos
    //     var tabla = document.getElementById("historial_padecimientos").getElementsByTagName("table")[0];
    //     var filas = tabla.getElementsByTagName("tr");

    //     // Iterar sobre las filas (comenzando desde 1 para omitir la fila de encabezado)
    //     for (var i = 1; i < filas.length; i++) {
    //         var celdas = filas[i].getElementsByTagName("td");

    //         // Obtener el valor del nombre de padecimiento de la fila actual
    //         var nombreActual = celdas[1].innerText.trim(); // Asegurarse de quitar espacios en blanco alrededor

    //         // Verificar si el padecimiento ya existe
    //         if (nombrePadecimiento === nombreActual) {

    //             return true; // El padecimiento ya existe
    //         }
    //     }

    //     return false; // El padecimiento no existe
    // }





    ///▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓


    $(document).ready(function() {
        // Restaurar estilos del fieldset y ocultar botones "Modificar" y "Cancelar"
        restoreFieldsetStyle();

        function agregarPadecimiento() {
    const idPadecimiento = $("#id_padecimiento").val();
    const nombrePadecimiento = $("#nombre_padecimiento").text();
    const notas = $("#notas").val();
    const desdeCuando = $("#desde_cuando").val();

    // Verificar si el padecimiento ya existe en la tabla
    if (padecimientoYaExiste(idPadecimiento)) {
        alert('Este padecimiento ya existe, registrado para ese paciente, observe el historial');
        return;
    }

    // Verificar si el campo "id_paciente" está completo
    if (!verificarIdPacienteCompleto()) {
        return; // Salir de la función si no está completo
    }

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
            <td><button class="eliminarPadecimiento" onclick="confirm('¿Desea eliminar este padecimiento?')">Eliminar</button></td>
        `);

        tbody.append(row);
        table.css("display", "table");
    }

    // Limpiar los campos después de agregar el padecimiento
    $("#id_padecimiento").val("");
    $("#nombre_padecimiento").text("");
    $("#notas").val("");
    $("#desde_cuando").val("");
    $("#yearsSince").text("");

    const tieneDatosPadecimientos = $("#padecimientosTabla tbody tr").length > 0;
    document.getElementById("tieneDatosPadecimientos").value = tieneDatosPadecimientos;

    // Actualiza las variables globales
    idPacienteActual = $("#id_paciente").val();
    cantidadFilasPadecimientos = $("#padecimientosTabla tbody tr").length;
}

function padecimientoYaExiste(idPadecimiento) {
    let existe = false;
    $("#padecimientosTabla tbody tr").each(function() {
        const rowIdPadecimiento = $(this).find("td").eq(0).text();
        if (rowIdPadecimiento === idPadecimiento) {
            existe = true;
            return false; // Terminar el bucle
        }
    });
    return existe;
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


        // Función para agregar un nuevo padecimiento a la tabla
/*         function agregarPadecimiento() {

            const idPadecimiento = $("#id_padecimiento").val();
            const nombrePadecimiento = $("#nombre_padecimiento").text();
            /*var nombrePadecimiento = $("#nombre_padecimiento").text(); /**/
        /*     const notas = $("#notas").val();
            const desdeCuando = $("#desde_cuando").val();


            if (verificarPadecimientoExistente(nombrePadecimiento)) {
                alert('Este padecimiento ya existía, registrado para ese paciente, observe el historial');
                return;
            } */
            // // Verificar si el campo "id_paciente" está completo
         /*    if (!verificarIdPacienteCompleto()) {
                return; // Salir de la función si no está completo
            }


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
            <td><button class="eliminarPadecimiento" onclick="confirm('¿Desea eliminar este padecimiento?')">Eliminar</button></td>
          `);

                tbody.append(row);
                table.css("display", "table");
            }

            $("#id_padecimiento").val("");
            $("#nombre_padecimiento").text("");
            $("#notas").val("");
            $("#desde_cuando").val("");
            $("#yearsSince").text("");

            const tieneDatosPadecimientos = $("#padecimientosTabla tbody tr").length > 0;
            document.getElementById("tieneDatosPadecimientos").value = tieneDatosPadecimientos; */

            // Limpiar los campos después de agregar el padecimiento
         /*    $("#id_padecimiento").val("");
            $("#nombre_padecimiento").text("");
            $("#notas").val("");
            $("#desde_cuando").val("");
            $("#yearsSince").text("");

            // Actualiza las variables globales
            idPacienteActual = $("#id_paciente").val();
            cantidadFilasPadecimientos = $("#padecimientosTabla tbody tr").length;
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
        }); */ 

        // Función para validar si una cadena es una fecha válida
        function isValidDate(dateString) {
            const regexDate = /^\d{4}-\d{2}-\d{2}$/;
            return regexDate.test(dateString);
        }
        // //old Asignar el evento click al botón de agregar padecimiento
        // $("#btnAgregarPadecimiento").click(function() {
        //     agregarPadecimiento();
        //     return false; // Evita el envío del formulario
        // });

        // Evento delegado para los botones "Eliminar" dentro de la tabla
        // Evento delegado para los botones "Eliminar" dentro de la tabla
        $("#padecimientosTabla").on("click", ".eliminarPadecimiento", function(event) {
            // Confirmar con el usuario antes de eliminar la fila
            const confirmacion = confirm('¿Realmente desea eliminar este padecimiento?');

            if (confirmacion) {
                // Obtener la fila correspondiente al botón clicado y eliminarla
                $(this).closest("tr").remove();
            }
        });

        // Código de evento delegado para los botones "Eliminar", sin cambios

        // Evento delegado para los botones "Modificar" dentro de la tabla
        $("#padecimientosTabla").on("click", ".modificarPadecimiento", function(event) {
            event.preventDefault();
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
    });
    //▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓
    //▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓▓▓▒ FIN DE FUNCIONES DE HISTORIA CLINICA░▓▒▓▓▓▒░▓▒▓▓▓▒░▓▒▓


    function limpiarTablaPadecimientos() {
        $("#padecimientosTabla tbody").empty();
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
        cargarHistorialPadecimientos();
    });

    ///██▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓█████▐▐▐▒▓▓███

    // Variables para mantener los registros
    var registros = [];
    // Obtener referencias a los elementos del formulario
    var idPacienteInput = document.getElementById("id_paciente");
    var buscarPacienteButton = document.getElementById("buscarpaciente");
    var nombrePacienteLabel = document.getElementById("nombre_paciente");
    var apellidoPacienteLabel = document.getElementById("apellido_paciente");
    var idPadecimientoInput = document.getElementById("id_padecimiento");
    var busquedaHCButton = document.getElementById("busquedaHC");
    var nombrePadecimientoLabel = document.getElementById("nombre_padecimiento");
    var notasInput = document.getElementById("notas");
    var desdeCuandoInput = document.getElementById("desde_cuando");
    var yearsSinceSpan = document.getElementById("yearsSince");
    var btnAgregarPadecimiento = document.getElementById("btnAgregarPadecimiento");
    var btnModificarPadecimiento = document.getElementById("btnModificarPadecimiento");
    var btnCancelarEdicion = document.getElementById("btnCancelarEdicion");
    var padecimientosTabla = document.getElementById("padecimientosTabla");
    var btnguardarButton = document.getElementById("btnguardar");
    var btnresetButton = document.getElementById("btnreset");
    var btnatrasButton = document.getElementById("btnatras");
    var errorMessageDiv = document.getElementById("error-message");
    var mensajePadecimientoCapturadoDiv = document.getElementById("mensajePadecimientoCapturado");

    function limpiarFormulario() {
        // Limpiar campos del formulario
        idPadecimientoInput.value = '';
        nombrePadecimientoLabel.innerText = '';
        notasInput = '';
        var desdeCuandoInput = new Date.now();
        // Limpiar el campo id_paciente
        document.getElementById('id_paciente').value = '';

        // Limpiar el apellido del paciente
        document.getElementById('apellido_paciente').innerText = '';

        // Limpiar la tabla
        var tabla = document.getElementById("padecimientosTabla");
        var filas = tabla.getElementsByTagName("tr");

        // Eliminar todas las filas (comenzando desde la última).
        for (var i = filas.length - 1; i > 0; i--) {
            tabla.deleteRow(i);
        }

        // Restablecer el arreglo de registros
        registros = [];

        // Restablecer otros elementos del paciente (agrega más según sea necesario)
        document.getElementById('nombre_paciente').innerText = '';

        // Agrega más líneas según sea necesario para otros elementos del paciente

        // Limpiar historial de padecimientos
        document.getElementById('historial_padecimientos').innerHTML = '';
    }
    // function limpiarFormulario() {
    //     // Limpiar campos de paciente
    //     idPacienteInput.value = "";
    //     nombrePacienteLabel.textContent = "";
    //     apellidoPacienteLabel.textContent = "";

    //     // Limpiar campos de padecimiento
    //     idPadecimientoInput.value = "";
    //     nombrePadecimientoLabel.textContent = "";
    //     notasInput.value = "";
    //     desdeCuandoInput.value = "";

    //     // Limpiar el historial de padecimientos
    //     padecimientosTabla.innerHTML = "";

    //     // Ocultar mensajes
    //     errorMessageDiv.style.display = "none";
    //     mensajePadecimientoCapturadoDiv.style.display = "none";
    // }

    function verificarCamposCompletos() {
        var idPaciente = document.getElementById('id_paciente').value;
        var tablapadecimientos = document.getElementById("padecimientosTabla");

        // Verificar el ID del paciente
        if (idPaciente.trim() === '') {
            alert('Campo ID del paciente está vacío. Por favor, complétalo.');
            document.getElementById('id_paciente').style.backgroundColor = 'red';
            return false;
        }

        // Verificar si la tabla de padecimientos tiene datos
        if (tablapadecimientos.rows.length <= 1) {
            alert('La tabla padecimientos está vacía. Por favor, agregue al menos un padecimiento.');
            tablapadecimientos.style.backgroundColor = 'red';
            return false;
        }

        // Restablecer estilos si todo está completo
        document.getElementById('id_paciente').style.backgroundColor = '';
        tablapadecimientos.style.backgroundColor = '';

        return true;
    }



    function guardar() {
        // Obtener el valor del ID del paciente
        const id_paciente = document.getElementById("id_paciente").value;

        // Recopilar datos de la tabla de pacientes_Padecimientos
        const datosPadecimientos = [];
        const tablaPadecimientos = document.getElementById("padecimientosTabla");
        const filasPadecimientos = tablaPadecimientos.getElementsByTagName("tr");
        for (let i = 1; i < filasPadecimientos.length; i++) {
            const filaPadecimientos = filasPadecimientos[i];
            const celdasPadecimientos = filaPadecimientos.getElementsByTagName("td");
            const id_Padecimientos = celdasPadecimientos[0].innerText;
            const nombre = celdasPadecimientos[1].innerText;
            const notas = celdasPadecimientos[2].innerText;
            const desde_cuando = celdasPadecimientos[3].innerText;


            datosPadecimientos.push({
                id_paciente,
                id_Padecimientos,
                nombre,
                notas,
                desde_cuando,
            });


        }

        // Hacer una petición AJAX a PHP para guardar los datos en la base de datos
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "guardar_historia_clinica2.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            // Si hay un error al guardar los datos, mostrar el mensaje de error en el elemento "error-message"
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Mostrar el mensaje de error en el elemento "error-message"
                const errorMessageDiv = document.getElementById("error-message");
                errorMessageDiv.textContent = "Notificación: " + xhr.responseText;
                errorMessageDiv.style.display = "block"; // Mostrar el elemento de error
                errorMessageDiv.style.color = "blue";
                var formulario = document.getElementById("formpadecimientos");
                formulario.reset();
                limpiarTablaPadecimientos();
                // Limpiar la tabla
                var tabla = document.getElementById("padecimientosTabla");
                var filas = tabla.getElementsByTagName("tr");

                // Eliminar todas las filas (comenzando desde la última).
                for (var i = filas.length - 1; i > 0; i--) {
                    tabla.deleteRow(i);
                }


            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                // Mostrar el mensaje de alerta
                alert("Error al guardar los datos. Por favor, intente nuevamente.");
            }
        };

        // Convertir el array de datos a formato JSON
        const datosJSON = JSON.stringify({
            id_paciente,
            pacientesPadecimientos: datosPadecimientos,
        });

        // Enviar la petición AJAX para guardar los datos
        xhr.send(datosJSON);

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
</script>

</html>