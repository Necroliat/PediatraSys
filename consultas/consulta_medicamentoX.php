<?php
error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL & ~E_WARNING);
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
$query = "SELECT * FROM medicamento";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Médicos</title>
  <!-- Enlaces a los archivos CSS de DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <!-- Enlaces a los scripts de JavaScript de jQuery y DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

  <style>
    table{color:black;}
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
    
    #tabla_medicamento tbody tr:hover {
       background-color: #A8A4DE;
       cursor: pointer;
    }

    #tabla_medicamento tbody tr:active {
      background-color: #5bc0f7;
      cursor: pointer;
      border: 4px solid red;
      transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.5s ease, font-weight 0.8s ease;
      box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red;
      font-size: 25px;
      color: white;
      font-weight: bold;
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
    }
  </style>
</head>

<body>
  <h3 style="padding:0; margin:0;">Consulta de medicamentos</h3>

  <table id="tabla_medicamento" class="display" style="width:100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre Medicamento</th>
        <th>Description</th>
        <th>Formato</th>
        <th>Medida</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr onclick=\"seleccionarmedicamento('" . $row["Id_medicamento"] . "', '" . $row["nombre_medicamento"] . "', '" . $row["descripcion"] . "', '" . $row["formato"] . "', '" . $row["Cantidad_total"] . "')\">";
          echo "<td>" . $row['Id_medicamento'] . "</td>";
          echo "<td>" . $row['nombre_medicamento'] . "</td>";
          echo "<td>" . $row['descripcion'] . "</td>";
          echo "<td>" . $row['formato'] . "</td>";
          echo "<td>" . $row['Cantidad_total'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='2'>No se encontraron resultados.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $('#tabla_medicamento').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        
        },pageLength: 5 
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_medicamento tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idMedicamento = celdas.eq(0).text();
      var nombreMedicamento = celdas.eq(1).text();
      var descripcion = celdas.eq(2).text();

        setTimeout(function() {
          window.parent.document.getElementById('Modalmedicamento').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
    window.parent.document.getElementById("id_medicamento").value = idMedicamento;
 window.parent.document.getElementById("nombre_medicamento").textContent = nombreMedicamento;
 window.parent.document.getElementById("descripcion_medicamento").textContent = descripcion;
        window.parent.document.getElementById("id_medico").focus();

        var currentPath = window.parent.location.pathname;
        var currentPage = currentPath.substring(currentPath.lastIndexOf("/") + 1);

        // Verificar la página actual y ejecutar la función correspondiente en el window.parent
        if (currentPage === "MANT-pacientevacuna.php") {
          window.parent.cargarHistorialVacunas();
        } else if (currentPage === "mant_paciente_historiaClinica.php") {
          window.parent.cargarHistorialPadecimientos();
        } else {
          console.log("Página no reconocida.");
        }
      });
    });
  </script>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
