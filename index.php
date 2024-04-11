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
        header("Location: menuadmin.php");
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
    <title>Sistema PediatraSys</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
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
            width: 200px;
            height: 200px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 20px 0px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
            text-align: center;
            margin-bottom: 30px;
            color: #444;
            margin: 10px;
            transition: transform 0.3s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card img {
            width: 50px;
            /* Ajusta el tamaño del icono según sea necesario */
            height: 50px;
            margin-top: 10px;
            /* Espaciado entre el icono y el texto */
        }

        /*.card:hover {
    transform: scale(1.1);
}*/

        .card-title {
            font-size: 20px;
            font-weight: bold;
        }

        .card-description {
            display: none;
        }

        .card:hover .card-description {
            display: block;
        }

        .card-container {

            display: flex;
            justify-content: space-around;
            /* Ajusta según tus necesidades de espaciado */
            /*display: flex;
 flex-direction: column;*/
            display: grid;
            grid-template-columns: repeat(3, 30%);
            grid-template-rows: repeat(3, 1fr);
            /* "1fr" representa una fracción del espacio disponible */
            grid-gap: 6px 10px;
            width: 60%;
            margin: 2% 20% 0% 20%;
            width: 50;
            height: 50;
        }

        .centrado {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            /* Ajusta según tus necesidades */
        }
    </style>
</head>

<body>
    <div class="message <?php echo $messageColor; ?>"><?php echo $message; ?></div>
    <div class="login-box" style="background: linear-gradient(to right, #e4e5dc, #62c4f9);">
        <div class="centrado">
            <img src="IMAGENES/LOGO/LOGO.png" class="" alt="Mantenimientos" style="width: 100px; height: 100px;">
        </div>
        <h2>PediatraSys</h2>
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