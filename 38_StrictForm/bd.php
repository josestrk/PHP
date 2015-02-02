<?php
require_once 'config.php';

$conn = new mysqli(SERVER, USER, PASSWORD) or die('No se ha podido establecer una conexión: ' . mysqli_connect_error());

$db_create = "CREATE DATABASE IF NOT EXISTS inmobiliaria
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci";

$viviendas = "CREATE TABLE IF NOT EXISTS viviendas (
	id int(11) NOT NULL auto_increment,
	tipo int(2) NOT NULL,
	provincia int(2) NOT NULL,
	dormitorios int(3) NOT NULL,
	precio int(11) NOT NULL,
	piscina boolean NOT NULL,
	jardin boolean NOT NULL,
	garaje boolean NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (tipo) REFERENCES tipos(id),
	FOREIGN KEY (provincias) REFERENCES provincias(id),
) ENGINE = MyISAM";

$tipos = "CREATE TABLE IF NOT EXISTS tipos (
	id int(2) NOT NULL auto_increment,
	tipo varchar(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = MyISAM";

$provincias = "CREATE TABLE IF NOT EXISTS provincias (
	id int(11) NOT NULL auto_increment,
	nombre_es varchar(30) NOT NULL,
	nombre_coof varchar(30),
	PRIMARY KEY (id)
) ENGINE = MyISAM";

$conn->query($db_create) or die('Error al crear la base de datos: ' . $conn->error);

$conn->select_db('peliculaBD') or die('No se pudo establecer una conexión a la base de datos: ' . mysqli_connect_error());

$conn->set_charset('utf8') or die('Error al establecer UTF-8 como juego de caracteres predeterminado: ' . $conn->error);

$conn->query($tipos) or die ('Error al crear la tabla: ' . $conn->error);
$conn->query($provincias) or die ('Error al crear la tabla: ' . $conn->error);
$conn->query($viviendas) or die ('Error al crear la tabla: ' . $conn->error);

?>
