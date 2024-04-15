<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Agrega los estilos de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Agrega estilos personalizados -->
  <style>
    /* Estilos personalizados */
    .zebra-table tbody tr:nth-of-type(odd) {
      background-color: rgba(255,255,255,0.6);
    }
    .rounded-corners {
      border-radius: 10px;
        
    }
      fieldset {
      border: 1px solid #ddd;
      border-radius: 2vw;
      background: linear-gradient(to right, #e4e5dc, #45bac9db);
      padding: 1vw;
      box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
      margin: 80px;


    }
      body {
      background: linear-gradient(to right, #E8A9F7, #e4e5dc);
    }

    fieldset {
      background: linear-gradient(to right, #e4e5dc, #62c4f9);
    }
      .centrado {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh;
            /* Ajusta según tus necesidades */
        }
      table tr:nth-child(2) {
  font-size:20px;
           background-color: #A8A4DE;
          font-weight: bold;
}
  </style>
    <title>Citas del Día</title>
  
</head>
<body>
    <fieldset>
    <div class="table-responsive">
<!--    <h2>Citas del Día</h2>-->

    <?php
    error_reporting(E_ERROR | E_PARSE);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pediatra_sis";
    session_start();
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }

 

    //$idMedico = 18; // Supongamos que tienes el ID del médico que deseas consultar
    //fecha actual sql-- CURDATE()
    $idMedico =  $_SESSION['id_medico'];
    //$idMedico = $_GET["id_medico"];
        
 // Obtener el nombre y apellido del médico
$sql_medico = "SELECT nombre, apellido FROM medicos WHERE id_medico = $idMedico";
$result_medico = $conn->query($sql_medico);

$nombre_medico = "";
$apellido_medico = "";
if ($result_medico->num_rows > 0) {
  $row_medico = $result_medico->fetch_assoc();
  $nombre_medico = $row_medico["nombre"];
  $apellido_medico = $row_medico["apellido"];
}

// Obtener la fecha actual en formato corto
$fecha_actual = date("d/m/Y");
 $fecha_actual2 = date("Y-m-d");


    ?>
        


        <div id="tablaCitas">   <script>
$(document).ready(function(){
    function fetchCitas() {
        $.ajax({
            url: 'fetch_citas.php',
            type: 'GET',
            data: {
                idMedico: '<?php echo $idMedico; ?>', // Asegúrate de que esta variable tiene valor
                fechaActual: '<?php echo $fecha_actual2; ?>' // Asegúrate de que esta variable tiene valor
            },
            success: function(data) {
                $('#tablaCitas').html(data); // Actualiza el contenido de la tabla
            }
        });
    }

    setInterval(fetchCitas, 200); // Actualiza cada 2 segundos
});
</script></div>
        
        <!--<?php 
        
/*
// Consulta para obtener las citas canceladas o atendidas
    // Consulta SQL
$sql_segunda_tabla = "
    SELECT 
        ROW_NUMBER() OVER(ORDER BY c.id_cita) AS Turno,
        c.id_cita, 
        c.fecha, 
        c.hora, 
        c.id_paciente, 
        c.Estado, 
        CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente
    FROM 
        citas c
    INNER JOIN 
        paciente p ON c.id_paciente = p.id_paciente
    WHERE 
        c.id_medico = $idMedico 
        AND c.fecha = '$fecha_actual2' 
        AND (c.Estado = 'Vigente' OR c.Estado = 'En consulta')
    ORDER BY 
        c.id_cita;
";

        
        
$result_segunda_tabla = $conn->query($sql_segunda_tabla);

if ($result_segunda_tabla->num_rows > 0) {
    echo "<div class='centrado'><img src='IMAGENES/citamedica-64.png'  alt='Mantenimientos'style='width: 64px; height: 64px;'><img src='IMAGENES/turnos-100.png'  alt='Mantenimientos'style='width: 100px; height: 100px;'>
        </div>";
    echo"<h4 style='padding:0; text-align: center; text-transform: uppercase;'>Estatus de Turnos</h4>";
  echo "<h5 style='padding:0; text-align: center; text-transform: uppercase;'>Citas del Día DE- Dr./Dra $nombre_medico $apellido_medico - $fecha_actual</h5>";
  echo "<table class='table table-striped zebra-table rounded-corners'>";
  echo "<tr>
            <th>Turno</th>
            
            <th>Fecha</th>
            <th>Nombre Paciente</th>
           
            <th>Estado</th>
            
        </tr>";

  while ($row = $result_segunda_tabla->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["Turno"] . "</td>
               
                <td>" . $row["fecha"] . "</td>
               
                <td>" . $row["nombre_paciente"] . "</td>
                <td style='background-color: " . ($row["Estado"] == 'Vigente' ? 'darkslateblue' : 'green') . "; color: white; text-align: center;'><i class='" . ($row["Estado"] == 'En Consulta' ? 'fas fa-times-circle' : 'fa-solid fa-clock-rotate-left') . "'></i> " . $row["Estado"] . "</td>
                
          </tr>";
  }
  echo "</table>";
} else {
  echo "<p>No hay citas canceladas o atendidas para mostrar.</p>";
}

$conn->close();*/
 
        ?>-->
       <a href="consultamedicospacientescitas2.php" id="btnatras" class="btn btn-primary" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
      <i class="fa-solid fa-left-long"></i> Regresar
    </a> 
    </div>
        </fieldset>
</body>
</html>

