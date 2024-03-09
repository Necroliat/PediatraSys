<!DOCTYPE html>
<html>
<head>
    <title>Hacer Backup</title>
    <style>
        .banner {
            padding: 10px;
            font-weight: bold;
            text-align: center;
        }

        .banner.success {
            background-color: #7FFF7F; /* Verde */
        }

        .banner.error {
            background-color: #FF7F7F; /* Rojo */
        }
    </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Función para hacer el backup
function hacerBackup($servername, $username, $password, $database)
{
    // Intentar la conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        $bannerClass = "error";
        $bannerMessage = "Error de conexión: " . $conn->connect_error;
    } else {
        $backupDirectory = __DIR__ . "/basededatos/";
        $backupFileName = $backupDirectory . "pediatra_sis_" . date("Ymd") . ".sql";

        // Comando para realizar el backup usando mysqldump
        $mysqldumpPath = "C:/wamp64/bin/mysql/mysql8.0.31/bin/mysqldump.exe";
        $command = "$mysqldumpPath -u $username -p$password -h $servername $database > $backupFileName 2>&1";

        // Ejecutar el comando del sistema
        exec($command, $output, $exitCode);

        // Verificar si el respaldo se realizó correctamente
        if ($exitCode === 0) {
            $bannerClass = "success";
            $bannerMessage = "Backup completado correctamente. El archivo se ha guardado como: $backupFileName";
        } else {
            $bannerClass = "error";
            $bannerMessage = "Ha ocurrido un error durante el proceso de backup. Detalles del error:<br><pre>" . implode("\n", $output) . "</pre>";
        }

        // Cerrar la conexión
        $conn->close();
    }
?>
    <div class="banner <?php echo $bannerClass; ?>">
        <?php echo $bannerMessage; ?>
    </div>
<?php
}

// Si se hizo clic en el botón "Hacer Backup"
if (isset($_POST['hacerBackup'])) {
    hacerBackup($servername, $username, $password, $database);
}
?>

<form method="post">
    <input type="submit" name="hacerBackup" value="Hacer Backup">
</form>

</body>
</html>





