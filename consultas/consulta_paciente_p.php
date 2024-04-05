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

// Consulta para obtener los datos de la tabla "paciente"
$query = "SELECT id_paciente, nombre, apellido, sexo, fecha_nacimiento, Nacionalidad, Con_quien_vive, Direccion_reside FROM paciente";
$result = $conn->query($query);

// Función para obtener los datos del paciente por ID
function obtenerDatosPaciente($idPaciente, $conn)
{
  $query = "SELECT nombre, apellido FROM paciente WHERE id_paciente = '$idPaciente'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datosPaciente = array('nombre' => $row['nombre'], 'apellido' => $row['apellido']);
    return $datosPaciente;
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
  <title>Consulta de Pacientes</title>
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
      margin-bottom: 10px;


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

    #tabla_pacientes tbody tr:hover {
      background-color: #A8A4DE;
      cursor: pointer;
    }

    #tabla_pacientes tbody tr:active {
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
    }
  </style>
</head>

<body>
  <fieldset>
    <legend></legend>
    <h1 style="padding:0; text-align: center; text-transform: uppercase;">Consulta de Pacientes</h1>

    <table id="tabla_pacientes" class="display">
      <thead>
        <tr>
          <th>ID Paciente</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Sexo</th>
          <th>Fecha Nacimiento</th>
          <th>Nacionalidad</th>
          <th>Con Quién Vive</th>
          <th>Dirección Reside</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Iterar a través de los resultados de la consulta y generar filas en la tabla
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_paciente"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
            echo "<td>" . $row["Nacionalidad"] . "</td>";
            echo "<td>" . $row["Con_quien_vive"] . "</td>";
            echo "<td>" . $row["Direccion_reside"] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <a href="../menu-consultas.php" id="btnatras" class="btn btn-primary" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
      <i class="material-icons" style="font-size:small;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">reply</i> atrás
    </a>
  </fieldset>
  <script>
    $(document).ready(function() {
      $('#tabla_pacientes').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
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