<?php
	$sql = "SELECT count(VOTO) FROM EMP;";
	$resultado = $mysqli -> query( $sql );
	$fila = $resultado->fetch_array(MYSQLI_NUM);
	$total=$fila[0];
	$sql = "SELECT count(VOTO) FROM EMP WHERE VOTO=1;";
	$resultado = $mysqli -> query( $sql );
	$fila = $resultado->fetch_array(MYSQLI_NUM);
	$sis=$fila[0];
	
	$nos=$total-$sis;
	$sisper=($sis*100)/$total;
	$sisper=round($sisper,0);
	$nonper=100-$sisper;
?>