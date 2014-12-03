<?php
//Cabecera para qué lo qué imprima el archivo php sea una foto
header('Content-Type: image/jpeg');
header("Content-Disposition:inline ; filename=img/fondo.jpeg");

//Importacion de la imagen de fondo, para hacer el captcha
$im = imagecreatetruecolor(300, 300);

$fondo=imagecolorallocate($im,230, 230, 230);
imagefilledrectangle($im, 0, 0, 300, 300, $fondo);
//Especifica el color
$blue = imagecolorallocate($im, 93, 154, 255);
$orange = imagecolorallocate($im, 255, 188, 73);
$negro=imagecolorallocate($im,60, 60, 60);

$sisg=((360*$_GET['si'])/100);
$nosg=((360*$_GET['no'])/100)+$sisg;


imagefilledarc($im, 150, 130, 200, 200, 0, $sisg, $blue, IMG_ARC_PIE);
imagefilledarc($im, 150, 130, 200, 200, $sisg, $nosg, $orange, IMG_ARC_PIE);

imagefilledrectangle($im, 130,263, 145, 273, $blue);
imagestring($im, 5, 150,260,'Si :'.$_GET['si'].'% de votos', $negro);
imagefilledrectangle($im, 130,283, 145, 293, $orange);
imagestring($im, 5, 150,280,'No :'.$_GET['no'].'% de votos', $negro);
// Imprimir la imagen al navegador


imagepng($im);
imagedestroy($im);
?>