<?php
	session_start();	
	if (isset($_GET['terminar_sesion'])){
		//Borramos todas las variables de la sesión
		$_SESSION=array();
		//Caducamos la cookie
		setcookie('PHPSESSID','',time()-3600);
		//destruimos los datos de la sesión en el script actual
		session_destroy();
		//redirigimos a la página de acreditación
		header('Location: transferencia.php');
	}
	if (!isset($_SESSION['identificativo'])){
		header('Location: transferencia.php');
	}
	echo '<a href="informacion.php?terminar_sesion=1">Terminar sesion</a><br />';
	echo '<a href="http://www.google.es">GOOGLE</a><br />';
	echo '<a href="transferencia.php">Realizar transferencia</a><br />';
?>
