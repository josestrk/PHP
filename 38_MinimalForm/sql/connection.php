<?php
$mysqli = new mysqli(SERVER, USER, PASS);

if ( $mysqli->connect_errno ) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}else{
	$mysqli->select_db(BBDD);
	if ( $mysqli->connect_errno ) {
    	echo ("Debe crear la base de datos\n");
    	echo "<a href='crear.php' style='-webkit-border-radius: 11;-moz-border-radius: 11;font-size: 15px;border-radius: 11px;font-family: Arial; color: #0ea4f5;padding: 10px 30px;margin: 3px; border: solid #0ea4f5 2px;text-decoration: none;display: inline-block;'>Crear base de datos</a>";
	}
}
?>	