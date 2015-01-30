<?php
define ('SERVER','localhost');
define ('USER','root');
define ('PASS', '123456');
define ('BBDD','libreria');

$on = new mysqli(SERVER, USER, PASS);

if ( $on->connect_errno ) {
    printf("Falló la conexión: %s\n", $on->connect_error);
    exit();
}else{
	if ( !$start= $on->select_db(BBDD) ) {
    	echo "<div class='alert'>Debe crear la base de datos</div>";
    	echo "<a href='crear.php' style='-webkit-border-radius: 11;-moz-border-radius: 11;font-size: 15px;border-radius: 11px;font-family: Arial; color: #0ea4f5;padding: 10px 30px;margin: 3px; border: solid #0ea4f5 2px;text-decoration: none;display: inline-block;'>Crear base de datos</a>";
	}
}
?>