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

// Consulta para obtener los datos de la tabla "tipo_vacunas"
$query = "SELECT * FROM tipo_vacunas";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Tipos de Vacunas</title>
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

  <script>
    /* $(document).ready(function() {
      $('#tabla_tipos_vacunas').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });*/

    
    $(document).ready(function() {
      $('#tabla_tipos_vacunas').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        },
        pageLength: 3 // Establecer el número de filas por página
      });
    });

    function seleccionarVacuna(idVacuna, nombreVacuna) {
      var openerWindow = window.opener;
      openerWindow.document.getElementById("id_vacuna").value = idVacuna;
      openerWindow.document.getElementById("nombre_vacuna").textContent = nombreVacuna;
      window.close();
    }
  </script>


<style>
  *{font-size:small;}
  table,th, td, tr{
    border: 0.5px solid white;
  }
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
    #tabla_tipos_vacunas tbody tr:hover {
       background-color: #A8A4DE;
       cursor: pointer;
   }
   #tabla_tipos_vacunas tbody tr:active {
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
</head>

<body    style="width:90%; font-size: 14px;">
  <h3 style="padding:0; margin:0;">Consulta de Tipos de Vacunas</h3>

  <table id="tabla_tipos_vacunas" class="display" style="/*width:90%; font-size: x-small;*/">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>`
        <th style="width: 300px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Descrip.</th>
        <th>Dosis</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"seleccionarVacuna('" . $row["id_vacuna"] . "', '" . $row["nombre"] . "')\">";
          echo "<td>" . $row["id_vacuna"] . "</td>";
          echo "<td>" . $row["nombre"] . "</td>";
          echo "<td>" . $row["descripcion"] . "</td>";
          echo "<td>" . $row["total_dosis"] . "</td>";
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
      $("#tabla_tipos_vacunas tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idVacuna = celdas.eq(0).text();
        var nombreVacuna = celdas.eq(1).text();

        // Asignar los valores al campo de texto y al label en paciente.php
        window.parent.document.getElementById("id_vacuna").value = idVacuna;
        window.parent.document.getElementById("nombre_vacuna").textContent = nombreVacuna;

        setTimeout(function() {
          window.parent.document.getElementById('Modalvacuna').style.display = 'none';
        }, 600);
      });

      // Asignar un evento de clic al botón de cierre del modal
      window.parent.document.querySelector("#Modalvacuna .close").addEventListener("click", function() {
        // Cerrar el modal
        window.parent.document.getElementById("Modalvacuna").style.display = "none";
      });

      // Evitar que el evento de clic en el modal cierre el modal
      window.parent.document.querySelector("#Modalvacuna .modal-content").addEventListener("click", function(event) {
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