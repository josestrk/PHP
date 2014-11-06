<?php
header('Content-Type: image/jpeg');
header("Content-Disposition:inline ; filename=img/fondo.jpeg");

$fuente = "OpenSans-Regular.ttf";
$texto = $_GET['txt'];
// repasar $texto = preg_replace('//+\+/', '', $texto);

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
$min=strlen($texto);
$lit=(strlen($texto)<10) ? strlen($texto)+10:strlen($texto);
$x=0;

for($i=0;$i<strlen($texto);$i++){
	$l= rand($lit, ($lit+3));
	$x=$x+rand($l,($width/strlen($texto)));
	$y=rand(($l+15),($heigth-($l+15)));
	
	imagefttext($im, $l, rand(-45,45), $x, $y, $color, $fuente, $texto[$i]);
}

// Imprimir la imagen al navegador
imagepng($im);
imagedestroy($im);
?>