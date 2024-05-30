<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idMedico = $_GET['id_medico'];

// Consulta para obtener el nombre y apellido del médico por ID
$query = "SELECT nombre, apellido FROM medicos WHERE id_medico = '$idMedico'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreCompleto = $row['nombre'] . ' ' . $row['apellido'];
    echo "Nombre completo del médico: " . $nombreCompleto;
} else {
    echo "No se encontraron datos para el médico con ID " . $idMedico;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Consulta horario de: <?php echo $nombreCompleto ;?></title>
  <!-- Enlaces a los archivos CSS de DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <!-- Enlaces a los scripts de JavaScript de jQuery y DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    
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



  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
  <meta charset="UTF-8">

 <style>
  table{color:black;}
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

    #tabla_medicos tbody tr:hover {
      background-color: #A8A4DE;
      cursor: pointer;
    }

    #tabla_medicos tbody tr:active {
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
    } .centrado {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            /* Ajusta según tus necesidades */
        }
  </style>

    
    </head>
<body>
 <fieldset>
    <legend></legend>
    <div class="centrado">
            <img src="../IMAGENES/LOGO/LOGO.png" class="" alt="Mantenimientos" style="width: 100px; height: 100px;">
        </div>
    <h2 style="padding:0; text-align: center; text-transform: uppercase;">Consulta Horario del Médico de: </h2>
     <h3 style="padding:0; text-align: center; text-transform: uppercase;"><?php echo $nombreCompleto ;?></h3>
  <h3 style="padding:0; margin:0;text-align: center;">PediatraSys</h3>



<?php
function obtenerHorariosMedico($idMedico) {
    global $conn;

    // Consulta para obtener los horarios del médico
    $query = "SELECT * FROM horario WHERE id_medico = '$idMedico' AND estado='Activo'";
    $result = $conn->query($query);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Inicializar un arreglo para almacenar los horarios
        $horarios = array();

        // Iterar sobre los resultados y agregarlos al arreglo de horarios
        while ($row = $result->fetch_assoc()) {
            $horarios[] = $row;
        }

        // Devolver el arreglo de horarios
        return $horarios;
    } else {
        // Si no se encontraron horarios, devolver un arreglo vacío
        return array();
    }
}

// Verificar si se recibió el ID del médico por GET
if (isset($_GET['id_medico'])) {
    $idMedico = $_GET['id_medico'];

    // Obtener los horarios del médico
    $horarios = obtenerHorariosMedico($idMedico);

    // Crear una tabla HTML para mostrar los horarios del médico
    if (!empty($horarios)) {
        echo "<table id='tablaHorarios' class='display' style='width:100%'>";
        echo "<thead><tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr></thead>";
        echo "<tbody>";
        echo "<tr>";

        // Obtener todos los días de la semana
        $diasSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

        // Inicializar un arreglo para almacenar los horarios de cada día
        $horariosPorDia = array_fill_keys($diasSemana, array());

        // Organizar los horarios en un arreglo por día
        foreach ($horarios as $horario) {
            $dias = explode(", ", $horario['dias']);
            foreach ($dias as $dia) {
                if (in_array($dia, $diasSemana)) {
                    $horariosPorDia[$dia][] = "{$horario['hora_inicio']} - {$horario['hora_fin']}";
                }
            }
        }

        // Recorrer los días de la semana para construir la tabla
        foreach ($diasSemana as $dia) {
            echo "<td>";
            if (!empty($horariosPorDia[$dia])) {
                foreach ($horariosPorDia[$dia] as $horario) {
                    echo "<div>$horario</div>";
                }
            } else {
                echo "<div>No disponible</div>";
            }
            echo "</td>";
        }

        // Cerrar la fila y la tabla
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron horarios para este médico.";
    }
} else {
    echo "ID de médico no proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>
      <a href="consulta_medicoP2.php" id="btnatras" class="btn btn-primary" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
      <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">reply</i> atrás
    </a>
  </fieldset>
    <script>
//$(document).ready(function() {
//    $('#tablaHorarios').DataTable({
//        "language": {
//            url: '../css/es-ES.json' // Ruta al archivo de traducción
//        }
//    });
//});
//        
        
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
  
  $('#tablaHorarios').DataTable({
    dom: 'Bfrtip',
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