<?php
require_once "../../include/conec.php";

$pagina = $_GET['pag'];
$coddni = $_GET['id_usuario'];

mysqli_query($conn, "DELETE FROM usuarios WHERE id_usuario=$coddni");
 
header("Location:Agregaruser.php?pag=$pagina");

?>