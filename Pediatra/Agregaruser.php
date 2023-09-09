<?php
include ("include/conec.php"); 

?>
<!--Busca por VaidrollTeam para más proyectos. -->
<html>
<head>    
		<title>VaidrollTeam</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css"  href="css/style.css">
		<link rel="icon" href="logo.png">
        <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">


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
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  
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
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <!-- Incluir Botones de impresión -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  
</head>
<body>
    <?php
 
    $filasmax = 5;
 
    if (isset($_GET['pag'])) 
	{
        $pagina = $_GET['pag'];
    } else 
	{
        $pagina = 1;
    }
 
 if(isset($_POST['btnbuscar']))
{
$buscar = $_POST['txtbuscar'];

 $sqlusu = mysqli_query($conn, "SELECT * FROM usuario where id_usuario = '".$buscar."'");

}
else
{
 $sqlusu = mysqli_query($conn, "SELECT * FROM usuario ORDER BY id_usuario ASC LIMIT " . (($pagina - 1) * $filasmax)  . "," . $filasmax);
}
 
    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_usuarios FROM usuario");
 
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_usuarios'];
	
    ?>
	<div class="cont" >
	<form method="POST">
	<h1>Lista de usuarios</h1>
	
    <a href="menu_mant.php">Volver al menu</a>
	<a href="agregaruser.php">Inicio</a>
	
		<?php echo "<a href=\"modulo/user/agregar.php?pag=$pagina\">Crear usuario</a>";?>
			<input type="submit" value="Buscar" name="btnbuscar">
			<input type="text" name="txtbuscar"  placeholder="Ingresar DNI de usuario" autocomplete="off" style='width:20%'>
			</form>
            <script>
  $(document).ready(function() {
    $('#ejemplo').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
  </script>
    <table id="ejemplo" class="display nowrap" style="width:100%">
     <thead>
			<tr>
			<th>id usuario</th>
			<th>nombre del usuario</th>
             <th>contraseña</th>
             <th>estado</th>
             <th>nombre completo</th>
			<th>rol</th>
            <th></th>
			</tr>
      </thead>
        <?php
 
        while ($mostrar = mysqli_fetch_assoc($sqlusu)) 
		{
			
            echo "<tr>";
            echo "<td>".$mostrar['id_usuario']."</td>";
	    echo "<td>".$mostrar['nombre_usuario']."</td>";
            echo "<td>".$mostrar['Pass1']."</td>";    
	    echo "<td>".$mostrar['estado']."</td>";  
	    echo "<td>".$mostrar['nombre_completo']."</td>";  
        echo "<td>".$mostrar['rol']."</td>"; 
            echo "<td style='width:24%'>
			<a href=\"modulo/user/ver.php?id_usuario=$mostrar[id_usuario]&pag=$pagina\">Ver</a> 
			<a href=\"modulo/user/editar.php?id_usuario=$mostrar[id_usuario]&pag=$pagina\">Modificar</a> 
			<a href=\"modulo/user/eliminar.php?id_usuario=$mostrar[id_usuario]&pag=$pagina\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[nombre_completo]?')\">Eliminar</a>
			</td>";  
			
        }
 
        ?>
    </table>
    
	<div style='text-align:right'>
	<br>
	<?php echo "Total de usuarios: ".$maxusutabla;?>
	</div>
	</div>
<div style='text-align:right'>
<br>
</div>
    <div style="text-align:center">
        <?php
        if (isset($_GET['pag'])) {
		   if ($_GET['pag'] > 1) {
                ?>
					<a href="Agregaruser.php?pag=<?php echo $_GET['pag'] - 1; ?>">Anterior</a>
            <?php
					} 
				else 
					{
                    ?>
					<a href="#" style="pointer-events: none">Anterior</a>
            <?php
					}
                ?>
 
        <?php
        } 
		else 
		{
            ?>
            <a href="#" style="pointer-events: none">Anterior</a>
            <?php
        }
 
        if (isset($_GET['pag'])) {
            if ((($pagina) * $filasmax) < $maxusutabla) {
                ?>
            <a href="Agregaruser.php?pag=<?php echo $_GET['pag'] + 1; ?>">Siguiente</a>
        <?php
            } else {
                ?>
            <a href="#" style="pointer-events: none">Siguiente</a>
        <?php
            }
            ?>
        <?php
        } else {
            ?>
            <a href="Agregaruser.php?pag=2">Siguiente</a>
        <?php
        }
 
        ?>
    </div>
    <a href="menu.php">Volver al menu</a>
    </form>
</div>
</body>
</html>