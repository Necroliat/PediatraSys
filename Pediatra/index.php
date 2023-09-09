
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
    die("No se pudo conectar a la base de datos: " . $conn->connect_error);
}

// Procesar inicio de sesión si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM usuario WHERE nombre_usuario = '$username' AND Pass1 = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Inicio de sesión exitoso, redirigir al menú
        header("Location: menu.php");
        exit();
    } else {
        $message = "Usuario o contraseña incorrectos";
        $messageColor = "red";
    }
}

// Cerrar la conexión
$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login Sistema de Pediatría</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="message <?php echo $messageColor; ?>"><?php echo $message; ?></div>
    <div class="login-box">
        <h2>Login Sistema de Pediatría</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Contraseña</label>
            </div>
            <button type="submit" class="claseboton">Ingresar</button>
        </form>
    </div>
</body>
</html>