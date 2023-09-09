<?php 
session_start();


require_once "../../include/conec.php";
require_once("../../Agregaruser.php");

$pagina = $_GET['pag'];
?>
<html>
<head>    
		<title>VaidrollTeam</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="caja_popup2"> 
  <form class="contenedor_popup" method="POST">
        <table>
		<tr><th colspan="2" >Agregar usuario</th></tr>
            <tr> 
                <td>Nombre de usuario</td>
                <td><input type="text" name="txtnom" autocomplete="off"></td>
            </tr>
			 <tr> 
                <td>Contraseña</td>
                <td><input type="number" name="txtpass1" autocomplete="off"></td>
            </tr>
            <tr> 
                <td>Confirmar Contraseña</td>
                <td><input type="number" name="txtconfi" autocomplete="off"></td>
            </tr>
            <tr> 
                <td>estado</td>
                <td><input type="text" name="txtest" autocomplete="off"></td>
            </tr>
			  <tr> 
                <td>Nombre completo</td>
                <td><input type="text" name="txtnomcom" autocomplete="off"></td>
            </tr>
            <tr> 
                <td>rol</td>
                <td><input type="text" name="txtrol" autocomplete="off"></td>
            </tr>
            <tr> 	
               <td colspan="2" >
				  <?php echo "<a href=\"../../agregaruser.php?pag=$pagina\">Cancelar</a>";?>
				   <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este usuario');">
			</td>
            </tr>
        </table>
    </form>
 </div>
</body>
</html>
<?php

		if(isset($_POST['btnregistrar']))
{   
	$vaiusu 	= $_POST['txtnom'];
	$vaipass 	= $_POST['txtpass1'];
        $vaiconf 	= $_POST['txtconfi'];
	$vaiestado 	= $_POST['txtest'];
        $vainomcom 	= $_POST['txtnomcom'];
        $vairol 	= $_POST['txtrol'];

	$queryadd	= mysqli_query($conn, "INSERT INTO usuario(nombre_usuario,pass1,confirm_pass,estado,nombre_completo,rol) VALUES('$vaiusu','$vaipass','$vaiconf','$vaiestado','$vainomcom','$vairol')");
	
 	if(!$queryadd)
	{
		echo "Error con el registro: ".mysqli_error($conn);
		 //echo "<script>alert('DNI duplicado, intenta otra vez');</script>";
		 
	}else
	{
		echo "<script>window.location= '../../Agregaruser.php?pag=1' </script>";
	}
}
?>