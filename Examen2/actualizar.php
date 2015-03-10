<?php
if($_POST['qty']>0){
    $ca=$_SESSION['carrito'];
    $article=new Producto($_POST['id'],$_POST['nombre'],$_POST['info'],$_POST['precio']);
    if($ca->artFind($_POST['id']))
        $ca->modCant($_POST['id'],$_POST['qty']);
    else{
        $ca->addArt($article);
    }
    $_SESSION['carrito']=$ca;
    echo'<div class="alertok">SE AÑADIERON ' . $_POST['qty'] . ' productos ' . $_POST['id'] . '</div>';
}else{
    $_SESSION['carrito']->quitArt($_POST['id']);
    echo'<div class="alert">Se borró el producto del carrito</div>';  
}
?>
