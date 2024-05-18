<?php
session_start();
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
$pagina = $_GET['pag'];
$coddni = $_GET['id_analisis'];

//$coddni =5;

$querybuscar = mysqli_query($conn, "SELECT * FROM   tipos_analisis WHERE id_analisis =$coddni");

 while ($mostrar = mysqli_fetch_array($querybuscar)) {
	$idanalisis = $mostrar['id_analisis'];
	$nombre = $mostrar['Nombre'];
	$descripcion= $mostrar['descripcion'];
} 

?>
<html>

<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../css/estilo-paciente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/726ca5cfb3.js" crossorigin="anonymous"></script>
    <style>
        .botones-container {
            display: flex;
            flex-wrap: wrap;
            margin: 2px;
            padding: 2px;
            box-sizing: border-box;
            justify-content: center;
        }

        .botones-container>a,
        .botones-container>input[type="button"],
        .botones-container>input[type="submit"],
        .botones-container>button {
            margin: 5px;
            padding: 10px 20px;
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
            max-width: 150px;
            /* Establece el ancho máximo para mantener la responsividad */
            font-size: 14px;
        }

        .botones-container>a:hover,
        .botones-container>input[type="button"]:hover,
        .botones-container>input[type="submit"]:hover,
        .botones-container>button:hover {
            background: linear-gradient(to right, #63b8ff, #4a90e2);

            box-shadow: 2px 3px 3px rgba(0, 0, 0, 0.1);
        }
    </style>



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
            grid-template-columns: 80% 20%;
            /* Cambiado a una relación de 60/40 */
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 6px 10px;
        }

        label {
            font-size: 14px;
            color: #444;
            margin: 0;
            font-weight: bold;
        }

        input[type="text"]:read-only {
            background-color: rgb(115, 140, 136);
            color: #000;
            font-weight: bold;
            width: 65px;
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
            color: #444;
            margin-bottom: 0;
            border: none;
            border-bottom: 0.1vw solid #444;
            outline: none;
            border-radius: 10px;

        }

        button {
            border: none;
            outline: none;
            color: #fff;
            font-size: 14px;
            background: linear-gradient(to right, #4a90e2, #63b8ff);
            cursor: pointer;
            padding: 10px;
            border-radius: 10px;

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
        var newId = <?php echo $centroid; ?>;

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
            } <
            script >
            function validarFormulario() {
                // Obtener los valores de los campos
                var nombre = document.forms["miFormulario"]["txtnom"].value;
                var direccion = document.forms["miFormulario"]["txtdire"].value;
                var telefono = document.forms["miFormulario"]["txttele"].value;

                // Verificar si algún campo está vacío
                if (nombre === "" || direccion === "" || telefono === "") {
                    alert("Por favor, completa todos los campos antes de enviar el formulario.");
                    return false; // Evitar que el formulario se envíe
                }

                // Si todos los campos están completos, el formulario se enviará
                return true;
            }
    </script>
    </script>
    <?php

    // include("../../menu_lateral_header.php");

    ?>
</head>
<?php

//include("../../menu_lateral.php");

?>

<body>
    <div class="container">
        <fieldset style=" padding-bottom:40%">
            <legend>Agregar Tipo de Análisis</legend>
            <form name="miFormulario" class="contenedor_popup" method="POST" onsubmit="return validarFormulario()">
                <fieldset class="caja">
                    <legend class="cajalegend">══ Editando Tipo de Análisis ✏🧫🧪📜 ══</legend>
                    <div>
                        <label>ID del Análisis</label>
                        <input type="text" autofocus name="id_analisis" id="id_analisis" autocomplete="off" value="<?php echo $idanalisis ;?>" readonly required>
                    </div> 
                    <br>
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" autocomplete="off" value="<?php echo $nombre ;?>" required>
                    </div>
                    <br>
                    <div>
                        <label>Descripción</label>
                        <textarea style="width: 200px; height:60px;" name="descripcion" id="descripcion" autocomplete="off" required><?php echo $descripcion ;?></textarea>
                    </div>
                    <br>

                </fieldset>
                <div class="botones-container">
                    <button type="submit" name="btnagregar" value="Registrar">
                    <i class="fa-solid fa-pen"></i>
                        Editar
                    </button>
                    <a class="boton" href="../../mant-tipos_analisis.php?pag=<?php echo $pagina; ?>">
                        <i class="fa-solid fa-circle-xmark"></i> Cancelar
                    </a>
                </div>
            </form>


        </fieldset>
    </div>
</body>

</html>
<?php

if (isset($_POST['btnagregar'])) {
   // Obtener los datos del formulario
   $id_analisis = $_POST['id_analisis'];
   $nombre = $_POST['nombre'];
   $descripcion = $_POST['descripcion'];

   // Consulta SQL para actualizar datos en la tabla tipos_analisis
   $sql = "UPDATE tipos_analisis SET Nombre='$nombre', descripcion='$descripcion' WHERE id_analisis='$id_analisis'";

   if ($conn->query($sql) === TRUE) {
       echo "<script>alert('Datos actualizados exitosamente.'); window.location.href='../../mant-tipos_analisis.php';</script>";
   } else {
       echo "<script>alert('Error al actualizar los datos: " . $conn->error . "'); window.location.href='../../mant-tipos_analisis.php';</script>";
   }
}
?>