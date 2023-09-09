

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<h1>Lista de Mantenimientos</h1>
<a href="menu.php">Volver al menu</a>

</br>
 
    <a href="agregaruser.php">
<div class="card">
  <div class="card-title">Mantenimientos user</div>
   
  <img src="IMAGENES/Mantenimientos.png" class="card-icon" alt="Mantenimientos">
         
  <div class="card-description">Esta opción te permite realizar operaciones de mantenimiento sobre las tablas de la base de datos, como crear, modificar, eliminar o consultar registros. También puedes realizar copias de seguridad y restaurar la información en caso de pérdida o daño.</div>
</div>
         </a>

         <a href="mant_seguro">
<div class="card">
  <div class="card-title">mantenimiento Seguro</div>
  <img src="IMAGENES/Mantenimientos.png" class="card-icon" alt="Procesos">
  <div class="card-description">Esta opción te permite ejecutar procesos que involucran varias tablas de la base de datos, como calcular el salario de los empleados, generar facturas, actualizar el inventario, etc. Puedes ver el resultado de los procesos en pantalla o en archivos.</div>
</div>
</a>
<div class="card">
  <div class="card-title">Consultas</div>
  <img src="IMAGENES/consultas.png" class="card-icon" alt="Consultas">
  <div class="card-description">Esta opción te permite realizar consultas personalizadas sobre la base de datos, usando criterios de selección, ordenación, agrupación y filtrado. Puedes ver el resultado de las consultas en pantalla o en archivos.</div>
</div>

<div class="card">
  <div class="card-title">Reportes</div>
  <img src="IMAGENES/reportes.png" class="card-icon" alt="Reportes">
  <div class="card-description">Esta opción te permite generar reportes gráficos o estadísticos sobre la base de datos, usando diferentes tipos de gráficos, como barras, líneas, tortas, etc. Puedes ver el resultado de los reportes en pantalla o en archivos.</div>
</div>
    <div style='width: 100%;float: left;'>
      <form action="index.php" method="POST">
        <input type="submit" value="Regresar al login">
    </form>
</div>

</body>
</html>

