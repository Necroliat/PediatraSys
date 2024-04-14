<?php


// Mensaje emergente al cargar el archivo
echo "<script>alert('Bienvenido a cambiar_estado_cita.php');</script>";

// Verificar si se recibieron los parámetros requeridos
if(isset($_POST['id_cita']) && isset($_POST['nuevo_estado'])) {
    // Obtener los valores de los parámetros
    $idCita = $_POST['id_cita'];
    $nuevoEstado = $_POST['nuevo_estado'];

    // Realizar la conexión a la base de datos (debes incluir tus credenciales aquí)
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

    // Preparar la consulta SQL para actualizar el estado de la cita
    $sql = "UPDATE citas SET Estado = ? WHERE id_cita = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoEstado, $idCita);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "El estado de la cita se actualizó correctamente a: $nuevoEstado";
    } else {
        echo "Error al actualizar el estado de la cita: " . $conn->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron los parámetros requeridos, mostrar un mensaje de error
    echo "Error: No se recibieron los parámetros requeridos.";
}


?>
