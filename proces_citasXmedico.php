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

// Consulta para obtener la lista de médicos
$sqlMedicos = "SELECT id_medico, CONCAT(nombre, ' ', apellido) AS nombre_medico FROM medicos";
$resultadoMedicos = $conn->query($sqlMedicos);

?>
<?php
// Función para interpretar y procesar el mensaje

// Función para interpretar y procesar el mensaje
function procesarMensaje($mensaje) {
    // Obtener el ID de la cita del mensaje
    preg_match('/Se presionó ([a-zA-Z]+) para la cita (\d+)/', $mensaje, $matches);
    if (count($matches) >= 3) {
        $accion = $matches[1]; // Cancelar, Atendiendo, o Atendida
        $idCita = $matches[2]; // ID de la cita

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
        
        // Asignar el nuevo estado basado en la acción del mensaje
        switch ($accion) {
            case "Cancelar":
                $nuevoEstado = "Cancelada";
                break;
            case "Atendiendo":
                $nuevoEstado = "Atendiendo";
                break;
            case "Atendida":
                $nuevoEstado = "Atendida";
                break;
            default:
                $nuevoEstado = null;
        }

        // Ejecutar la consulta solo si se encontró un nuevo estado válido
        if ($nuevoEstado !== null) {
            $stmt->bind_param("si", $nuevoEstado, $idCita);
            if ($stmt->execute()) {
                // Éxito al actualizar la tabla de citas
                $stmt->close();
                $conn->close();
                return true;
            } else {
                // Error al actualizar la tabla de citas
                $stmt->close();
                $conn->close();
                return false;
            }
        } else {
            // Acción no reconocida
            $stmt->close();
            $conn->close();
            return false;
        }
    } else {
        // El mensaje no coincide con el formato esperado
        return false;
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Médicas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .active-row {
            background-color: rgba(0, 0, 255, 0.2);
        }
    </style>

    

</head>

<body>

    <h1>Citas Médicas</h1>

    <div style="display: flex;">

        <!-- Tabla de Médicos -->
        <div style="width: 25%;">
            <h2>Lista de Médicos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Médico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultadoMedicos->num_rows > 0) {
                        while ($filaMedico = $resultadoMedicos->fetch_assoc()) {
                            echo "<tr data-id='{$filaMedico["id_medico"]}'>
                                <td>{$filaMedico["id_medico"]}</td>
                                <td>{$filaMedico["nombre_medico"]}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No se encontraron médicos.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla de Citas -->
        <div style="width: 75%;">
            <h2>Citas del Día</h2>
            <div id="citas-table">
                <!-- Aquí se cargarán las citas -->
            </div>
        </div>

    </div>
    <p id="mensaje"></p>

    <script>
        function mostrarMensaje(mensaje) {
            document.getElementById("mensaje").innerText = mensaje;
        }
    </script>





<script>
    // Función para procesar el mensaje y actualizar la tabla de citas
    function procesarMensaje(mensaje) {
        // Realizar una solicitud AJAX para llamar a la función de PHP
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Recargar las citas después de actualizar la tabla
                    window.location.reload();
                } else {
                    console.error("Error al procesar el mensaje");
                }
            }
        };
        xhr.open("GET", "procesar_mensaje.php?mensaje=" + encodeURIComponent(mensaje), true);
        xhr.send();
    }

    // Detectar cambios en el mensaje y llamar a la función de procesamiento
    const mensajeElement = document.getElementById("mensaje");
    let mensajeAnterior = mensajeElement.innerText;
    setInterval(function() {
        const mensajeActual = mensajeElement.innerText;
        if (mensajeActual !== mensajeAnterior) {
            procesarMensaje(mensajeActual);
            mensajeAnterior = mensajeActual;
        }
    }, 1000); // Verificar cada segundo si hay cambios en el mensaje
</script>













    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filasMedicos = document.querySelectorAll("tbody tr");

            filasMedicos.forEach(fila => {
                fila.addEventListener("click", function() {
                    filasMedicos.forEach(fila => fila.classList.remove("active-row"));
                    this.classList.add("active-row");

                    const idMedico = this.getAttribute("data-id");
                    cargarCitas(idMedico);
                });
            });

            function cargarCitas(idMedico) {
                // Realizar una petición AJAX para obtener las citas del médico seleccionado
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            document.getElementById("citas-table").innerHTML = xhr.responseText;
                        } else {
                            console.error("Error al cargar las citas");
                        }
                    }
                };
                xhr.open("GET", `procesar_citas.php?id_medico=${idMedico}`, true);
                xhr.send();
            }
        });
    </script>


    <script>
        function cambiarEstado(idCita, nuevoEstado) {
            // Realizar una petición AJAX para cambiar el estado de la cita
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Recargar las citas después de cambiar el estado
                        window.location.reload();
                    } else {
                        console.error("Error al cambiar el estado de la cita");
                    }
                }
            };
            xhr.open("POST", "cambiar_estado_cita.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(`id_cita=${idCita}&nuevo_estado=${nuevoEstado}`);
        }


        // Agregar evento clic a los botones de estado
        var btnEstados = document.querySelectorAll('.btn-estado');
        btnEstados.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var idCita = this.id.split('-')[1];
                var nuevoEstado = this.getAttribute('data-estado');
                cambiarEstado(idCita, nuevoEstado);
            });
        });
    </script>





</body>

</html>