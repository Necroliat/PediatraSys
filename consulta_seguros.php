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

// Consulta para obtener los datos de la tabla "seguro"
$query = "SELECT Id_seguro_salud, Nombre FROM seguro";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Seguros</title>
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
    *{font-size: small;}
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
    #tabla_seguros tbody tr:hover {
       background-color: #A8A4DE;
       cursor: pointer;
   }
   #tabla_seguros tbody tr:active {
    background-color: #5bc0f7;
    cursor: pointer;
   border:4px solid red ;
    transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.5s ease, font-weight 0.8s ease; /* Animaciones de 0.5 segundos */
    box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red; /* Sombra inicial y sombra roja */
    font-size: 25px;
    color: white; /* Cambiar el color del texto */
    font-weight: bold; /* Cambiar a negritas */
    font-family: "Copperplate",  Fantasy;
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
          
            font-size: 16px;
            padding: 7px;
            margin: 5px;

        }

        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }
  </style>
  <script>
    /* $(document).ready(function() {
      $('#tabla_seguros').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });*/
    $(document).ready(function() {
      $('#tabla_seguros').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        },pageLength: 5 
      });
      var table = $('#tabla_seguros').DataTable();
      $('#tabla_seguros').on('click', 'tr', function() {
        var data = table.row(this).data();
        // below some operations with the data
        // How can I set the row color as red?
        $(this).addClass('highlight').siblings().removeClass('highlight');
      });




    });




    function seleccionarSeguro(idSeguro, nombreSeguro) {
      var openerWindow = window.opener;
      openerWindow.document.getElementById("Id_seguro_salud").value = idSeguro;
      openerWindow.document.getElementById("Nombre_seguro").textContent = nombreSeguro;
      window.close();
    }
  </script>
</head>

<body>
  <h3 style="padding:0; margin:0;">Consulta de Seguros de Salud</h3>

  <table id="tabla_seguros" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Id Seguro</th>
        <th>Nombre</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"seleccionarSeguro('" . $row["Id_seguro_salud"] . "', '" . $row["Nombre"] . "')\">";
          echo "<td>" . $row["Id_seguro_salud"] . "</td>";
          echo "<td>" . $row["Nombre"] . "</td>";
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
      var tablaSeguros = $('#tabla_seguros').DataTable();

      // Asignar un evento de clic a las filas de la tabla
      $('#tabla_seguros tbody').on('click', 'tr', function() {
        // Obtener la fila clicada
        var fila = $(this);

        // Obtener los datos de las celdas
        var idSeguro = tablaSeguros.row(fila).data()[0];
        var nombreSeguro = tablaSeguros.row(fila).data()[1];

        // Asignar los valores al campo de texto y al label en paciente.php
        window.parent.document.getElementById('Id_seguro_salud').value = idSeguro;
        window.parent.document.getElementById('Nombre_seguro').textContent = nombreSeguro;

        // Resaltar toda la fila con un delay de 2 segundos
        fila.addClass('resaltado');

        // Cerrar el modal después de 2 segundos
        setTimeout(function() {
          fila.removeClass('resaltado');
          window.parent.document.getElementById('ModalSeguros').style.display = 'none';
        }, 800);
      });

      // Asignar un evento de clic al botón de cierre del modal
      window.parent.document.querySelector('#ModalSeguros .close').addEventListener('click', function() {
        // Cerrar el modal
        window.parent.document.getElementById('ModalSeguros').style.display = 'none';
      });

      // Evitar que el evento de clic en el modal cierre el modal
      window.parent.document.querySelector('#ModalSeguros .modal-content').addEventListener('click', function(event) {
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