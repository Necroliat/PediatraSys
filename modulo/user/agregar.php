<?php
session_start();


require_once "../../include/conec.php";
//require_once("../../mant-Agregaruser.php");

$pagina = $_GET['pag'];

// Consultar el último ID de la tabla usuarios
$query = "SELECT MAX(id_usuario) AS max_id FROM usuario";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastId = $row["max_id"];
    $newId = $lastId + 1;
} else {
    // Si no hay registros en la tabla, asignar el ID inicial
    $newId = 1;
}

// Guardar el nuevo ID en una variable PHP
$userid = $newId;
?>
<html>

<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
    <link rel="icon" type="image/x-icon" href="IMAGENES/hospital2.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">


    <style>
        .container {
            display: grid;
            grid-template-columns: 80%;
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 6px 10px;
            margin-left: 10%;
            margin-right: 10%;
        }

        .botones-container2 {
            margin: 2px;
            padding: 2px;
            box-sizing: unset;
            width: 100%;
            float: left;
            text-align: left;
            /*justify-content: center;*/
        }

        .botones-container {
            display: flex;
            flex-wrap: wrap;
            margin: 2px;
            padding: 2px;
            box-sizing: border-box;
            justify-content: left;
        }

        .botones-container>a,
        .botones-container>input[type="button"],
        .botones-container>input[type="submit"],
        .botones-container>button {
            margin: 5px;
            padding: 5px 5px;
            border: none;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s ease;
            flex: 1 1 auto;
            /* Esto hace que los botones se expandan igualmente */
            max-width: 200px;
            /* Establece el ancho máximo para mantener la responsividad */
            font-size: 1.2em;
        }

        .botones-container>a:hover,
        .botones-container>input[type="button"]:hover,
        .botones-container>input[type="submit"]:hover,
        .botones-container>button:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            align-content: space-between;
            gap: 10px;
            width: 55%;
            margin-bottom: 10px;

        }


        label {
            width: 40%;
            text-align: right;

        }


        input:read-only {
            background-color: #63b8ff;
            border: 2px solid #fff;
            width: 70px;

        }

        option {
            width: 75PX;
        }

        input,
        select {
            border: none;
            width: 30%;
            border-radius: 6px;
            padding: 5px;

        }


        .claseboton {
            border: none;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
            padding: 7px;

        }

        .claseboton:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        .botones-container {
            margin: 2px;
            padding: 2px;
            box-sizing: unset;
            width: 100%;
            float: left;
            text-align: center;
            /*justify-content: center;*/
        }

        fieldset {
            border: 1px solid #ddd;
            border-radius: 2vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            padding: 1vw;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin-bottom: 2vw;
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

        }

        .clasebotonVER:hover {
            background: linear-gradient(to right, #84e788, #05c20e);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

        .dt-button.dtbotopersonal {
            border: none;
            outline: none;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
            padding: 7px;
        }

        .dt-button.dtbotopersonal:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);
        }

        fieldset fieldset legend {
            font-size: 20px;
            text-transform: uppercase;
            padding-left: 10%;
            padding-right: 10%;
            background-color: transparent;
        }

        legend {
            font-weight: bold;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 1vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            border: solid 1px #45bac9db;
            border-radius: 10px;
        }

        input[type="search"],
        select {
            /* Tus estilos personalizados aquí */
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            background-color: #f2f2f2;
            color: #333;
            width: 200px;
            /* Ancho personalizado */
        }

        .dataTables_filter input {
            color: white;
            background-color: red;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 170px;
            padding: 10px;
            font-size: 1vw;
            color: #444;
            margin-bottom: 2vw;
            border: none;
            border-bottom: 0.1vw solid #444;
            outline: none;
            border-radius: 15px;
            margin: 10px;
            background-color: white;

        }

        .dataTables_wrapper .dataTables_length,
        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_info {
            color: black;
            font-weight: bold;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            /*padding: 0.5em 1em;*/
            margin-left: 2px;
            text-align: center;
            /*text-decoration: none !important;*/
            cursor: pointer;
            color: #fff;
            border: 1px solid transparent;


            background: linear-gradient(to right, #4a90e2, #63b8ff);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            font-size: 16px;
            padding: 7px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;

            margin-left: 2px;
            text-align: center;

            cursor: pointer;
            color: #fff;
            border: 1px solid transparent;


            background: linear-gradient(to right, #63b8ff, #4a90e2);
            border-radius: 7px;
            width: auto;
            text-decoration: none;
            height: 40px;
            font-size: 16px;
            padding: 7px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
        }

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

        .boton {
            border: none;
            outline: none;
            height: 4vw;
            color: #fff;
            font-size: 14px;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            cursor: pointer;
            border-radius: 2vw;
            width: 110px;
            margin-top: 2vw;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            height: auto;
            min-height: 40px;
        }
    </style>


    <style>
        /* Agrega algún estilo si lo deseas */

        input[type="password"] {
        padding-right: 30px; /* Ajusta el espacio para el ojo */
        transition: background-color 0.3s; /* Agrega una transición suave para el cambio de color */
        }

        .eye-icon {

            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        input[type="password"].visible {
            background-color: #87CEEB;
            /* Cambia a un color azul cielo cuando es visible */
        }
        body {
			background: linear-gradient(to right, #E8A9F7, #e4e5dc);
		}

		fieldset {
			background: linear-gradient(to right, #e4e5dc, #62c4f9);
		}
    </style>

    <script type="text/javascript">
        // Obtener el campo de entrada y el nuevo ID
        var txtId = document.getElementById("txtid");
        var newId = <?php echo $userid; ?>;

        // Asignar el nuevo ID al campo de entrada
        txtId.value = newId;

        // Cambiar el fondo a gris claro
        txtId.style.backgroundColor = "#f0f0f0";




        function placeCursorAtEnd() {
            if (this.setSelectionRange) {
                // Double the length because Opera is inconsistent about 
                // whether a carriage return is one character or two.
                var len = this.value.length * 2;
                this.setSelectionRange(len, len);
            } else {
                // This might work for browsers without setSelectionRange support.
                this.value = this.value;
            }

            if (this.nodeName === "TEXTAREA") {
                // This will scroll a textarea to the bottom if needed
                this.scrollTop = 999999;
            }
        };

        window.onload = function() {
            var input = document.getElementById("txtnom");

            if (obj.addEventListener) {
                obj.addEventListener("focus", placeCursorAtEnd, false);
            } else if (obj.attachEvent) {
                obj.attachEvent('onfocus', placeCursorAtEnd);
            }

            input.focus();
        }
        
    </script>
    <?php

   // include("../../menu_lateral_header.php");

    ?>
</head>
<?php

include("../../menu_lateral.php");

?>

<body>
    <div class="container">
        <fieldset style=" height: 1000px;">
            <legend>Agregar Nuevo Usuario</legend>
            <form class="form-container2" method="POST">
                <fieldset class="caja">
                    <legend class="cajalegend"> ══ DATOS DEL Usuario ══ </legend>
                    <div><label>ID</label>
                        <input type="text" name="txtid" autocomplete="off" value=<?php echo $userid; ?> require readonly>
                    </div>
                    <br>
                    <div><label>Nombre de usuario</label>
                        <input type="text" autofocus name="txtnom" autocomplete="off" require>
                    </div>
                    <br>

                    <div>
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="txtpass1" autocomplete="off" required>
                        <label style=" font-size:11px; font-weight:bold;margin-left:210px;">Ver</label>
                        <span style="margin-left:20px;" class="eye-icon" onclick="togglePasswordVisibility('password')">👁️</span>
                    </div>
                    <div>
                        <label for="confirmPassword">Confirmar Pass</label>
                        <input id="confirmPassword" type="password" name="txtconfi" autocomplete="off" required>
                        <label style=" font-size:11px; font-weight:bold;margin-left:210px;">Ver</label>
                        <span style="margin-left:20px;" class="eye-icon" onclick="togglePasswordVisibility('confirmPassword')">👁️</span>
                    </div>


                    <script>
                        function togglePasswordVisibility(inputId) {
                            var passwordInput = document.getElementById(inputId);
                            var eyeIcon = document.querySelector('.eye-icon');

                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                passwordInput.style.backgroundColor = 'skyblue';
                                eyeIcon.textContent = '👁️';
                                passwordInput.classList.add('visible'); // Agrega la clase para cambiar el color de fondo
                            } else {
                                passwordInput.type = 'password';
                                eyeIcon.textContent = '👁️';
                                passwordInput.style.backgroundColor = 'white';
                                passwordInput.classList.remove('visible'); // Remueve la clase para volver al color original
                            }
                        }
                    </script>
                    <br>
                    <div><label>Estado</label>
                        <select id="estado" name="txtest" style=" width: 110px; " autocomplete="off" require>
                            <option selected value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                        <!-- <input type="text" name="txtest" autocomplete="off" require> -->
                    </div>
                    <br>
                    <div><label>Nombre/s</label>
                        <input type="text" name="txtnomcom" autocomplete="off" require>
                    </div>
                    <br>
                    <div><label>Rol</label>
                        <select id="rol" name="txtrol" style=" width: 110px; " autocomplete="off" require>
                            <option selected value="Administrador">Administrador</option>
                            <option value="Secretaría">Secretaría</option>
                            <option value="Doctor">Doctor</option>
                        </select>
                        <!-- <input type="text" name="txtrol" autocomplete="off" require> -->
                    </div>
                    <br>
                </fieldset>
                <div class="botones-container">
                    <button class="btn btn-primary boton" type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este *NUEVO* usuario');"> <i class="material-icons" style="font-size:21px;color:#12f333;text-shadow:2px 2px 4px #000000;">add</i> Registrar</button>

                    <!-- <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario');"> -->

                    <a href="../../mant-Agregaruser.php" id="btncancel" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                        <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">close</i> Cancelar
                    </a>
                </div>
            </form>


            <iframe id="modal-iframe" src="../../consulta_usuario.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>

        </fieldset>
        <div class="botones-container2">
            <a href="../../menu.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">menu</i>
                Menú Gnral
            </a>
            <a href="../../index.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">login</i>
                Login
            </a>
            <a href="../../mant-Agregaruser.php" id="btnatras" class="btn btn-primary boton" style="width: 120px;vertical-align: baseline; font-weight:bold;">
                <i class="material-icons" style="font-size:21px;color:#f0f0f0;text-shadow:2px 2px 4px #000000;">arrow_back</i> Atrás
            </a>


        </div>


</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
    $vaiusu     = $_POST['txtnom'];
    $vaipass     = $_POST['txtpass1'];
    $vaiconf     = $_POST['txtconfi'];
    $vaiestado     = $_POST['txtest'];
    $vainomcom     = $_POST['txtnomcom'];
    $vairol     = $_POST['txtrol'];

    $queryadd    = mysqli_query($conn, "INSERT INTO usuario(id_usuario,nombre_usuario,pass1,confirm_pass,estado,nombre_completo,rol) VALUES('$userid','$vaiusu','$vaipass','$vaiconf','$vaiestado','$vainomcom','$vairol')");

    if (!$queryadd) {
        echo "Error con el registro: " . mysqli_error($conn);
        //echo "<script>alert('DNI duplicado, intenta otra vez');</script>";

    } else {
        echo "<script>window.location= '../../mant-Agregaruser.php?pag=1' </script>";
    }
}
?>