<?php
	session_start();	
	if (!isset($_SESSION['identificativo'])){
		die();
	}
	$cantidad=$_POST['cantidad'];
	$destino=$_POST['destino'];
	echo "Enviados $cantidad € a $destino.";
?>
