<?php
include('style.css');
/*22. Crear un programa que nos visualiza en una tabla  el arrray que contiene los meses del año.
Utilizar para ello array_walk($meses,’escribir_tabla’);
*/
function escribir_tabla($mes, $clave){
	echo '<div class="formLS">'.($clave+1).'-'.$mes.'<br>';
	switch ($clave+1) {
		case 1:;case 3:;case 5:;case 7:;case 8:;case 10:;case 12:
			$dias=31;
			break;
		case 11:;case 4:;case 6:;case 9:
			$dias=30;
			break;
		default:
			$dias=28;
			break;
	}
	echo '<div class="c">';
	for ($i=1; $i <=$dias ; $i++) { 
		if($i<10){
			echo '<span style="margin: 10px;">0'.$i.'</span>';
		}else		
			echo '<span style="margin: 10px;">'.$i.'</span>';
		if($i%7==0){
			echo '</div><div class="c">';
		}
	}
	echo '</div></div>';
}
$meses=array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');
array_walk($meses,'escribir_tabla');
?>