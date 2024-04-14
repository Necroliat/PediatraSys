<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";
session_start();

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la lista de médicos
$sqlMedicos = "SELECT id_medico, CONCAT(nombre, ' ', apellido) AS nombre_medico FROM medicos";
$resultadoMedicos = $conn->query($sqlMedicos);

?>
<?php
// Función para interpretar y procesar el mensaje
function procesarMensaje($mensaje)
{
    // Obtener el ID de la cita del mensaje
    preg_match('/Se presionó ([a-zA-Z]+) para la cita (\d+)/', $mensaje, $matches);
    if (count($matches) >= 3) {
        $accion = $matches[1]; // Cancelar, Atendiendo, o Atendida
        $idCita = $matches[2]; // ID de la cita

        // Realizar la conexión a la base de datos (debes incluir tus credenciales aquí)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pediatra_sis";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Preparar la consulta SQL para actualizar el estado de la cita
        $sql = "UPDATE citas SET Estado = ? WHERE id_cita = ?";
        $stmt = $conn->prepare($sql);

        // Asignar el nuevo estado basado en la acción del mensaje
        switch ($accion) {
            case "Cancelar":
                $nuevoEstado = "Cancelada";
                break;
            case "Atendiendo":
                $nuevoEstado = "Atendiendo";
                break;
            case "Atendida":
                $nuevoEstado = "Atendida";
                break;
            default:
                $nuevoEstado = null;
        }

        // Ejecutar la consulta solo si se encontró un nuevo estado válido
        if ($nuevoEstado !== null) {
            $stmt->bind_param("si", $nuevoEstado, $idCita);
            if ($stmt->execute()) {
                // Éxito al actualizar la tabla de citas
                $stmt->close();
                $conn->close();
                return true;
            } else {
                // Error al actualizar la tabla de citas
                $stmt->close();
                $conn->close();
                return false;
            }
        } else {
            // Acción no reconocida
            $stmt->close();
            $conn->close();
            return false;
        }
    } else {
        // El mensaje no coincide con el formato esperado
        return false;
    }
}

// Almacenar el ID del médico en una variable de sesión si se selecciona una fila
if (isset($_POST['id_medico'])) {
    $_SESSION['id_medico'] = $_POST['id_medico'];
}
// Función para obtener la fecha actual en formato corto (día/mes/año)
function obtenerFechaActual()
{
    return date('d/m/Y');
}

// Llamada a la función para obtener la fecha actual
$fechaActual = obtenerFechaActual();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Médicas</title>
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



    <!-- Enlaces a los archivos CSS externos -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Enlaces a los scripts de JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <style>
        body {
            background: linear-gradient(to right, #E8A9F7, #e4e5dc);
        }

        fieldset {
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
        }

        /* Estilos para las tarjetas (card) */
        .card {
            float: left;
            width: 150px;
            height: 150px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
            text-align: center;
            margin-bottom: 30px;
            color: #444;
            margin: 10px;
            flex-direction: column;
            align-items: center;
        }

        .card:hover {
            transform: scale(1.1);
            background: linear-gradient(to right, #62c4f9, #e4e5dc);
            box-shadow: 2px 2px 4px #000000;
        }

        .card-description {
            text-align: center;
            display: none;
            font-size: small;
        }

        .card:hover .card-description {
            display: block;
            text-align: center;
            max-height: 2000px;

        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 5px;
            margin: 0% 25% 0% 25%;
        }

        .card img {
            width: 32px;
            height: 32px;
            margin-top: 5px;
        }

        .card-title {
            font-size: 14px;
            font-weight: bold;
        }

        .botones-container {
            margin: 2px;
            padding: 2px;
            box-sizing: unset;
            width: 100%;
            float: left;
            text-align: center;

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
            width: 80px;
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

        fieldset {
            font-size: medium;
        }

        * {
            font-size: medium;
        }

        fieldset {
            border: 1px solid #ddd;
            border-radius: 2vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            padding: 1vw;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin: 50px;


        }

        .divisor {
            /* Agregar grid */
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* 4 columnas con el mismo ancho */
            grid-column-gap: 10px;
            /* Espacio entre columnas */
            grid-row-gap: 10px;
            /* Espacio entre filas */
        }

        fieldset fieldset legend {
            font-size: 14px;
            text-transform: uppercase;
            padding-left: 10%;
            padding-right: 10%;
            background-color: transparent;
        }

        legend {
            font-weight: bold;
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 1vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            border: solid 1px #45bac9db;
            border-radius: 10px;
            width: 100%;
        }
    </style>
    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: white;
            color: inherit;
            margin-left: 3px;
        }

        tr:hover {
            background-color: #A8A4DE;
        }

        .resaltado {
            background-color: #A8A4DE;
        }

        #tabla_centros tbody tr:hover {
            background-color: #A8A4DE;
            cursor: pointer;
        }

        #tabla_centros tbody tr:active {
            background-color: #5bc0f7;
            cursor: pointer;
            border: 4px solid red;
            transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.5s ease, font-weight 0.8s ease;
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

        .clasebotonVER {
            color: #f0f0f0;
            text-shadow: 2px 2px 4px #000000;
            font-weight: bold;
            border: 1px solid #e4e5dc;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);

            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;

            font-size: 16px;
            padding: 7px;
            margin: 5px;

        }

        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .centrado {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            /* Ajusta según tus necesidades */
        }
    </style>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .active-row {
            background-color: rgba(0, 0, 255, 0.2);
        }

        /* Estilos para las filas pares e impares */
        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
            /* Fondo gris semi-transparente */
        }

        /* Esquinas redondeadas */
        .table-rounded {
            border-radius: 10px;
            /* Esquinas redondeadas */
        }
    </style>



</head>

<body>
    <div class='container'>
        <fieldset>
            <h3>Citas médicas de cada Medico</h3>

            <div style="display: flex;">

                <!-- Tabla de Médicos  tabla_medico -->
                <div style="width: 22%;">
                    <h4>Lista de Médicos</h4>
                    <table id=''class="">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Médico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($resultadoMedicos->num_rows > 0) {
                                while ($filaMedico = $resultadoMedicos->fetch_assoc()) {
                                    echo "<tr data-id='{$filaMedico["id_medico"]}'>
                                <td>{$filaMedico["id_medico"]}</td>
                                <td>{$filaMedico["nombre_medico"]}</td>
                            </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No se encontraron médicos.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


                <!-- Tabla de Citas -->
                <div style="width: 75%;">
                    <h4>Citas del Día - <?php echo $fechaActual; ?></h4>
                    <div id="citas-table">
                        <!-- Aquí se cargarán las citas -->
                    </div>
                </div>

            </div>
        </fieldset>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filasMedicos = document.querySelectorAll("tbody tr");

            filasMedicos.forEach(fila => {
                fila.addEventListener("click", function() {
                    filasMedicos.forEach(fila => fila.classList.remove("active-row"));
                    this.classList.add("active-row");

                    const idMedico = this.getAttribute("data-id");
                    cargarCitas(idMedico);
                });
            });

            function cargarCitas(idMedico) {
                // Realizar una petición AJAX para obtener las citas del médico seleccionado
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("citas-table").innerHTML = xhr.responseText;
                        } else {
                            console.error("Error al cargar las citas");
                        }
                    }
                };
                xhr.open("GET", `consultacitasmedico.php?id_medico=${idMedico}`, true);
                // xhr.open("GET", `procesar_citas.php?id_medico=${idMedico}`, true);
                xhr.send();
            }
        });
    </script>

    <script>
        function configurarTabla() {
            var idioma = {
                "processing": "Procesando...",
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad",
                    "collection": "Colección",
                    "colvisRestore": "Restaurar visibilidad",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %ds fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir",
                    "renameState": "Cambiar nombre",
                    "updateState": "Actualizar",
                    "createState": "Crear Estado",
                    "removeAllStates": "Remover Estados",
                    "removeState": "Remover",
                    "savedStates": "Estados Guardados",
                    "stateRestore": "Estado %d"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmente"
                },
                "decimal": ",",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "conditions": {
                        "date": {
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "notBetween": "No entre",
                            "not": "Diferente de",
                            "after": "Después",
                            "notEmpty": "No Vacío"
                        },
                        "number": {
                            "between": "Entre",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual que",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío",
                            "not": "Diferente de",
                            "empty": "Vacío"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "startsWith": "Empieza con",
                            "not": "Diferente de",
                            "notContains": "No Contiene",
                            "notStartsWith": "No empieza con",
                            "notEndsWith": "No termina con",
                            "notEmpty": "No Vacío"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "notEmpty": "No Vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d",
                    "showMessage": "Mostrar Todo",
                    "collapseMessage": "Colapsar Todo"
                },
                "select": {
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "%d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    },
                    "rows": {
                        "1": "1 fila seleccionada",
                        "_": "%d filas seleccionadas"
                    }
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "AM",
                        "PM"
                    ],
                    "months": {
                        "0": "Enero",
                        "1": "Febrero",
                        "10": "Noviembre",
                        "11": "Diciembre",
                        "2": "Marzo",
                        "3": "Abril",
                        "4": "Mayo",
                        "5": "Junio",
                        "6": "Julio",
                        "7": "Agosto",
                        "8": "Septiembre",
                        "9": "Octubre"
                    },
                    "weekdays": {
                        "0": "Dom",
                        "1": "Lun",
                        "2": "Mar",
                        "4": "Jue",
                        "5": "Vie",
                        "3": "Mié",
                        "6": "Sáb"
                    },
                    "next": "Próximo"
                },
                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro de que desea eliminar %d filas?",
                            "1": "¿Está seguro de que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
                    }
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "stateRestore": {
                    "creationModal": {
                        "button": "Crear",
                        "name": "Nombre:",
                        "order": "Clasificación",
                        "paging": "Paginación",
                        "select": "Seleccionar",
                        "columns": {
                            "search": "Búsqueda de Columna",
                            "visible": "Visibilidad de Columna"
                        },
                        "title": "Crear Nuevo Estado",
                        "toggleLabel": "Incluir:",
                        "scroller": "Posición de desplazamiento",
                        "search": "Búsqueda",
                        "searchBuilder": "Búsqueda avanzada"
                    },
                    "removeJoiner": "y",
                    "removeSubmit": "Eliminar",
                    "renameButton": "Cambiar Nombre",
                    "duplicateError": "Ya existe un Estado con este nombre.",
                    "emptyStates": "No hay Estados guardados",
                    "removeTitle": "Remover Estado",
                    "renameTitle": "Cambiar Nombre Estado",
                    "emptyError": "El nombre no puede estar vacío.",
                    "removeConfirm": "¿Seguro que quiere eliminar %s?",
                    "removeError": "Error al eliminar el Estado",
                    "renameLabel": "Nuevo nombre para %s:"
                },
                "infoThousands": "."
            };

            $('#tabla_medico').DataTable({
                dom: 'frtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: idioma
            });
        }

        configurarTabla();
    </script>



</body>

</html>