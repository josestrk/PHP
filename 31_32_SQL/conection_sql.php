<?php
$enlace = new mysqli('localhost', 'root', '123456');
	if ( $enlace->connect_errno ) {
	   $mensaje="Falló la conexión";
	   $alert = "alert";
	}
?>