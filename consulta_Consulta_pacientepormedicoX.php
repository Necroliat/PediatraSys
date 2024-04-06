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

// Consulta combinada para obtener los datos de las consultas junto con el nombre del paciente y del médico
$query = "SELECT c.id_consulta,p.id_paciente,p.nombre as nombre_paciente,  p.apellido AS apellido_paciente, m.id_medico, 
          m.nombre as nombre_medico,  m.apellido AS apellido_medico, c.fecha, c.hora
          FROM consultas c
          INNER JOIN paciente p ON c.id_paciente = p.id_paciente
          INNER JOIN medicos m ON c.id_medico = m.id_medico";

$result = $conn->query($query);

// Verificar si se obtuvieron resultados
/* if ($result->num_rows > 0) {
    // Iterar sobre los resultados y mostrarlos
    while ($row = $result->fetch_assoc()) {
        echo "ID Consulta: " . $row["id_consulta"] . "<br>";
        echo "Paciente: " . $row["nombre_paciente"] . " " . $row["apellido_paciente"] . "<br>";
        echo "Médico: " . $row["nombre_medico"] . "<br>";
        echo "Fecha: " . $row["fecha"] . "<br>";
        echo "Hora: " . $row["hora"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close(); */
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
    
    #tabla_consultas tbody tr:hover {
       background-color: #A8A4DE;
       cursor: pointer;
    }

    #tabla_consultas tbody tr:active {
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
  <h3 style="padding:0; margin:0;">Consulta Historial Consultas</h3>

  <table id="tabla_consultas" class="display">
    <thead>
    <tr>
        <th>ID Consulta</th>
        <th>ID</th>
        <th>Nom. Pcte.</th>
        <th>Apll. Pcte.</th>
        <th>ID</th>
        <th>Nom. Médico</th>
        <th>Apll.. Médico</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>
    </thead>
    <tbody>
      <?php
      // Iterar a través de los resultados de la consulta y generar filas en la tabla
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_consulta"] . "</td>";//0
            echo "<td>" . $row["id_paciente"] . "</td>";//1
            echo "<td>" . $row["nombre_paciente"] . "</td>";//2
            echo "<td>" . $row["apellido_paciente"] . "</td>";//3
            echo "<td>" . $row["id_medico"] . "</td>";//4
            echo "<td>" . $row["nombre_medico"] . "</td>";//5
            echo "<td>" . $row["apellido_medico"] . "</td>";//6
            echo "<td>" . $row["fecha"] . "</td>";//7
            echo "<td>" . $row["hora"] . "</td>";//8
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
    </tbody>
</table>

  <script>
    $(document).ready(function() {
      $('#tabla_consultas').DataTable({
        dom: 'frtip', // Mostrar solo búsqueda y paginación
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
        
        },pageLength: 5 
      });

      // Asignar un evento de clic a las filas de la tabla
      $("#tabla_consultas tbody").on("click", "tr", function() {
        // Obtener las celdas de la fila clicada
        var celdas = $(this).find("td");

        // Obtener los datos de las celdas
        var idconsulta = celdas.eq(0).text();
        var idpaciente = celdas.eq(1).text();
      var nombrepaciente = celdas.eq(2).text();
      var apellidopaciente = celdas.eq(3).text();
      var iddoctor = celdas.eq(4).text();
      var nombredoctor = celdas.eq(5).text();
      var apellidodoctor = celdas.eq(6).text();
      var direccioncentro = celdas.eq(7).text();
      var fechaconsulta = celdas.eq(8).text();
        setTimeout(function() {
          window.parent.document.getElementById('Modalconsulta').style.display = 'none';
        }, 600);

        // Asignar los valores al campo de texto y al label en el otro documento
 window.parent.document.getElementById("id_consulta").value = idconsulta;
 window.parent.document.getElementById("id_paciente").value = idpaciente ;
        window.parent.document.getElementById("nombre_paciente").textContent = nombrepaciente;
        window.parent.document.getElementById("apellido_paciente").textContent = apellidopaciente;

        window.parent.document.getElementById("id_medico").value = iddoctor;
 
        window.parent.document.getElementById("nombre_medico").textContent = nombredoctor;
        window.parent.document.getElementById("apellido_medico").textContent = apellidodoctor;
        window.parent.document.getElementById("fecha_consulta").textContent = direccioncentro;
        window.parent.document.getElementById("telefono").textContent = telefonocentro;
        
        window.parent.document.getElementById("id_consulta").focus();

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

?>
