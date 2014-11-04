<?php
header('Content-Type: image/jpeg');
header("Content-Disposition:inline ; filename=img/fondo.jpeg");

$fuente = "OpenSans-Regular.ttf";
$texto = $_GET['txt'];

//$im = imagecreatetruecolor(300, 100);
$im = imagecreatefromjpeg('img/fondo.jpeg');

$color = imagecolorallocate($im, 255, 255, 255);

//dibuja elipse
//imagearc($im, 13, 13, 13 , 13, 13, 13, $negro);
//crear imagen rectángulo
//imagefilledrectangle($im, 0, 0, 299, 99, $rojo);

//tamaño de imagen
$width= imagesx($im);
$heigth= imagesy($im);
//tamaño de patron
$x=rand(4,($width/6));
$y=rand(4,$heigth/3);

for($i=0;$i<strlen($texto);$i++){
	$x=$x+rand(15,30)+$i;
	$y=$y+rand(5,15)+$i;
	imagefttext($im, rand(20,25), rand(0,269), $x, $y, $color, $fuente, $texto[$i]);
}

// Imprimir la imagen al navegador
imagepng($im);
imagedestroy($im);
?>