<?php 
session_start();


require_once "../../include/conec.php";
require_once("../../Agregaruser.php");

$pagina = $_GET['pag'];
$coddni = $_GET['id_usuario'];

$querybuscar = mysqli_query($conn, "SELECT * FROM usuario WHERE id_usuario=$coddni");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $usuid 	= $mostrar['id_usuario'];
	$usunom 	= $mostrar['nombre_usuario'];
	$usupass 	= $mostrar['pass1'];
        $usuconfpass 	= $mostrar['confirm_pass'];
	$usuestado 	= $mostrar['estado'];
        $usunomcom 	= $mostrar['nombre_completo'];
        $usurol 	= $mostrar['rol'];
}
?>
<html>
<head>    
		<title>VaidrollTeam</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="caja_popup2">
  <form class="contenedor_popup" method="POST">
        <table>
		<tr><th colspan="2">Modificar usuario</th></tr>
             <tr> 
                <td>id del usuario</td>
                <td><input type="text" name="txtid" value="<?php echo $usuid;?>" required readonly></td>
             </tr>
            <tr> 
                <td>Nombre del usario</td>
                <td><input type="text" name="txtnom" value="<?php echo $usunom;?>" required></td>
            </tr>
			   <tr> 
                <td>Contraseña</td>
                <td><input type="number" name="txtpass" value="<?php echo $usupass;?>" required></td>
            </tr>
        
            <tr> 
                <td>Confirmar contraseña</td>
                <td><input type="number" name="txtconfpass" value="<?php echo $usuconfpass;?>" required></td>
            </tr>
			  <tr> 
                <td>Estado</td>
                <td><input type="text" name="txtestado" value="<?php echo $usuestado;?>" required></td>
            </tr>
			  <tr> 
                <td>Nombre completo</td>
                <td><input type="text" name="txtnomcom" value="<?php echo $usunomcom;?>" required></td>
            </tr>
            </tr>
			  <tr> 
                <td>Rol</td>
                <td><input type="text" name="txtrol" value="<?php echo $usurol;?>" required></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"../../Agregaruser.php?pag=$pagina\">Cancelar</a>";?>
				<input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este usuario?');">
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
	
	if(isset($_POST['btnmodificar']))
{   $iduser1 = $_POST['txtid'];
	$nom1 = $_POST['txtnom'];
	$pass1 = $_POST['txtpass'];
	$confpass1 = $_POST['txtconfpass'];
	$estado1 = $_POST['txtestado'];
	$nomcom1 = $_POST['txtnomcom'];
    $rol1 = $_POST['txtrol'];
      
    $querymodificar = mysqli_query($conn, "UPDATE usuario SET id_usuario='$iduser1',nombre_usuario='$nom1', pass1='$pass1',confirm_pass='$confpass1',estado='$estado1',nombre_completo='$nomcom1',rol='$rol1' WHERE id_usuario=$iduser1");
	echo "<script>window.location= '../../Agregaruser.php?pag=$pagina' </script>";
    
}
?>