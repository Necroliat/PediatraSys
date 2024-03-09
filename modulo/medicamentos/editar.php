<?php
session_start();

error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";
/*require_once("../../mant_seguro.php");*/

$pagina = $_GET['pag'];
$coddni = $_GET['Id_medicamento'];

$querybuscar = mysqli_query($conn, "SELECT * FROM medicamento WHERE Id_medicamento =$coddni");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
    $medid     = $mostrar['Id_medicamento'];
    $mednom     = $mostrar['nombre_medicamento'];
    $meddesc    = $mostrar['descripcion'];
    $medform     = $mostrar['formato'];
    $medcant     = $mostrar['Cantidad_total'];
}
?>
<html>

<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
    <meta charset="UTF-8">

    <!--link rel="stylesheet" type="text/css" href="../../css/style.css"-->
    <link rel="stylesheet" type="text/css" href="../../css/estilo-paciente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css"-->
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <!--link rel="stylesheet" type="text/css" href="css/datatables.css"-->

    <!--TODOS LOS JAVASCRIPTS DE DATATABLES-->
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="JS/jquery-3.7.0.js"></script>
    <script src="JS/jquery.dataTables.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>

    <!-- Incluir CSS de DataTables cdn online -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Incluir CSS de DataTables Buttons cdn online-->
    <!--link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css"-->
    <!-- Incluir jQuery y los archivos JS de DataTables y los botones desde CDN -->
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Incluir DataTables -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Incluir DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <!-- Incluir JSZip -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <!-- Incluir pdfmake -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <!-- Incluir Botones HTML5 -->
    <!--script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script-->

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.js"></script>
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <!-- Incluir Botones de impresión -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
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
            border-radius: 20px;
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
    <script>

function validarFormulario() {
				// Obtener referencias a los campos del formulario
				var txtmed = document.getElementById('txtseg');
				var txtdesc = document.getElementById('txtdesc');
				var txtform = document.getElementById('txtform');
				var txtcant = document.getElementById('txtcant');

				// Validar que los campos no estén vacíos
				if (txtmed.value === '' || txtdesc.value === '' || txtform.value === '' || txtcant.value === '') {
					alert('Todos los campos son obligatorios. Por favor, completa todos los campos.');
					return false; // Impide el envío del formulario
				}

				// Agrega otras validaciones según sea necesario

				return true; // Permite el envío del formulario si todas las validaciones pasan
			}
    </script>
    <?php

    //include("../../menu_lateral_header.php");

    ?>
</head>
<?php

//include("../../menu_lateral.php");

?>


<body>
    <div class="container">
        <form class="contenedor_popup" method="POST">
            <fieldset>

                <legend>Modificar Medicamento</legend>
                <fieldset class="caja">
                    <legend class="cajalegend">══ EDITAR ══</legend>
                    <label for="txtid">ID medicamentos</label>
                    <input type="text" name="txtid" id="txtid" value="<?php echo $medid; ?>" required readonly>
                    </br>
                    <label for="txtseg">Nombre Medicamento</label>
                    <input type="text" autofocus name="txtmed" id="txtmed" value="<?php echo $mednom; ?>" required></br>
                    </br>
                    <label for="txtdesc">Descripcion</label>
                    <textarea name="txtdesc" id="txtdesc" required><?php echo $meddesc; ?></textarea>
                    <label for="txtdesc">(componente o molécula/otros datos sobre producto)</label>
                    <!-- <input type="text" name="txtdesc" id="txtdesc" value="<?php //echo $meddesc; ?>" required> -->
                    </br>
                    </br>

                    <label for="txtform">Formato</label>
                    <select name="txtform" id="txtform">
                        <option <?php echo ($medform == 'Pastilla') ? 'selected' : ''; ?> value="Pastilla">Pastilla</option>
                        <option <?php echo ($medform == 'Tableta') ? 'selected' : ''; ?> value="Tableta">Tableta</option>
                        <option <?php echo ($medform == 'Comprimido') ? 'selected' : ''; ?> value="Comprimido">Comprimido</option>
                        <option <?php echo ($medform == 'Cápsula') ? 'selected' : ''; ?> value="Cápsula">Cápsula</option>
                        <option <?php echo ($medform == 'Jarabe') ? 'selected' : ''; ?> value="Jarabe">Jarabe</option>
                        <option <?php echo ($medform == 'Suspensión Oral') ? 'selected' : ''; ?> value="Suspensión Oral">Suspensión Oral</option>
                        <option <?php echo ($medform == 'Tableta Masticable') ? 'selected' : ''; ?> value="Tableta Masticable">Tableta Masticable</option>
                        <option <?php echo ($medform == 'Supositorio') ? 'selected' : ''; ?> value="Supositorio">Supositorio</option>
                        <option <?php echo ($medform == 'Crema') ? 'selected' : ''; ?> value="Crema">Crema</option>
                        <option <?php echo ($medform == 'Pomada') ? 'selected' : ''; ?> value="Pomada">Pomada</option>
                        <option <?php echo ($medform == 'Solución Inyectable') ? 'selected' : ''; ?> value="Solución Inyectable">Solución Inyectable</option>
                        <option <?php echo ($medform == 'Polvo para Reconstitución') ? 'selected' : ''; ?> value="Polvo para Reconstitución">Polvo para Reconstitución</option>
                        <option <?php echo ($medform == 'Gotas Oftálmicas') ? 'selected' : ''; ?> value="Gotas Oftálmicas">Gotas Oftálmicas</option>
                        <option <?php echo ($medform == 'Inhalador') ? 'selected' : ''; ?> value="Inhalador">Inhalador</option>
                        <option <?php echo ($medform == 'Óvulo') ? 'selected' : ''; ?> value="Óvulo">Óvulo</option>
                        <option <?php echo ($medform == 'Gel') ? 'selected' : ''; ?> value="Gel">Gel</option>
                        <option <?php echo ($medform == 'Parche Transdérmico') ? 'selected' : ''; ?> value="Parche Transdérmico">Parche Transdérmico</option>
                        <option <?php echo ($medform == 'Aerosol') ? 'selected' : ''; ?> value="Aerosol">Aerosol</option>
                        <option <?php echo ($medcant == 'Goma de Mascar Medicada') ? 'selected' : ''; ?> value="Goma de Mascar Medicada">Goma de Mascar Medicada</option>
                        <option <?php echo ($medform == 'Inyección Intravenosa (IV)') ? 'selected' : ''; ?> value="Inyección Intravenosa (IV)">Inyección Intravenosa (IV)</option>
                        <option <?php echo ($medform == 'Inyección Intramuscular (IM)') ? 'selected' : ''; ?> value="Inyección Intramuscular (IM)">Inyección Intramuscular (IM)</option>
                        <option <?php echo ($medform == 'Inyección Subcutánea (SC o Sub-Q)') ? 'selected' : ''; ?> value="Inyección Subcutánea (SC o Sub-Q)">Inyección Subcutánea (SC o Sub-Q)</option>
                        <option <?php echo ($medform == 'Jeringa Precargada') ? 'selected' : ''; ?> value="Jeringa Precargada">Jeringa Precargada</option>
                        <option <?php echo ($medform== 'Loción') ? 'selected' : ''; ?> value="Loción">Loción</option>
                        <option <?php echo ($medform == 'Colirio') ? 'selected' : ''; ?> value="Colirio">Colirio</option>
                        <option <?php echo ($medform == 'Polvo') ? 'selected' : ''; ?> value="Polvo">Polvo</option>
                        <option <?php echo ($medform == 'Tintura') ? 'selected' : ''; ?> value="Tintura">Tintura</option>
                        <option <?php echo ($medform == 'Emulsión') ? 'selected' : ''; ?> value="Emulsión">Emulsión</option>
                        <option <?php echo ($medform == 'Solución') ? 'selected' : ''; ?> value="Solución">Solución</option>
                    </select>
                    <!-- <input type="text" name="txtform" id="txtform" value="<?php echo $medform; ?>" required> -->
                    </br>
                    <label for="txtcant">Medida total</label>
                    <input type="text" name="txtcant" id="txtcant" value="<?php echo $medcant; ?>" required>
                    <label for="txtcant">Medida en (gramos, mililitros, onzas, etc.)</label>
                    </br>
                    <div class="botones-container">
                        <?php echo "<a   href=\"../../mant_medicamentos.php?pag=$pagina\">  Cancelar  </a>"; ?>

                        <input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este medicamento?');">
                    </div>
                </fieldset>
                <br>
                <br>

                <iframe id="modal-iframe" src="../../consulta_medicamento.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>

            </fieldset>


        </form>
    </div>

</body>

</html>

<?php

if (isset($_POST['btnmodificar'])) {
    $idmed1 = $_POST['txtid'];
    $med1 = $_POST['txtmed'];
    $med2 = $_POST['txtdesc'];
    $med3 = $_POST['txtform'];
    $med4 = $_POST['txtcant'];

    $querymodificar = mysqli_query($conn, "UPDATE medicamento SET Id_medicamento ='$idmed1',nombre_medicamento='$med1',descripcion='$med2',formato='$med3',Cantidad_total='$med4' WHERE Id_medicamento =$idmed1");
    echo "<script>window.location= '../../mant_medicamentos.php?pag=$pagina' </script>";
}
?>