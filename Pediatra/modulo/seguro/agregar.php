<?php 
session_start();


require_once "../../include/conec.php";
require_once("../../mant_seguro.php");

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
		<tr><th colspan="2" >Agregar seguro</th></tr>
            <tr> 
                <td>Nombre del Seguro</td>
                <td><input type="text" name="txtseg" autocomplete="off"></td>
            </tr>
			 
            <tr> 	
               <td colspan="2" >
				  <?php echo "<a href=\"../../mant_seguro.php?pag=$pagina\">Cancelar</a>";?>
				   <input type="submit" name="btnregistrar" value="Registrar" onClick="javascript: return confirm('¿Deseas registrar a este seguro');">
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
	$vaiseg 	= $_POST['txtseg'];
	

	$queryadd	= mysqli_query($conn, "INSERT INTO seguro(Nombre) VALUES('$vaiseg')");
	
 	if(!$queryadd)
	{
		echo "Error con el registro: ".mysqli_error($conn);
		 //echo "<script>alert('DNI duplicado, intenta otra vez');</script>";
		 
	}else
	{
		echo "<script>window.location= '../../mant_seguro.php?pag=1' </script>";
	}
}
?>