
<?php

require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
//$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));
$password = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password'])))));

if (!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {

	$query = mysqli_query($mysqli, "SELECT * 
	FROM usuario 
	WHERE user='$username' 
	AND pass='$password' AND estado='activo'")
									or die('error'.mysqli_error($mysqli));
	$rows  = mysqli_num_rows($query);

	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();
		$_SESSION['id_usuario']   = $data['id_user'];
		$_SESSION['username']  = $data['username'];
		$_SESSION['password']  = $data['password'];
		$_SESSION['name_user'] = $data['name_user'];
		$_SESSION['permisos_acceso'] = $data['permisos_acceso'];
	
		header("Location: main.php?module=start");
	}


	else {
		header("Location: index.php?alert=1");
	}
}
?>