<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Obtener el ID de paciente desde el formulario o donde corresponda
$idPaciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener el historial de padecimientos del paciente con el ID especificado
$query = "SELECT dhc.id_padecimiento, pc.nombre_padecimiento, dhc.desde_cuando
          FROM historia_clinica hc
          INNER JOIN detalle_historia_clinica dhc ON hc.ID_Hist_Clic = dhc.ID_Hist_Clic
          INNER JOIN padecimientos_comunes pc ON dhc.id_padecimiento = pc.id_padecimiento
          WHERE hc.ID_Paciente = '$idPaciente'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Padecimientos del Paciente</title>
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
</head>

<body>
    <h5 style="padding: 0; margin: 0; text-align:center;">Consulta de Padecimientos del Paciente</h5>
<br>
<br>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table id="tabla_padecimientos" class="display" style="width: 100%;font-size:12px;">
            <thead>
                <tr>
                    <th>ID Padecimiento</th>
                    <th>Nombre Padecimiento</th>
                    <th>Desde Cuando</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_padecimiento"] . "</td>";
                    echo "<td>" . $row["nombre_padecimiento"] . "</td>";
                    echo "<td>" . $row["desde_cuando"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>Consulta de Padecimientos no encontrada.</p>";
    }
    ?>

    <script>
        $(document).ready(function () {
            $('#tabla_padecimientos').DataTable({
                dom: 'frtip', // Mostrar solo búsqueda y paginación
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
