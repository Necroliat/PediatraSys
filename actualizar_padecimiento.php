<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el formulario
    $idPadecimiento = $_POST['idPadecimiento'];
    $nombrePadecimiento = $_POST['nombrePadecimiento'];
    $desdeCuando = $_POST['desdeCuando'];

    // Realizar la conexión a la base de datos (reutiliza tu código de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pediatra_sis";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Preparar la consulta para actualizar los datos
    $query = "UPDATE detalle_historia_clinica 
              SET nombre_padecimiento = '$nombrePadecimiento', desde_cuando = '$desdeCuando' 
              WHERE id_padecimiento = '$idPadecimiento'";

    // Ejecutar la consulta
    if ($conn->query($query) === TRUE) {
        // Si la actualización se realizó correctamente, devuelve una respuesta JSON de éxito
        echo json_encode(array("success" => true));
    } else {
        // Si hubo un error al ejecutar la consulta, devuelve una respuesta JSON de error
        echo json_encode(array("success" => false));
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no se recibieron los datos del formulario, devuelve una respuesta JSON de error
    echo json_encode(array("success" => false));
}
?>