<?php
session_start();
require_once "include/conec.php";
/* require_once "funciones.php"; */
// Función para obtener los horarios de un médico específico
function obtenerHorariosMedico($idMedico) {
    global $conn;

    // Consulta para obtener los horarios del médico
    $query = "SELECT * FROM horario WHERE id_medico = '$idMedico'";
    $result = $conn->query($query);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Inicializar un arreglo para almacenar los horarios
        $horarios = array();

        // Iterar sobre los resultados y agregarlos al arreglo de horarios
        while ($row = $result->fetch_assoc()) {
            $horarios[] = $row;
        }

        // Devolver el arreglo de horarios
        return $horarios;
    } else {
        // Si no se encontraron horarios, devolver un arreglo vacío
        return array();
    }
}

// Obtener el ID del médico desde la petición AJAX
$idMedico = $_POST['id_medico'];
// Verificar si se recibió el ID del médico por POST
if (isset($_POST['id_medico'])) {
    $id_medico = $_POST['id_medico'];

    // Obtener los horarios del médico
    $horarios = obtenerHorariosMedico($idMedico);

    // Crear una tabla HTML para mostrar los horarios del médico
    if (!empty($horarios)) {
        echo "<style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th{background-color:white;}
                tr{background-color:rgb(128, 122, 133,0.3);}
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: center;
                }
              </style>";
        // Inicializar la tabla
        echo "<table>";
        echo "<tr><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th><th>Sábado</th></tr>";

        // Obtener todos los días de la semana
        $diasSemana = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

        // Inicializar un arreglo para almacenar los horarios de cada día
        $horariosPorDia = array_fill_keys($diasSemana, array());

        // Organizar los horarios en un arreglo por día
        foreach ($horarios as $horario) {
            $dias = explode(", ", $horario['dias']);
            foreach ($dias as $dia) {
                $horariosPorDia[$dia][] = "{$horario['hora_inicio']} - {$horario['hora_fin']}";
            }
        }

        // Recorrer los días de la semana para construir la tabla
        foreach ($diasSemana as $dia) {
            echo "<td>";
            foreach ($horariosPorDia[$dia] as $horario) {
                echo "<div>$horario</div>";
            }
            echo "</td>";
        }

        // Cerrar la tabla
        echo "</table>";
    } else {
        echo "No se encontraron horarios para este médico.";
    }
} else {
    echo "ID de médico no proporcionado.";
}
/*
// Obtener el ID del médico desde la petición AJAX
$idMedico = $_POST['id_medico'];

// Obtener los horarios del médico
$horarios = obtenerHorariosMedico($idMedico);

// Generar la tabla HTML con los horarios del médico
echo '<table border="1">';
echo '<thead><tr><th>Día</th><th>Horarios</th></tr></thead>';
echo '<tbody>';
foreach ($horarios as $dia => $horario) {
    echo '<tr>';
    echo '<td>' . $dia . '</td>';
    echo '<td>' . implode(', ', $horario) . '</td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';*/
?>
