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

// Consulta para obtener los datos de la tabla "nino_padre"
$query = "SELECT ID_Relacion, id_paciente, ID_Padre, Tipo_Padre FROM nino_padre";
$result = $conn->query($query);

// Función para obtener los datos del niño-padre por ID_Relacion
function obtenerDatosNinoPadre($idRelacion, $conn)
{
  $query = "SELECT id_paciente, ID_Padre, Tipo_Padre FROM nino_padre WHERE ID_Relacion = '$idRelacion'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datosNinoPadre = array('id_paciente' => $row['id_paciente'], 'ID_Padre' => $row['ID_Padre'], 'Tipo_Padre' => $row['Tipo_Padre']);
    return $datosNinoPadre;
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
  <title>Consulta de Relaciones Niño-Padre</title>
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

    #tabla_nino_padre tbody tr:hover {
      background-color: #A8A4DE;
      cursor: pointer;
    }

    #tabla_nino_padre tbody tr:active {
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
  <h3 style="padding:0; margin:0;">Consulta de Relaciones Niño-Padre</h3>

  <table id="tabla_nino_padre" class="display">
    <thead>
      <tr>
        <th>ID Relación</th>
        <th>ID Paciente</th>
        <th>ID Padre</th>
        <th>Tipo Padre</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["ID_Relacion"] . "</td>";
          echo "<td>" . $row["id_paciente"] . "</td>";
          echo "<td>" . $row["ID_Padre"] . "</td>";
          echo "<td>" . $row["Tipo_Padre"] . "</td>";
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
      $('#tabla_nino_padre').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        }
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_nino_padre tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idRelacion = celdas.eq(0).text();
        var idPaciente = celdas.eq(1).text();
        var idPadre = celdas.eq(2).text();
        var tipoPadre = celdas.eq(3).text();

        setTimeout(function() {
          window.parent.document.getElementById('Modalnino_padre').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
        window.parent.document.getElementById("id_relacion").value = idRelacion;
        window.parent.document.getElementById("id_paciente_nino_padre").value = idPaciente;
        window.parent.document.getElementById("id_padre").value = idPadre;
        window.parent.document.getElementById("tipo_padre").value = tipoPadre;
        window.parent.document.getElementById("id_relacion").focus();

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
