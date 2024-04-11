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
        *{font-size:small;
        padding:2px;}
        .centrado {
          margin:0;
          padding:0;
            display: flex;
            justify-content: center; 
            align-items: center;
           /*  height: 20vh; */
            /* Ajusta según tus necesidades */
        }
  </style>
</head>

<body>
<!-- <div class="centrado">
            <img src="IMAGENES/LOGO/LOGO.png" class="" alt="Mantenimientos" style="width: 48px; height: 48px;">
        </div> -->
        <h4 style="padding:0; text-align: center; text-transform: uppercase;">Consulta de Pacientes</h4>
<!-- <h5 style="padding:0; margin:0;text-align: center;">PediatraSys</h5> -->
  

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

  <script>
    $(document).ready(function() {
      $('#tabla_pacientes').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        },pageLength: 4
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_pacientes tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idPaciente = celdas.eq(0).text();
        var nombrePaciente = celdas.eq(1).text();
        var apellidoPaciente = celdas.eq(2).text();
        setTimeout(function() {
          window.parent.document.getElementById('Modalpaciente').style.display = 'none';
        }, 600);
        // Asignar los valores al campo de texto y al label en el otro documento

        window.parent.document.getElementById("id_paciente").value = idPaciente;
        window.parent.document.getElementById("nombre_paciente").textContent = nombrePaciente;
        window.parent.document.getElementById("apellido_paciente").textContent = apellidoPaciente;
        window.parent.document.getElementById("id_paciente").focus();
      
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