<?php
$on = new mysqli('localhost', 'root', '123456', 'libreria');
if ( $on->connect_errno ) {
    printf("Falló la conexión: %s\n", $enlace->connect_error);
    exit();
}
?>