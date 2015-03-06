<?php 
$info=new Producto(0,'','',0);
try{
    $info=detail($mysqli,$_GET['detail']);
}catch(Exception $e){
    echo'<div class="alert">'.$e->getMessage().'</div>';
}
?>
<div>
<h3></h3>
    <div class="div"><h2><?php echo $info->getNombre() ?></h2>
    <div class="imagen"><?php echo $info->getFoto() ?></div>
    <div class="define">
        <div class="detail"><?php echo $info->getInfo() ?></div>
        <div class="product"><?php echo  $info->getId(); ?></div>
        <div class="precio"><?php echo $info->getPrecio(); ?> €</div>
        <div class="Quantity">
            <?php
echo '<form class="formLS" action="index.php?index2=2&detail=' . $_GET['detail'] . '&actuliza=yes" method = "POST">';
//hidens
echo '<input type="hidden" value="' . $info->getId() . '" name="id"/>';
echo '<input type="hidden" value="' . $info->getNombre() . '" name="nombre"/>';
echo '<input type="hidden" value="' . $info->getInfo() . '" name="info"/>';
echo '<input type="hidden" value="' . $info->getPrecio() . '" name="precio"/>';
if($ca->artFind($info->getId())){
    echo '<div>Quantity</div><div><input name="qty" type="number" style="margin:auto;" value="' . $ca->getCant($info->getId()) . '" required />
        <input type="submit" value="Add to Cart" class="sb" style="width:100px" required /></div>';
}else{ 
    echo '<input name="qty" type="hidden" style="margin:auto;" value="1" required />';
    echo '<input type="submit" value="Change Quantity" class="sb" style="width:200px" required />'; 
}
echo '<form>';
             ?>
        </div>
    </div>
</div>
</div>