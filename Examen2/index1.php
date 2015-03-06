<?php
$prd1= new Producto('1','buzo','',10);
$prd2= new Producto('2','cha','',4);
$prd3= new Producto('3','pap','',15);

if(!isset($_SESSION['carrito1']))
    $df = new Carrito(10,[$prd1,$prd2,$prd3]);
else
    $df=$_SESSION['carrito1'];

if(isset($_GET['quit'])){
    $idq=$_GET['quit'];
    $df->quitArt($idq);
}

echo $df->dibujar("index1=1");

$_SESSION['carrito1']=$df;
?>