<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Obtener el ID del paciente y del médico desde el formulario o donde corresponda
$idPaciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
$idMedico = isset($_POST['id_medico']) ? $_POST['id_medico'] : '';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener el historial de consultas del paciente con el ID especificado
$query = "SELECT id_consulta, fecha, hora, diagnostico, tratamiento
          FROM consultas
          WHERE id_paciente = '$idPaciente' AND id_medico = '$idMedico'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Historial de Consultas</title>
    <!-- Enlaces a los archivos CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Enlaces a los scripts de JavaScript de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
        /* Estilos CSS */
    </style>
</head>

<body>
    <h5 style="padding: 0; margin: 0; text-align:center;">Historial de Consultas</h5>
    <br>
    <br>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table id="tabla_consultas" class="display" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Diagnóstico</th>
                    <th>Tratamiento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_consulta"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["hora"] . "</td>";
                    echo "<td>" . $row["diagnostico"] . "</td>";
                    echo "<td>" . $row["tratamiento"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>No se encontraron consultas para el paciente y médico especificados.</p>";
    }
    ?>

    <script>
        $(document).ready(function () {
            $('#tabla_consultas').DataTable({
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
