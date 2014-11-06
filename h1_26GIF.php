<?php

header('Content-Type: image/gif');
header("Content-Disposition:inline ;");

session_start();
 
$img1 = imagecreatefromgif("CAPTCHA0.gif");
$img2 = imagecreatefromgif("CAPTCHA1.gif");
$fuente = "OpenSans-Regular.ttf";
$color = imagecolorallocate($img1,0,0,0);
 
imagettftext($img1,30,0,28,50,$color,$fuente, $_SESSION["GCAPTCHA"]);
imagecopymerge($img1,$img2,0,0,0,0,200,75,80);
 
imagegif($img1);
 
imagedestroy($img2);
imagedestroy($img1);
?>