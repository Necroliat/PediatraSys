<?php
include './Connet.php';
$restorePoint=SGBD::limpiarCadena($_POST['restorePoint']);
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
$totalQueries = count($sql) - 1;
for($i = 0; $i < (count($sql)-1); $i++){
    if(SGBD::sql("$sql[$i];")){  }else{ $totalErrors++; }
}
if($totalErrors<=0){
	echo "Restauración completada con éxito. Se ejecutaron $totalQueries consultas.";
	//echo "Restauración completada con éxito";
}else{
	echo "Ocurrio un error inesperado, no se pudo hacer la restauración completamente";
}