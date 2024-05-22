<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";

// Obtener el ID de paciente desde el formulario o donde corresponda
$idPaciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener el historial de padecimientos del paciente con el ID especificado
$query = "SELECT dhc.id_padecimiento,hc.ID_Paciente, pc.nombre_padecimiento,dhc.IDdetalle_HC, dhc.desde_cuando
          FROM historia_clinica hc
          INNER JOIN detalle_historia_clinica dhc ON hc.ID_Hist_Clic = dhc.ID_Hist_Clic
          INNER JOIN padecimientos_comunes pc ON dhc.id_padecimiento = pc.id_padecimiento
          WHERE hc.ID_Paciente = '$idPaciente'";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Padecimientos del Paciente</title>
    <!-- Enlaces a los archivos CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Enlaces a los scripts de JavaScript de jQuery y DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>


    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: white;
            color: inherit;
            margin-left: 3px;
        }

        tr:hover {
            background-color: #A8A4DE;
        }

        .resaltado {
            background-color: #A8A4DE;
        }

        #tabla_padecimientos tbody tr:hover {
            background-color: #A8A4DE;
            cursor: pointer;
        }

        #tabla_padecimientos2 tbody tr:active {
            background-color: #5bc0f7;
            cursor: pointer;
            border: 4px solid red;
            transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.5s ease, font-weight 0.8s ease;
            /* Animaciones de 0.5 segundos */
            box-shadow: 0 0 5px rgba(91, 192, 247, 0.8), 0 0 10px red;
            /* Sombra inicial y sombra roja */
            font-size: 25px;
            color: white;
            /* Cambiar el color del texto */
            font-weight: bold;
            /* Cambiar a negritas */
            font-family: "Copperplate", Fantasy;
        }

        #tabla_padecimientos th,
        #tabla_padecimientos td {
            max-width: 100px;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <h5 style="padding: 0; margin: 0; text-align:center;">Consulta de Padecimientos del Paciente</h5>
    <br>
    <br>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table id="tabla_padecimientos" class="display" style="width: 100%;font-size:12px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Padecimiento</th>
                    <th>Desde</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_padecimiento"] . "</td>";
                    echo "<td>" . $row["nombre_padecimiento"] . "</td>";
                    echo "<td>" . $row["desde_cuando"] . "</td>";
                    echo "<td><a class='btn btn-primary' href='modulo/historia/editar.php?IDdetalle_HC=" . $row["IDdetalle_HC"] . "'><i class='fa-solid fa-pencil'></i> Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>Consulta de Padecimientos no encontrada.</p>";
    }
    ?>

    <!-- Modal para editar los padecimientos -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modificar Padecimiento</h2>
            <form id="formularioModificar">
                <input type="hidden" id="idPadecimiento" name="idPadecimiento">
                <label for="nombrePadecimiento">Nombre Padecimiento:</label>
                <input type="text" id="nombrePadecimiento" name="nombrePadecimiento">
                <label for="desdeCuando">Desde Cuando:</label>
                <input type="text" id="desdeCuando" name="desdeCuando">
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla_padecimientos').DataTable({
                dom: 'frtip', // Mostrar solo búsqueda y paginación
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json' // Ruta al archivo de traducción
                }
            });

            // Asociar un evento de clic al botón "Modificar" de cada fila de la tabla
            $(".padecimientocam").click(function() {
                // Obtener los datos del padecimiento desde los atributos data del botón
                var idPadecimiento = $(this).data("id");
                var nombrePadecimiento = $(this).data("nombre");
                var desdeCuando = $(this).data("desde");

                // Establecer los valores de los campos del formulario con los datos del padecimiento
                $("#idPadecimiento").val(idPadecimiento);
                $("#nombrePadecimiento").val(nombrePadecimiento);
                $("#desdeCuando").val(desdeCuando);

                // Mostrar el modal
                $("#modalEditar").show();
            });

            // Ocultar el modal cuando se hace clic en el botón "Cerrar"
            $(".close").click(function() {
                $("#modalEditar").hide();
            });

            // Enviar los datos actualizados al servidor utilizando AJAX
            $("#formularioModificar").submit(function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del formulario

                var formData = new FormData(this); // Obtener los datos del formulario

                // Enviar los datos al servidor utilizando AJAX
                $.ajax({
                    url: "actualizar_padecimiento.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            alert("Padecimiento actualizado exitosamente.");
                            // Cerrar el modal de edición
                            $("#modalEditar").hide();
                            // Actualizar la tabla si es necesario
                            // ...
                        } else {
                            alert("Error al actualizar el padecimiento.");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', errorThrown);
                    }
                });
            });
        });
    </script>

</body>

</html>

<?php
// Cerrar la conexión
$conn->close();
?>