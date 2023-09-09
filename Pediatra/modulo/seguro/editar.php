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
		<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="caja_popup2">
  <form class="contenedor_popup" method="POST">
        <table>
		<tr><th colspan="2">Modificar seguro</th></tr>
             <tr> 
                <td>id del seguro</td>
                <td><input type="text" name="txtid" value="<?php echo $segid;?>" required readonly></td>
             </tr>
            <tr> 
                <td>Nombre del usario</td>
                <td><input type="text" name="txtseg" value="<?php echo $segnom;?>" required></td>
            </tr>
			
				
                <td colspan="2">
				 <?php echo "<a href=\"../../mant_seguro.php?pag=$pagina\">Cancelar</a>";?>
				<input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este seguro?');">
				</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
	
	if(isset($_POST['btnmodificar']))
{   $idseg1 = $_POST['txtid'];
	$seg1 = $_POST['txtseg'];
      
    $querymodificar = mysqli_query($conn, "UPDATE seguro SET Id_seguro_salud ='$idseg1',Nombre='$seg1' WHERE Id_seguro_salud =$idseg1");
	echo "<script>window.location= '../../mant_seguro.php?pag=$pagina' </script>";
    
}
?>