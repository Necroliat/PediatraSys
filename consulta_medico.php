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

// Consulta para obtener los datos de la tabla "medicos"
$query = "SELECT m.id_medico, m.cedula, m.exequatur, m.nombre, m.apellido, e.especialidad FROM medicos m JOIN especialidad e ON m.id_especialidad = e.id_especialidad";
$result = $conn->query($query);

// Función para obtener los datos del médico por ID
function obtenerDatosMedico($idMedico, $conn)
{
  $query = "SELECT nombre, apellido FROM medicos WHERE id_medico = '$idMedico'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datosMedico = array('nombre' => $row['nombre'], 'apellido' => $row['apellido']);
    return $datosMedico;
  } else {
    return false;
  }
}

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
    *{font-size: medium;}
  </style>
</head>

<body>
  <h3 style="padding:0; margin:0;text-align: center; text-transform: uppercase;">Consulta de Médicos</h3>

  <table id="tabla_medicos" class="display">
    <thead>
      <tr>
        <th>ID Médico</th>
        <th>Cédula</th>
        <th>Exequátur</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Especialidad</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id_medico"] . "</td>";
          echo "<td>" . $row["cedula"] . "</td>";
          echo "<td>" . $row["exequatur"] . "</td>";
          echo "<td>" . $row["nombre"] . "</td>";
          echo "<td>" . $row["apellido"] . "</td>";
          echo "<td>" . $row["especialidad"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='6'>No se encontraron resultados.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $('#tabla_medicos').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        },pageLength: 5
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_medicos tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idMedico = celdas.eq(0).text();
        var nombreMedico = celdas.eq(3).text();
        var apellidoMedico = celdas.eq(4).text();

        setTimeout(function() {
          window.parent.document.getElementById('Modalmedico').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
        window.parent.document.getElementById("id_medico").value = idMedico;
        window.parent.document.getElementById("nombre_medico").textContent = nombreMedico;
        window.parent.document.getElementById("apellido_medico").textContent = apellidoMedico;
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
