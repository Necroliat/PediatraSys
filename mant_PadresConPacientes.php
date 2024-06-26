<?php
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$database = "pediatra_sis";
// Crear conexión.
$conn = new mysqli($servername, $username, $password, $database);
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
// Consulta para obtener los datos de la tabla "especialidades"
$query = "SELECT * FROM localizador_padres_de_pacientes";
$result = $conn->query($query);
?>
<html>
<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .caja {
            border: 3px solid #ddd;
            padding: 10px;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin: 10px;
            border-radius: 5px;
        }

        .cajalegend {
            border: 0px solid rgba(102, 153, 144, 0.0);
            font-weight: bolder;
            font-size: 16px;
            color: white;
            margin: 0;
            padding: 0;
            background-color: transparent;
            border-radius: 2px;
            margin-top: -20px;
            text-shadow: 2px 1px 2px #000000;


        }


        .container {
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: auto auto auto;
            /* Cambié repeat(3, 1fr) por auto para ajustar la altura automáticamente */
            grid-gap: 6px 10px;
            margin-left: 5%;
            margin-right: 20%;
            padding: 0;
          
        }

        /* Añadí una regla para eliminar el margen del cuerpo del documento */
        body {
            margin: 0;
        }

        /*.container {
            display: grid;
            grid-template-columns: 80%;
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 6px 10px;
            margin-left: 10%;
            margin-right: 10%;
            padding: 0px;
        }*/

        label {
            font-size: 14px;
            color: #000000;
            margin: 8px;
            font-weight: bold;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            margin: 0;

            font-size: 12px;
            line-height: 14px;
            margin: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select {

            width: 150px;
            height: 40px;
            color: #000000;
            margin-bottom: 6%;
            border: none;
            border-bottom: 0.1vw solid #000000;
            outline: none;
            border-radius: 10px;

        }

        button {
            border: none;
            outline: none;
            color: #fff;
            font-size: 1.6vw;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            cursor: pointer;
            padding: 10px;
            border-radius: 2vw;

            margin: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            height: auto;
            min-height: 40px;
        }


        .boton_bus {
            border: none;
            outline: none;
            height: 4vw;
            color: #fff;
            font-size: 1.6vw;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            cursor: pointer;
            border-radius: 60px;
            width: 60px;
            margin-top: 2vw;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            height: auto;


        }

        .boton_bus:active {
            background-color: #5bc0f7;
            scale: 1.5;
            cursor: pointer;

            transition: background-color 0.8s ease, box-shadow 0.8s ease, color 0.8s ease, font-weight 0.8s ease;
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

        /* Estilos específicos para el modal personalizado */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .custom-modal-content {
            width: 80%;
            height: 80%;
            margin: auto;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            padding: 20px;
            border-radius: 20PX;
        }

        .custom-close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .custom-close:hover,
        .custom-close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos adicionales específicos para el iframe dentro del modal */
        .custom-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .clasebotonVER {
            border: none;
            outline: none;
            background: linear-gradient(to right, #05c20e, #84e788);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #080808;
            font-size: 16px;
            padding: 7px;
            margin: 5px;

        }

        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
        }

        .dataTables_wrapper:after {
            visibility: hidden;
            display: block;
            content: "";
            clear: both;
            height: 0;
        }

        body {
            background: linear-gradient(to right, #E8A9F7, #e4e5dc);
        }

        fieldset {
            background: linear-gradient(to right, #e4e5dc, #62c4f9);
            
        }
    </style>
    <?php //include("menu_lateral_header.php"); ?>
</head>
<?php
//include("menu_lateral.php");
?>
<body>
    <div>
        <div class="container">
            <form method="POST">
                <fieldset style=" height:600px;">
                    <legend ><h4 style="text-transform: uppercase;">VINCULAR PADRES CON PACIENTES</h4></legend>
                    <a href="modulo/vincpadres_pacientes/agregar.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                        <i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i>Agregar
                    </a>
                    <input type="hidden" value="Buscar" name="btnbuscar">
                    <div height="600px">
                        <iframe id="modal-iframe" src="consulta_padresdelospacientes.php" frameborder="0" style="width: 100%; height: 100%; max-height:700px;"></iframe>
                    </div>
                    <div style='text-align:right'>
                        <br>
                    </div>
                    <div style="text-align:center">
                    </div>
                </fieldset>
                <!-- <div style=" margin-top:-20;padding:0; height:0cm;">
                    <a href="menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                        <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i> Menú Principal
                    </a>
                    <a href="index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                        <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i> Login
                    </a>
                    <a href="menu-mant.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                        <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atrás
                    </a>
                </div> -->
            </form>
        </div>
    </div>
</body>
</html>