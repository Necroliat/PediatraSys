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

// Consulta para obtener los datos de la tabla "trabajos_medicos"
$query = "SELECT id_trabajo_medico, fecha_creacion, id_medico, descripcion_trabajo_medico FROM trabajos_medicos";
$result = $conn->query($query);

// Función para obtener los datos del trabajo médico por ID
function obtenerDatosTrabajoMedico($idTrabajoMedico, $conn)
{
  $query = "SELECT fecha_creacion, id_medico, descripcion_trabajo_medico FROM trabajos_medicos WHERE id_trabajo_medico = '$idTrabajoMedico'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datosTrabajoMedico = array(
      'fecha_creacion' => $row['fecha_creacion'],
      'id_medico' => $row['id_medico'],
      'descripcion_trabajo_medico' => $row['descripcion_trabajo_medico']
    );
    return $datosTrabajoMedico;
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
  <title>Consulta de Trabajos Médicos</title>
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

    #tabla_trabajos_medicos tbody tr:hover {
      background-color: #A8A4DE;
      cursor: pointer;
    }

    #tabla_trabajos_medicos tbody tr:active {
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
  <h3 style="padding:0; margin:0;">Consulta de Trabajos Médicos</h3>

  <table id="tabla_trabajos_medicos" class="display">
    <thead>
      <tr>
        <th>ID Trabajo Médico</th>
        <th>Fecha Creación</th>
        <th>ID Médico</th>
        <th>Descripción Trabajo Médico</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id_trabajo_medico"] . "</td>";
          echo "<td>" . $row["fecha_creacion"] . "</td>";
          echo "<td>" . $row["id_medico"] . "</td>";
          echo "<td>" . $row["descripcion_trabajo_medico"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No se encontraron resultados.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <script>
    $(document).ready(function() {
      $('#tabla_trabajos_medicos').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        }
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_trabajos_medicos tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idTrabajoMedico = celdas.eq(0).text();
        var fechaCreacion = celdas.eq(1).text();
        var idMedico = celdas.eq(2).text();
        var descripcionTrabajoMedico = celdas.eq(3).text();

        setTimeout(function() {
          window.parent.document.getElementById('Modaltrabajosmedicos').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
        window.parent.document.getElementById("id_trabajo_medico").value = idTrabajoMedico;
        window.parent.document.getElementById("fecha_creacion").value = fechaCreacion;
        window.parent.document.getElementById("id_medico").value = idMedico;
        window.parent.document.getElementById("descripcion_trabajo_medico").value = descripcionTrabajoMedico;
        window.parent.document.getElementById("id_trabajo_medico").focus();
      });
    });
  </script>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>
