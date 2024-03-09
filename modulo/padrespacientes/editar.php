<?php

session_start();

error_reporting(E_ALL & ~E_WARNING);
require_once "../../include/conec.php";

$pagina = $_GET['pag'];
$coddni = $_GET['Numidentificador'];


$querybuscar = mysqli_query($conn, "SELECT * FROM datos_padres_de_pacientes WHERE Numidentificador='$coddni'");

while ($mostrar = mysqli_fetch_array($querybuscar)) {
    $numIdentificador1 = $mostrar['Numidentificador'];
    $numIdentificador = $mostrar['Numidentificador'];
    $tipoIdentificador = $mostrar['Tipo_Identificador'];
    $nombre = $mostrar['Nombre'];
    $apellido = $mostrar['Apellido'];
    $parentesco = $mostrar['Parentesco'];
    $nacionalidad = $mostrar['Nacionalidad'];
    $sexo = $mostrar['Sexo'];
    $direccion = $mostrar['Direccion'];
    $ocupacion = $mostrar['Ocupacion'];
}
?>









<?php


?>
<html>

<head>
    <title>Sis_Pediátrico</title>
    <link rel="icon" type="image/x-icon" href="../../IMAGENES/hospital2.ico">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/estilo-paciente.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados aquí */
    </style>
    <script>
        // Función para validar campos antes de enviar el formulario
        function validarFormulario() {
            var numIdentificador = document.getElementById("txtnumidentificador").value;
            var tipoIdentificador = document.getElementById("txttipo_identificador").value;
            var nombre = document.getElementById("txtnombre").value;
            var apellido = document.getElementById("txtapellido").value;
            var parentesco = document.getElementById("txtparentesco").value;
            var nacionalidad = document.getElementById("txtnacionalidad").value;
            var sexo = document.getElementById("txtsexo").value;
            var direccion = document.getElementById("txtdireccion").value;
            var ocupacion = document.getElementById("txtocupacion").value;

            if (numIdentificador.trim() === '' || tipoIdentificador.trim() === '' || nombre.trim() === '' || apellido.trim() === '' || parentesco.trim() === '' || nacionalidad.trim() === '' || sexo.trim() === '' || direccion.trim() === '' || ocupacion.trim() === '') {
                alert("Por favor, complete todos los campos");
                return false;
            }

            return true;
        }
    </script>
    <script type="text/javascript">
        // Obtener el campo de entrada y el nuevo ID
        var txtNumIdentificador = document.getElementById("txtnumidentificador");
        var newId = <?php echo $numIdentificador; ?>;

        // Asignar el nuevo ID al campo de entrada
        txtNumIdentificador.value = newId;

        // Cambiar el fondo a gris claro
        txtNumIdentificador.style.backgroundColor = "#f0f0f0";

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

        window.onload = function () {
            var input = document.getElementById("txtnumidentificador");

            if (input.addEventListener) {
                input.addEventListener("focus", placeCursorAtEnd, false);
            } else if (input.attachEvent) {
                input.attachEvent('onfocus', placeCursorAtEnd);
            }

            input.focus();
        }

    </script>


    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
            /* Establece el ancho máximo para mantener la responsividad. */
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
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        /* .caja {
            border: 3px solid #ddd;
            padding: 10px;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin: 10px;
            border-radius: 5px;
        } */

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
            margin-left: 10%;
            margin-right: 10%;
            padding: 0;

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

        /* Estilos adicionales específicos para el iframe dentro del modal. */
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
            border: 1px solid #ddd;
            border-radius: 2vw;

            padding: 1vw;
            box-shadow: 0 0 0.5vw rgba(0, 0, 0, 0.1);
            margin-bottom: 2vw;
        }

        legend {
            font-weight: bold;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 1vw;
            background: linear-gradient(to right, #e4e5dc, #45bac9db);
            border: solid 1px #45bac9db;
            border-radius: 10px;
        }
    </style>
    <?php

    //include("../../menu_lateral_header.php");

    ?>
</head>
<?php

//include("../../menu_lateral.php");

?>

<body onload="cargarPagina()">
    <div class="container">
        <fieldset style=" height:1200px;">
            <form class="contenedor_popup" method="POST" onsubmit="return validarFormulario();">
                <legend>Editando datos de padres de pacientes 👨‍👩‍👧‍👦</legend>
                <fieldset class="caja">
                    <legend class="cajalegend">══ ✏️Modificar Padres de Pacientes 👨‍👩‍👧‍👦 ══</legend>
                    <p>
                        <label for="txttipo_identificador">Tipo Identificador</label>
                        <select id="txttipo_identificador" name="txttipo_identificador" style=" width: 110px; "
                            autocomplete="off" require>
                            <option <?php echo ($tipoIdentificador =='cédula' || $tipoIdentificador =='Cédula') ? 'selected' : ''; ?> value="Cédula">Cédula</option>
                            <option  <?php echo ($tipoIdentificador =='pasaporte'|| $tipoIdentificador =='Pasaporte' ) ? 'selected' : ''; ?> value="Pasaporte">Pasaporte</option>
                        </select>
                        <!-- <input type="text" autofocus name="txttipo_identificador" id="txttipo_identificador" value="<?php //echo $tipoIdentificador; ?>" required> -->
                    </p>
                    <p style="margin:0;">
                        <label for="txtnumidentificador">Num. Identificador</label>
                        <input type="text" name="txtnumidentificador" id="txtnumidentificador"
                            value="<?php echo $numIdentificador; ?>" required>
                    </p>
                    <script>
                        // Obtenemos el elemento del campo de selección
                        const select = document.getElementById("txttipo_identificador");

                        // Obtenemos el elemento del campo de texto
                        const input = document.getElementById("txtnumidentificador");

                        // Agregamos un evento de cambio al campo de selección
                        select.addEventListener("change", function () {
                            // Obtenemos el valor seleccionado del campo de selección
                            const valorSeleccionado = select.value;

                            // Si el valor seleccionado es "Cédula"
                            if (valorSeleccionado === "Cédula") {
                                FORMATODECEDULA();

                                // Establecemos el placeholder del campo de texto
                                input.placeholder = "123-1234567-1";
                                // Establecemos la máscara de entrada del campo de texto
                                input.inputmask("###-########-#");




                            } else {
                                FORMATODECEDULA();
                                // Establecemos el placeholder del campo de texto
                                input.placeholder = "XXXXXXXXX";
                                // Eliminamos la máscara de entrada del campo de texto
                                input.inputmask("");
                            }
                        });


                        function cargarPagina() {
                            // Obtener el elemento del campo de selección
                            const select = document.getElementById("txttipo_identificador");

                            // Obtener el elemento del campo de texto
                            const input = document.getElementById("txtnumidentificador");

                            // Agregar evento de cambio al campo de selección
                            select.addEventListener("change", function () {
                                // Obtener el valor seleccionado del campo de selección
                                const valorSeleccionado = select.value;

                                // Si el valor seleccionado es "Cédula"
                                if (valorSeleccionado === "Cédula") {
                                    // Establecer el placeholder del campo de texto
                                    input.placeholder = "123-1234567-1";
                                    // Establecer la máscara de entrada del campo de texto
                                    input.inputmask("###-########-#");


                                } else {
                                    // Establecer el placeholder del campo de texto
                                    input.placeholder = "XXXXXXXXX";
                                    // Eliminar la máscara de entrada del campo de texto
                                    input.inputmask("");
                                    // Eliminar el evento de máscara de entrada
                                    input.removeEventListener('input', cedulaMask);
                                }
                            });

                            // Disparar el evento de cambio al cargar la página
                            select.dispatchEvent(new Event("change"));
                        }


                    </script>



                    <script>
                        function FORMATODECEDULA() {
                            const valorSeleccionado = select.value;

                            // Si el valor seleccionado es "Cédula"
                            if (valorSeleccionado === "Cédula") {
                                // Obtener el elemento del campo de Cédula
                                var txtCedula = document.getElementById('txtnumidentificador');

                                // Definir la máscara de entrada
                                var cedulaMask = function (event) {
                                    var cedulaValue = event.target.value;
                                    var cedulaFormatted = cedulaValue.replace(/\D/g, '')
                                        .replace(/(\d{3})(\d{7})(\d{1})/, '$1-$2-$3');
                                    event.target.value = cedulaFormatted;
                                };
                                txtCedula.maxLength = 13;
                                // Aplicar la máscara de entrada al escribir en el campo
                                txtCedula.addEventListener('input', cedulaMask);

                                // Guardar la función de máscara en una propiedad del elemento
                                txtCedula.cedulaMask = cedulaMask;
                            } else {


                                // Obtener el elemento del campo de texto
                                var txtCedula = document.getElementById('txtnumidentificador');

                                // Remover la máscara de entrada del campo
                                if (txtCedula.cedulaMask) {
                                    txtCedula.maxLength = 50;
                                    txtCedula.removeEventListener('input', txtCedula.cedulaMask);
                                }
                            }
                        }

                    </script>
                    <br>
                    <p>
                        <label for="txtnombre">Nombre</label>
                        <input type="text" name="txtnombre" id="txtnombre" value="<?php echo $nombre; ?>" required>
                    </p>
                    <p>
                        <label for="txtapellido">Apellido</label>
                        <input type="text" name="txtapellido" id="txtapellido" value="<?php echo $apellido; ?>"
                            required>
                    </p>
                    <p>
                        <label for="txtparentesco">Parentesco</label>
                        <select id="txtparentesco" name="txtparentesco" style=" width: 110px; " autocomplete="off"
                            require>
                            <option selected value="Madre">Madre</option>
                            <option <?php echo ($parentesco == 'Padre') ? 'selected' : ''; ?> value="Padre">Padre</option>
                            <option <?php echo ($parentesco == 'Tutor/a Legal') ? 'selected' : ''; ?> value="Tutor/a Legal">Tutor/a Legal</option>
                            <option <?php echo ($parentesco == 'Abuela/o') ? 'selected' : ''; ?> value="Abuela/o">Abuela/o</option>
                            <option <?php echo ($parentesco == 'Tía/o') ? 'selected' : ''; ?> value="Tía/o">Tía/o</option>
                            <option <?php echo ($parentesco == 'Padrastro/Madrastra') ? 'selected' : ''; ?> value="Padrastro/Madrastra">Padrastro/Madrastra</option>
                            <option <?php echo ($parentesco == 'hermano/a') ? 'selected' : ''; ?> value="hermano/a">Hermano/a</option>
                            <option <?php echo ($parentesco == 'Hermanastro/a') ? 'selected' : ''; ?> value="Hermanastro/a">Hermanastro/a</option>
                            <option <?php echo ($parentesco == 'NA') ? 'selected' : ''; ?> value="NA">No Aplica</option>
                        </select>
                        <!-- <input type="text" name="txtparentesco" id="txtparentesco" value="<?php //echo $parentesco; ?>" required> -->
                    </p>
                    <p>
                        <label for="txtnacionalidad">Nacionalidad</label>
                        <select id="txtnacionalidad" name="txtnacionalidad" title="Seleccione nacionalidad"
                            style=" width:250px" required>
                            <option value="Afganistán">Afganistán</option>
                            <option value="Albania">Albania</option>
                            <option value="Alemania">Alemania</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antártida">Antártida</option>
                            <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                            <option value="Antillas Holandesas">Antillas Holandesas</option>
                            <option value="Arabia Saudí">Arabia Saudí</option>
                            <option value="Argelia">Argelia</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaiyán">Azerbaiyán</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrein">Bahrein</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Bélgica">Bélgica</option>
                            <option value="Belice">Belice</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermudas">Bermudas</option>
                            <option value="Bielorrusia">Bielorrusia</option>
                            <option value="Birmania">Birmania</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brasil">Brasil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Bután">Bután</option>
                            <option value="Cabo Verde">Cabo Verde</option>
                            <option value="Camboya">Camboya</option>
                            <option value="Camerún">Camerún</option>
                            <option value="Canadá">Canadá</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Chipre">Chipre</option>
                            <option value="Ciudad del Vaticano (Santa Sede)">Ciudad del Vaticano (Santa Sede)</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comores">Comores</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, República Democrática del">Congo, República Democrática del</option>
                            <option value="Corea">Corea</option>
                            <option value="Corea del Norte">Corea del Norte</option>
                            <option value="Costa de Marfíl">Costa de Marfíl</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Croacia">Croacia (Hrvatska)</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Dinamarca">Dinamarca</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egipto">Egipto</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Eslovenia">Eslovenia</option>
                            <option value="España">España</option>
                            <option value="Estados Unidos">Estados Unidos</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Etiopía">Etiopía</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Filipinas">Filipinas</option>
                            <option value="Finlandia">Finlandia</option>
                            <option value="Francia">Francia</option>
                            <option value="Gabón">Gabón</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Granada">Granada</option>
                            <option value="Grecia">Grecia</option>
                            <option value="Groenlandia">Groenlandia</option>
                            <option value="Guadalupe">Guadalupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guayana">Guayana</option>
                            <option value="Guayana Francesa">Guayana Francesa</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Haití">Haití</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hungría">Hungría</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Irak">Irak</option>
                            <option value="Irán">Irán</option>
                            <option value="Irlanda">Irlanda</option>
                            <option value="Isla Bouvet">Isla Bouvet</option>
                            <option value="Isla de Christmas">Isla de Christmas</option>
                            <option value="Islandia">Islandia</option>
                            <option value="Islas Caimán">Islas Caimán</option>
                            <option value="Islas Cook">Islas Cook</option>
                            <option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
                            <option value="Islas Faroe">Islas Faroe</option>
                            <option value="Islas Heard y McDonald">Islas Heard y McDonald</option>
                            <option value="Islas Malvinas">Islas Malvinas</option>
                            <option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
                            <option value="Islas Marshall">Islas Marshall</option>
                            <option value="Islas menores de Estados Unidos">Islas menores de Estados Unidos</option>
                            <option value="Islas Palau">Islas Palau</option>
                            <option value="Islas Salomón">Islas Salomón</option>
                            <option value="Islas Svalbard y Jan Mayen">Islas Svalbard y Jan Mayen</option>
                            <option value="Islas Tokelau">Islas Tokelau</option>
                            <option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
                            <option value="Islas Vírgenes (EEUU)">Islas Vírgenes (EEUU)</option>
                            <option value="Islas Vírgenes (Reino Unido)">Islas Vírgenes (Reino Unido)</option>
                            <option value="Islas Wallis y Futuna">Islas Wallis y Futuna</option>
                            <option value="Israel">Israel</option>
                            <option value="Italia">Italia</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japón">Japón</option>
                            <option value="Jordania">Jordania</option>
                            <option value="Kazajistán">Kazajistán</option>
                            <option value="Kenia">Kenia</option>
                            <option value="Kirguizistán">Kirguizistán</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Laos">Laos</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Letonia">Letonia</option>
                            <option value="Líbano">Líbano</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libia">Libia</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lituania">Lituania</option>
                            <option value="Luxemburgo">Luxemburgo</option>
                            <option value="Macedonia, Ex-República Yugoslava de">Macedonia, Ex-República Yugoslava de
                            </option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malasia">Malasia</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Maldivas">Maldivas</option>
                            <option value="Malí">Malí</option>
                            <option value="Malta">Malta</option>
                            <option value="Marruecos">Marruecos</option>
                            <option value="Martinica">Martinica</option>
                            <option value="Mauricio">Mauricio</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="México">México</option>
                            <option value="Micronesia">Micronesia</option>
                            <option value="Moldavia">Moldavia</option>
                            <option value="Mónaco">Mónaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Níger">Níger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk">Norfolk</option>
                            <option value="Noruega">Noruega</option>
                            <option value="Nueva Caledonia">Nueva Caledonia</option>
                            <option value="Nueva Zelanda">Nueva Zelanda</option>
                            <option value="Omán">Omán</option>
                            <option value="Países Bajos">Países Bajos</option>
                            <option value="Panamá">Panamá</option>
                            <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                            <option value="Paquistán">Paquistán</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Perú">Perú</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Polinesia Francesa">Polinesia Francesa</option>
                            <option value="Polonia">Polonia</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reino Unido">Reino Unido</option>
                            <option value="República Centroafricana">República Centroafricana</option>
                            <option value="República Checa">República Checa</option>
                            <option value="República de Sudáfrica">República de Sudáfrica</option>
                            <option value="República Dominicana" selected>República Dominicana</option>
                            <option value="República Eslovaca">República Eslovaca</option>
                            <option value="Reunión">Reunión</option>
                            <option value="Ruanda">Ruanda</option>
                            <option value="Rumania">Rumania</option>
                            <option value="Rusia">Rusia</option>
                            <option value="Sahara Occidental">Sahara Occidental</option>
                            <option value="Saint Kitts y Nevis">Saint Kitts y Nevis</option>
                            <option value="Samoa">Samoa</option>
                            <option value="Samoa Americana">Samoa Americana</option>
                            <option value="San Marino">San Marino</option>
                            <option value="San Vicente y Granadinas">San Vicente y Granadinas</option>
                            <option value="Santa Helena">Santa Helena</option>
                            <option value="Santa Lucía">Santa Lucía</option>
                            <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leona">Sierra Leona</option>
                            <option value="Singapur">Singapur</option>
                            <option value="Siria">Siria</option>
                            <option value="Somalia">Somalia</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="San Pedro y Miquelón">San Pedro y Miquelón</option>
                            <option value="Suazilandia">Suazilandia</option>
                            <option value="Sudán">Sudán</option>
                            <option value="Suecia">Suecia</option>
                            <option value="Suiza">Suiza</option>
                            <option value="Surinam">Surinam</option>
                            <option value="Tailandia">Tailandia</option>
                            <option value="Taiwán">Taiwán</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Tayikistán">Tayikistán</option>
                            <option value="Territorios franceses del Sur">Territorios franceses del Sur</option>
                            <option value="Timor Oriental">Timor Oriental</option>
                            <option value="Togo">Togo</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                            <option value="Túnez">Túnez</option>
                            <option value="Turkmenistán">Turkmenistán</option>
                            <option value="Turquía">Turquía</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Ucrania">Ucrania</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistán">Uzbekistán</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabue">Zimbabue</option>
                        </select>
                        <script>
    window.addEventListener('load', function () {
        // Variable de PHP que contiene el valor de nacionalidad
        var nacionalidadPhp = "<?php echo $nacionalidad; ?>";

        // Obtener el elemento del select
        var selectNacionalidad = document.getElementById("txtnacionalidad");

        // Recorrer las opciones del select
        for (var i = 0; i < selectNacionalidad.options.length; i++) {
            // Obtener el valor de la opción actual
            var opcionValor = selectNacionalidad.options[i].value;

            // Verificar si el valor coincide con la nacionalidad de PHP
            if (opcionValor === nacionalidadPhp) {
                // Establecer la opción como seleccionada
                selectNacionalidad.options[i].selected = true;
                // Romper el bucle, ya que hemos encontrado la coincidencia
                break;
            }
        }
    });
</script>

                        <!-- <input type="text" name="txtnacionalidad" id="txtnacionalidad" value="<?php //echo $nacionalidad; ?>" required> -->
                    </p>
                    <p>
                        <label for="txtsexo">Sexo</label>
                        <select id="txtsexo" name="txtsexo" style=" width: 140px; " autocomplete="off" require>
                            <option <?php echo ($sexo == 'Maculino') ? 'selected' : ''; ?> value="Maculino" >
                                Masculino</option>
                            <option <?php echo ($sexo == 'Femenino') ? 'selected' : ''; ?> value="Femenino">Femenino </option>
                        </select>
                        <!-- <input type="text" name="txtsexo" id="txtsexo" value="<?php //echo $sexo; ?>" required> -->
                    </p>
                    <p>
                        <label for="txtdireccion">Dirección</label>
                        <textarea name="txtdireccion" id="txtdireccion" required><?php echo $direccion; ?></textarea>
                        <!-- <input type="text" name="txtdireccion" id="txtdireccion" value="<?php echo $direccion; ?>" required> -->
                    </p>
                    <p>
                        <label for="txtocupacion">Ocupación</label>
                        <input type="text" name="txtocupacion" id="txtocupacion" value="<?php echo $ocupacion; ?>"
                            required>
                    </p>
                </fieldset>
                <div class="botones-container">
                    <button class="btn btn-primary boton" type="submit" name="btnmodificar" value="Modificar"
                        onClick="javascript: return confirm('¿Deseas modificar este Pariente del Niño/a');"> <i
                            class="material-icons"
                            style="font-size:21px;color:white;text-shadow:2px 2px 4px #000000;">edit</i>
                        Modificar</button>

                    <?php echo "<a  class='btn btn-primary boton' href=\"../../mant_padres_pacientes.php?pag=$pagina\"><i class='material-icons' style='font-size:21px;text-shadow:2px 2px 4px #000000;vertical-align: text-bottom;'  >close</i> Cancelar</a>"; ?>
                </div>
                <iframe id="modal-iframe" src="../../consulta_padrespacientes2.php" frameborder="0"
                    style="width: 100%; height: 100%;max-height:500px;"></iframe>
        </fieldset>
        </form>
    </div>
</body>

</html>
<?php

if (isset($_POST['btnmodificar'])) {
    $numIdentificador = $_POST['txtnumidentificador'];
    $tipoIdentificador = $_POST['txttipo_identificador'];
    $nombre = $_POST['txtnombre'];
    $apellido = $_POST['txtapellido'];
    $parentesco = $_POST['txtparentesco'];
    $nacionalidad = $_POST['txtnacionalidad'];
    $sexo = $_POST['txtsexo'];
    $direccion = $_POST['txtdireccion'];
    $ocupacion = $_POST['txtocupacion'];

    $querymodificar = mysqli_query($conn, "UPDATE datos_padres_de_pacientes SET Numidentificador='$numIdentificador',
    Tipo_Identificador='$tipoIdentificador',
    Nombre='$nombre',
    Apellido='$apellido',
    Parentesco='$parentesco',
    Nacionalidad='$nacionalidad',
    Sexo='$sexo',
    Direccion='$direccion',
    Ocupacion='$ocupacion' WHERE Numidentificador='$numIdentificador1'");
    echo "<script>window.location= '../../mant_padres_pacientes.php?pag=$pagina' </script>";
}
?>