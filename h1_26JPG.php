<?php
header("Content-type: image/jpg");
 
$img1 = imagecreatefromgif("img/fondo.jpg");
$fuente = "LUCON.TTF";
$color = imagecolorallocate($img1,0,0,0);
 
imagettftext($img1,30,0,28,50,$color,$fuente, "MEXICO");
 
imagegif($img1);
 
imagedestroy($img1);
?>