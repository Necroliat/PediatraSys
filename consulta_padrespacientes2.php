<?php
error_reporting(E_ERROR | E_PARSE);
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

// Consulta para obtener los datos de la tabla "laboratorio"
$query = "SELECT * FROM datos_padres_de_pacientes";
$result = $conn->query($query);

// Función para obtener los datos del padre por ID
function obtenerDatosMedico($idpadre, $conn)
{
  $query = "SELECT Nombre, Apellido FROM datos_padres_de_pacientes WHERE Numidentificador= '$idpadre'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datosPadre = array('Nombre' => $row['Nombre'], 'Apellido' => $row['Apellido']);
    return $datosPadre;
  } else {
    return false;
  }
}

function in_iframe()
{
  return $_SERVER['HTTP_REFERER'] !== null && $_SERVER['HTTP_REFERER'] !== $_SERVER['REQUEST_URI'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de datos padres de pacientes</title>
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

    #tabla_padrespacientes tbody tr:hover {
      background-color: #A8A4DE;
      cursor: pointer;
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
    }
  </style>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #aaa;
        border-radius: 3px;
        padding: 5px;
        background-color: white;
        color: inherit;
        margin-left: 3px;
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
    th{background-color: white;
    text-transform: uppercase; }
    tr,th, td{ border:1px solid #ddd ;}

    tr:hover {
        background-color: #A8A4DE;
    }

    .resaltado {
        background-color: #A8A4DE;
    }

    #tabla_tipos_vacunas tbody tr:hover {
        background-color: #A8A4DE;
        cursor: pointer;
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
        grid-template-columns: 80%;
        grid-template-rows: repeat(3, 1fr);
        grid-gap: 6px 10px;
        margin-left: 10%;
        margin-right: 10%;
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
        box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red;
        font-size: 25px;
        color: white;
        font-weight: bold;
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

    .clasebotonVER {
          color:#f0f0f0;
          text-shadow:2px 2px 4px #000000;
          font-weight: bold;
            border: 1px solid #e4e5dc;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            font-size: 10px;
            padding: 7px;
            margin: 5px;

        }
        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

    .clasebotonazul:hover {
        background: linear-gradient(to right, #4a90e2, #63b8ff);
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
    }
    .clasebotonazul {
        color: #f0f0f0;
        text-shadow: 2px 2px 4px #000000;
        font-weight: bold;
        border: none;
        outline: none;
        background: linear-gradient(to right, #63b8ff,#4a90e2);
        border-radius: 7px;
        width: auto;
        text-decoration: none;
        height: 40px;

        font-size: 16px;
        padding: 7px;
        margin: 5px;
    }
    </style>

  <script>
    $(document).ready(function() {
      $('#tabla_padrespacientes').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        },pageLength: 5
      });
      var table = $('#tabla_padrespacientes').DataTable();
      $('#tabla_padrespacientes').on('click', 'tr', function() {
        var data = table.row(this).data();
        // below some operations with the data
        // How can I set the row color as red?
        $(this).addClass('highlight').siblings().removeClass('highlight');
      });

    });

    function seleccionarpadrespacientes(idpadrespacientes, nombrepadrespacientes, apellidopadrespacientes) {
      var openerWindow = window.opener;
      openerWindow.document.getElementById("Identificador").textContent = idpadrespacientes;
      openerWindow.document.getElementById("Nombre").textContent = nombrepadrespacientes;
      openerWindow.document.getElementById("Apellido").textContent = apellidopadrespacientes;
      window.close();
    }
  </script>
</head>

<body>
  <table id="tabla_padrespacientes" class="display" style="width:100%; font-size:small;">
    <thead>
      <tr>
        <th>Id</th>
        <th>Ident.</th>
        <th>Nombre/s</th>
        <th>Apellido/s</th>
        <th>Ptsco.</th>
        <th>Nación</th>
        <th>sexo</th>
        <th>Dirección</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"seleccionarpadrepaciente('" . $row["Numidentificador"] . "', '" . $row["Nombre"] . "', '" . $row["Apellido"] . "')\">";
          echo "<td>" . $row["Numidentificador"] . "</td>";
          echo "<td>" . $row["Tipo_Identificador"] . "</td>";
          echo "<td>" . $row["Nombre"] . "</td>";
          echo "<td>" . $row["Apellido"] . "</td>";
          echo "<td>" . $row["Parentesco"] . "</td>";
          echo "<td>" . $row["Nacionalidad"] . "</td>";
          echo "<td>" . $row["Sexo"] . "</td>";
          echo "<td>" . $row["Direccion"] . "</td>";
          echo "</td>"; // Closing tag for the td element
          echo "<td> <a class='clasebotonVER' href=\"modulo/padrespacientes/editar.php?Numidentificador=$row[Numidentificador]&pag=$pagina\" " . (in_iframe() ? 'target="_parent"' : '') . "><i class='material-icons' style='font-size:15px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;'>edit</i>Editar</a> </td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='2'>No se encontraron resultados.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script>
    //evento click para el mantenimiento del paciente
    $(document).ready(function() {
      var tablapadrespacientes = $('#tabla_padrespacientes').DataTable();
      // Asignar un evento de clic a las filas de la tabla
      $('#tabla_padrespacientes tbody').on('click', 'tr', function() {
        // Obtener la fila clicada
        var fila = $(this);
        // Obtener los datos de las celdas
        var idpadrespacientes = tablapadrespacientes.row(fila).data()[0];
        var nombrepadrespacientes = tablapadrespacientes.row(fila).data()[3];
        var apellidopadrespacientes = tablapadrespacientes.row(fila).data()[4];

        // Asignar los valores al campo de texto y al label en padres pacientes en agregar.php
        window.parent.document.getElementById('Identificador').textContent= idpadrespacientes;
        window.parent.document.getElementById('nombre_padre').textContent = nombrepadrespacientes;
        window.parent.document.getElementById('apellido_padre').textContent = apellidopadrespacientes;
        window.parent.document.getElementById("Identificador").focus();
        // Resaltar toda la fila con un delay de 2 segundos
        fila.addClass('resaltado');
        // Cerrar el modal después de 2 segundos
        setTimeout(function() {
          fila.removeClass('resaltado');
          window.parent.document.getElementById('myModal').style.display = 'none';
        }, 800);
      });
      // Asignar un evento de clic al botón de cierre del modal
      window.parent.document.querySelector('#myModal .close').addEventListener('click', function() {
        // Cerrar el modal
        window.parent.document.getElementById('myModal').style.display = 'none';
      });
      // Evitar que el evento de clic en el modal cierre el modal
      window.parent.document.querySelector('#myModal .modal-content').addEventListener('click', function(event) {
        event.stopPropagation();
      });
    });
  </script>
</body>

</html>
<?php
// Cerrar la conexión
$conn->close();
?>