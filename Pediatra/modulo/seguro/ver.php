<?php 
session_start();


require_once "../../include/conec.php";
require_once("../../mant_seguro.php");

$pagina = $_GET['pag'];
$coddni = $_GET['Id_seguro_salud'];

$querybuscar = mysqli_query($conn, "SELECT * FROM seguro WHERE Id_seguro_salud =$coddni");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $segid 	= $mostrar['Id_seguro_salud'];
	$segnom 	= $mostrar['Nombre'];
	
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
                <td>id: </td>
                <td><?php echo $segid;?></td>
            </tr>
			   <tr> 
                <td>Nombre: </td>
                <td><?php echo $segnom;?></td>
            </tr>
        
            
				
                <td colspan="2">
				 <?php echo "<a href=\"../../mant_seguro.php?pag=$pagina\">Regresar</a>";?>
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>