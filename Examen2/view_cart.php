<?php
function view(){
    $ca=$_SESSION['carrito'];
    
    if($ca->getNum()==0){
        throw new Exception ('No se accedio a datos');
    }else{
        if(isset($_GET['quit'])){
            $idq=$_GET['quit'];
            $ca->quitArt($idq);
        }
        echo $ca->dibujarConFoto("index2=2&view_cart=1");
    }
}

try{
    view();
}catch(Exception $e){
    echo'<div class="alert">'.$e->getMessage().'</div>';
}
?>