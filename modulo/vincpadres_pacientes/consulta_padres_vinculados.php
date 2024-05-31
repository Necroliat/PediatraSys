<?php
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

// Obtener el ID del paciente enviado por AJAX
$idPaciente = $_POST['id_paciente'];

// Consulta para obtener los padres vinculados al paciente
$query = "SELECT np.ID_Padre, dpp.nombre, dpp.apellido, np.Tipo_Padre 
          FROM nino_padre np 
          JOIN datos_padres_de_pacientes dpp ON np.ID_Padre = dpp.Numidentificador 
          WHERE np.id_paciente = '$idPaciente'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Generar la tabla con los datos de los padres vinculados
    echo "<table class='table'>";
    echo "<thead><tr><th>ID Padre</th><th>Nombre</th><th>Apellido</th><th>Tipo Padre</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ID_Padre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Tipo_Padre']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    // No se encontraron padres vinculados
    echo "No se encontraron padres vinculados a este paciente.";
}

// Cerrar la conexión
$conn->close();
?>
