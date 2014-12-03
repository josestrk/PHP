<?php
require_once('configure.php');
$mysqli = new mysqli(SERVER, USER, PASS, BBDD);

if ( $mysqli->connect_errno ) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}
?>	