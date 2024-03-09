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
	$usuestado 	= $mostrar['estado'];
        $usunomcom 	= $mostrar['nombre_completo'];
        $usurol 	= $mostrar['rol'];
}
?>
<html>
<head>    
		<title>VaidrollTeam</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="caja_popup2">
  <form class="contenedor_popup" method="POST">
        <table>
		<tr><th colspan="2">Ver usuario</th></tr>
            <tr> 
                <td>Nombre: </td>
                <td><?php echo $usuid;?></td>
            </tr>
			   <tr> 
                <td>DNI: </td>
                <td><?php echo $usunom;?></td>
            </tr>
        
            <tr> 
                <td>Dirección: </td>
                <td><?php echo $usupass;?></td>
            </tr>
			  <tr> 
                <td>Telefono: </td>
                <td><?php echo $usuestado;?></td>
            </tr>
			  <tr> 
                <td>Correo: </td>
                <td><?php echo $usunomcom;?></td>
            </tr>
            <tr> 
                <td>Correo: </td>
                <td><?php echo $usurol;?></td>
            </tr>
            <tr>
				
                <td colspan="2">
				 <?php echo "<a href=\"../../Agregaruser.php?pag=$pagina\">Regresar</a>";?>
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>