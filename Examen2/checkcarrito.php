<?php
function check(){
    session_start();
    if( !isset($_SESSION['carrito']) ){
       $_SESSION['carrito']=new Carrito(1,array());
       return false;
    }else{
        $_SESSION['db_is_logged_in'] = true;// activa la sesion
        return true;
    }
}
function destroy(){
    session_start();
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
}
?>
