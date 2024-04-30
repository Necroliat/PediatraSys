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
      background-color: rgba(255, 255, 255, 0.6);
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

    th {
      background-color: rgba(255, 255, 255, 0.7);
      max-width: 100px;
            word-wrap: break-word;
    }
   table{
    margin-left:5%;
    margin-right:5%;
   
    word-wrap: break-word;
   }
    table,
    tr,
    td,
    th {
      font-size: medium;
      border: 1px solid gray;
      border-collapse: collapse;
      text-align: center;
      word-wrap: break-word;
      align-content: baseline;
    }

    table tr:nth-child(odd) {

      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 500;
      /* Color de fondo para las filas imparese */
    }

    table tr:nth-child(even) {
      background-color: rgba(128, 128, 128, 0.2);
      font-weight: 500;
      /* Color de fondo para las filas pares */
    }

    .centrado {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 20vh;
      /* Ajusta según tus necesidades */
    }
  </style>
  <title>Citas del Día</title>

</head>

<body>
  <fieldset>
    <div class="centrado">
      <img src='IMAGENES/icons8-lleno-enviado-100.png' alt='Mantenimientos' style='width: 100px; height: 100px;'>
      <img src='IMAGENES/icons8-carta-del-hospital-100.png' alt='Mantenimientos' style='width: 100px; height: 100px;'>
    </div>
    <h5 style="padding:0; text-align: center; text-transform: uppercase;">notificar via correo a padres</h5>
    <h6 style="padding:0; margin:0;text-align: center;">PediatraSys</h6>
    <div class="table-responsive" >
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




      $idMedico =  $_SESSION['id_medico'];
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


      $idMedico = $_SESSION['id_medico'];  // Asegúrate de que el ID del médico está guardado en sesión

      $sql = "SELECT 
            c.id_cita,
            c.fecha,
            c.hora,
            c.id_paciente,
            CONCAT(p.nombre, ' ', p.apellido) AS nombre_paciente,
            c.id_medico,
            CONCAT(m.nombre, ' ', m.apellido) AS nombre_medico,
            CONCAT(dp.Nombre, ' ', dp.Apellido) AS nombre_padre,
            (
                SELECT lp.Valor 
                FROM localizador_padres_de_pacientes lp 
                WHERE lp.Identificador = dp.Numidentificador AND lp.Valor LIKE '%@%'
                ORDER BY lp.ID_Localizador ASC 
                LIMIT 1
            ) AS email_padre
        FROM 
            citas c
            INNER JOIN paciente p ON c.id_paciente = p.id_paciente
            INNER JOIN medicos m ON c.id_medico = m.id_medico
            INNER JOIN nino_padre np ON np.id_paciente = p.id_paciente
            INNER JOIN datos_padres_de_pacientes dp ON dp.Numidentificador = np.ID_Padre
        WHERE 
            c.id_medico = $idMedico
        GROUP BY 
            c.id_cita
        ORDER BY 
            np.ID_Relacion";

      $result = $conn->query($sql);
      echo"<div class='centrado3'>";
      echo '<table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Num</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>ID</th>
            <th>Paciente</th>
            <th>ID</th>
            <th>Médico</th>
            <th>Padre</th>
            <th>Email</th>
        </tr>';

      if ($result && $result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
          echo '<tr>
                <td>' . htmlspecialchars($row['id_cita']) . '</td>
                <td>' . htmlspecialchars($row['fecha']) . '</td>
                <td>' . htmlspecialchars($row['hora']) . '</td>
                <td>' . htmlspecialchars($row['id_paciente']) . '</td>
                <td>' . htmlspecialchars($row['nombre_paciente']) . '</td>
                <td>' . htmlspecialchars($row['id_medico']) . '</td>
                <td>' . htmlspecialchars($row['nombre_medico']) . '</td>
                <td>' . htmlspecialchars($row['nombre_padre']) . '</td>
                <td>' . htmlspecialchars($row['email_padre']) . '</td>
              </tr>';
        }
      } else {
        echo '<tr><td colspan="9">No hay citas disponibles</td></tr>';
      }

      echo '</table>';
      echo"</div>";
      ?>



      <div id="tablaCitas">
        <script>
          $(document).ready(function() {
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
        </script>
      </div>


      <a href="consultamedicospacientescitas3.php" id="btnatras" class="btn btn-primary" style="width: 120px; font-size:small;vertical-align: baseline; font-weight:bold;">
        <i class="fa-solid fa-left-long"></i> Regresar
      </a>
    </div>
  </fieldset>
</body>

</html>