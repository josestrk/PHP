<?php
//Cabecera para qué lo qué imprima el archivo php sea una foto
header('Content-Type: image/jpeg');
header("Content-Disposition:inline ; filename=img/fondo.jpeg");

// Fichero y nuevo tamaño
$nombre_fichero = "14224355909917.jpg";//$_FILES[$nombre];
$porcentaje = 0.5;
// Tipo de contenido
header('Content-Type: image/jpeg');

// Obtener los nuevos tamaños
list($ancho, $alto) = getimagesize($nombre_fichero);
$nuevo_ancho =300;
$nuevo_alto = 300;
// Cargar
$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
$origen = imagecreatefromjpeg($nombre_fichero);

// Cambiar el tamaño
imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

// Imprimir
imagejpeg($thumb);
?>