<?php
if($_POST['qty']>0){
    $ca=$_SESSION['carrito'];
    $article=new Producto($_POST['id'],$_POST['nombre'],$_POST['info'],$_POST['precio']);
    for($i=0;$i<$_POST['qty'];$i++){
        $ca->addArt($article);
    }
    $_SESSION['carrito']=$ca;
    echo'<div class="alertok">SE AÑADIERON ' . $i . ' productos</div>';
}else{
    $_SESSION['carrito']->quitArt($_POST['id']);
    echo'<div class="alert">Se borró el producto del carrito</div>';  
}
?>
