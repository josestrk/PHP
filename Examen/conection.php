<?php
$mysqli = new mysqli('localhost', 'root', '123456');

if ($mysqli->connect_error) die('Error de Conexión ('.$mysqli->connect_errno.') ' .$mysqli->connect_error);

$sqlbd= "CREATE DATABASE IF NOT EXISTS EMPRESA DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_spanish_ci;";
if(!$on = $mysqli->query( $sqlbd))	die('<div class="alertFAIL">Error de la creación de la bbdd</div>');

$mysqli->select_db('EMPRESA');
?>