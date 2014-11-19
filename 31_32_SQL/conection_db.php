<?php
$enlace = new mysqli('localhost', 'root', '123456', 'libros');

if ( $enlace->connect_errno ) {
    printf("Falló la conexión: %s\n", $enlace->connect_error);
    exit();
}
?>