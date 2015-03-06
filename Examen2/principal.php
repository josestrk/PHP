<?php
require_once('config.php');
require_once("sql/connection.php");

function mostrar($mysqli){
    $sql="SELECT product_code as id, name as nombre, price as precio FROM ecomm_products ";
    $mysqli->query("SET NAMES 'utf8'");
    $reslist = $mysqli -> query($sql);
    
    if(!$reslist){
        throw new Exception ('No se accedio a datos');
    }else{
        $i=0;
        echo "<table style='width:100%'>";
        while($rowlist=$reslist->fetch_assoc()){
            $st = '';
            $i++;
            $prd = new Producto( $rowlist['id'],  $rowlist['nombre'],'', $rowlist['precio']);
            if($i%2==0)
                $st="style='background: linen;'";
            echo "<tr $st><td style='width:200px'>" . $prd->getFoto() . "</td><td>
                <a href='" . $_SERVER['PHP_SELF'] ."?index2=2&detail=" . $prd->getId() . "'>"
                . $prd->getNombre() . "</a></td><td style='text-align: right;'>" 
                . $prd->getPrecio() . " €</td></tr>";
        }
        echo "</table>";
    }
}
function detail($mysqli,$id){
    $sql="SELECT product_code as id, name as nombre,description as detail, price as precio FROM ecomm_products WHERE product_code=" . $id;
    $mysqli->query("SET NAMES 'utf8'");
    $reslist = $mysqli -> query($sql);

    if(!$reslist){
        throw new Exception ('No existe este producto (ID:' . $id . ')');
    }else{
        $i=0;
        $rowlist=$reslist->fetch_assoc();
            if($rowlist == null){
                throw new Exception ('No existe este producto (ID:' . $id . ')');
            }else{
            $prd = new Producto( $rowlist['id'],  $rowlist['nombre'],$rowlist['detail'], $rowlist['precio']);
            return $prd;
            }
    }
}
?>