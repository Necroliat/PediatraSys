<?php
if (isset($_POST['hacerBackup'])) {
    // Ejecutar el script batch
    $output = [];
    $result = null;
    exec('hacerbackup.bat', $output, $result);

    // Verificar el resultado del script batch
    if ($result === 0) {
        $mensaje = "Backup completado correctamente. El archivo se ha guardado como: " . end($output);
    } else {
        $mensaje = "Ha ocurrido un error durante el proceso de backup.";
    }
}
?>

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

        .success {
            background-color: #7FFF7F; /* Verde */
        }

        .error {
            background-color: #FF7F7F; /* Rojo */
        }
    </style>
</head>
<body>
    <?php if (isset($mensaje)) { ?>
        <div class="banner <?php echo $result === 0 ? 'success' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <form method="post">
        <input type="submit" name="hacerBackup" value="Hacer Backup">
    </form>
</body>
</html>

