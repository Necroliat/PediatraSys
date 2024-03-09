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
$query = "SELECT Id_centro, nombre, direccion, telefono FROM institucion_de_salud";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de centros de salud </title>
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
      $('#tabla_centros').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        }
      });
    });




    function seleccionarcentro(idcentro, nombrecentro, direccioncentro, telefonocentro) {
      var openerWindow = window.opener;
      openerWindow.document.getElementById("Id_centro").value = idcentro;
      openerWindow.document.getElementById("nombre").textContent = nombrecentro;
      openerWindow.document.getElementById("direccion").textContent = direccioncentro;
      openerWindow.document.getElementById("telefono").textContent = telefonocentro;
      window.close();
    }
  </script>
</head>

<body>
  <h3 style="padding:0; margin:0;">Consulta de centros de Salud</h3>

  <table id="tabla_centros" class="display" style="width:100%">
    <thead>
      <tr>
        <th>Id centro</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Telefono</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"seleccionarcentro('" . $row["Id_centro"] . "', '" . $row["nombre"] . "', '" . $row["direccion"] . "','" . $row["telefono"] . "')\">";
          echo "<td>" . $row["Id_centro"] . "</td>";
          echo "<td>" . $row["nombre"] . "</td>";
          echo "<td>" . $row["direccion"] . "</td>";
          echo "<td>" . $row["telefono"] . "</td>";
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
      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_centros tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idSeguro = celdas.eq(0).text();
        var nombreSeguro = celdas.eq(1).text();
        var nombreSeguro = celdas.eq(2).text();
        var nombreSeguro = celdas.eq(3).text();

        // Asignar los valores al campo de texto y al label en paciente.php
        window.parent.document.getElementById("Id_centro").value = idcentro;
        window.parent.document.getElementById("nombre").textContent = nombrecentro;
        window.parent.document.getElementById("direccion").textContent = direccioncentro;
        window.parent.document.getElementById("telefono").textContent = telefonocentro;
      });

      // Asignar un evento de clic al botón de cierre del modal
      window.parent.document.querySelector("#myModal .close").addEventListener("click", function() {
        // Cerrar el modal
        window.parent.document.getElementById("myModal").style.display = "none";
      });

      // Evitar que el evento de clic en el modal cierre el modal
      window.parent.document.querySelector("#myModal .modal-content").addEventListener("click", function(event) {
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