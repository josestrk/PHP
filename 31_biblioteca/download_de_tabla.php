<?php
if(isset($_GET['id']) ) 
	{ 
		header("Content-type: image/jpg");
		require('conexionmysql.php');// se pierde la conexion al salir de la pagina de index asi que volvemos a conectar
    	$id      = $_GET['id']; 
    	$query   = "SELECT imagen FROM caratulas WHERE id = ' ".$id." '"; 
    	$result  = mysql_query($query) or die('Error, query failed'); 
		
    	list($content) = mysql_fetch_array($result); 

    	//header("Content-Disposition: attachment; filename=$name"); 
    	//header("Content-length: $size");  
    	echo $content; 

    	mysql_close();
    	exit; 
	} 
?>
