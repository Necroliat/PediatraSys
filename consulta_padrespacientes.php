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
$query = "SELECT * FROM datos_padres_de_pacientes";
$result = $conn->query($query);

// Función para obtener los datos del médico por ID
function obtenerDatosMedico($idMedico, $conn)
{
  $query = "SELECT Nombre, Apellido FROM datos_padres_de_pacientes WHERE Numidentificador  = '$idpadres'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datospadre = array('Nombre' => $row['Nombre'], 'Apellido' => $row['Apellido']);
    return $datospadre;
  } else {
    return false;
  }
}


function in_iframe() {
  return $_SERVER['HTTP_REFERER'] !== null && $_SERVER['HTTP_REFERER'] !== $_SERVER['REQUEST_URI'];
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
  

  <table id="tabla_padres" class="display">
    <thead>
      <tr>
        <th>ID </th>
        <th>tipo de dato</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Parentesco</th>
        <th>Nacionalidad</th>
        <th>Sexo</th>
        <th>Direccion</th>
        <th>Accion</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["Numidentificador"] . "</td>";
          echo "<td>" . $row["Tipo_Identificador"] . "</td>";
          echo "<td>" . $row["Nombre"] . "</td>";
          echo "<td>" . $row["Apellido"] . "</td>";
          echo "<td>" . $row["Parentesco"] . "</td>";
          echo "<td>" . $row["Nacionalidad"] . "</td>";
          echo "<td>" . $row["Sexo"] . "</td>";
          echo "<td>" . $row["Direccion"] . "</td>";
          echo "<td style='width:24%'> <a class='clasebotonVER' href=\"modulo/medicos/editar.php?id_medico=$row[id_medico]&pag=$pagina\" " . (in_iframe() ? 'target="_parent"' : '') . "><i class='material-icons' style='font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;'>edit</i>Editar</a> </td>";
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
      $('#tabla_padres').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        }
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_padres tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idpadres = celdas.eq(0).text();
        var nombrepadre = celdas.eq(2).text();
        var apellidopadre = celdas.eq(3).text();

        setTimeout(function() {
          window.parent.document.getElementById('Modalpadres').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
        window.parent.document.getElementById("id_padres").value = idpadres;
        window.parent.document.getElementById("nombre_padres").textContent = nombrepadre;
        window.parent.document.getElementById("apellido_padres").textContent = apellidopadre;
        window.parent.document.getElementById("id_padres").focus();

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

