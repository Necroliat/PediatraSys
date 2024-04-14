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

// Procesar la actualización del estado de la cita si se ha presionado algún botón
if (isset($_POST['id_cita'])) {
    $idCita = $_POST['id_cita'];
    $nuevoEstado = '';

    if (isset($_POST['botoncancelar'])) {
        $nuevoEstado = $_POST['botoncancelar'];
    } elseif (isset($_POST['botonatendiendo'])) {
        $nuevoEstado = $_POST['botonatendiendo'];
    } elseif (isset($_POST['botonatendida'])) {
        $nuevoEstado = $_POST['botonatendida'];
    }

    if (!empty($nuevoEstado)) {
        // Preparar la consulta SQL para actualizar el estado de la cita
        $sql = "UPDATE citas SET Estado = ? WHERE id_cita = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $nuevoEstado, $idCita);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<p>El estado de la cita se actualizó correctamente a: $nuevoEstado</p>";
        } else {
            echo "<p>Error al actualizar el estado de la cita.</p>";
        }

        // Cerrar la declaración preparada
        $stmt->close();
    }
}

// Obtener el ID del médico seleccionado
$idMedico = $_GET["id_medico"];

// Consulta para obtener las citas del médico seleccionado y del día actual
$sqlCitas = "SELECT c.id_cita, c.fecha, c.hora, c.id_paciente, c.Estado, CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
            FROM citas c
            INNER JOIN paciente p ON c.id_paciente = p.id_paciente
            WHERE c.id_medico = $idMedico AND DATE(c.fecha) = CURDATE()";
$resultadoCitas = $conn->query($sqlCitas);

if ($resultadoCitas->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>ID Paciente</th>
                    <th>Nombre Paciente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>";
    while ($filaCitas = $resultadoCitas->fetch_assoc()) {
        echo "<tr>
                <td>{$filaCitas["id_cita"]}</td>
                <td>{$filaCitas["fecha"]}</td>
                <td>{$filaCitas["hora"]}</td>
                <td>{$filaCitas["id_paciente"]}</td>
                <td>{$filaCitas["nombre_paciente"]}</td>
                <td>{$filaCitas["Estado"]}</td>
                <td>";
        // Botones de acciones
        if ($filaCitas["Estado"] == "Vigente") {
            echo "<td>
            <form method='post'>
                <input type='hidden' name='id_cita' value='{$filaCitas["id_cita"]}'>
                <button type='submit' name='botoncancelar' value='Cancelada'>Cancelar</button>
                <button type='submit' name='botonatendiendo' value='Atendiendo' ";
            if ($filaCitas["Estado"] == "Atendiendo") {
                echo "disabled";
            }
            echo ">Atendiendo</button>
                <button type='submit' name='botonatendida' value='Atendida'>Atendida</button>
            </form>
        </td>";
        }

        echo "
            </tr>";
    }
    echo "</tbody>
        </table>";
} else {
    echo "No se encontraron citas para el médico seleccionado y el día de hoy.";
}

// Cerrar la conexión
$conn->close();
?>
