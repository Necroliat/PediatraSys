<?php
require_once "../../include/conec.php";

$pagina = $_GET['pag'];
$coddni = $_GET['Id_seguro_salud'];

mysqli_query($conn, "DELETE FROM seguro WHERE Id_seguro_salud =$coddni");
 
header("Location:../../mant_seguro.php?pag=$pagina");

?>