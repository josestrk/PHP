<?php
if(isset($_POST['EMPNO'])){
	$num = $_POST['EMPNO'];
	if( $num >= 7000 && $num <= 8000 ){
		if( isset($_POST['ENAME']) ){
			$sql = "SELECT ENAME FROM EMP WHERE EMPNO=".$num;
			$resultado = $mysqli -> query( $sql );
			$fila = $resultado->fetch_assoc();
    		if ( $fila['ENAME'] == $_POST['ENAME'] ){
    			$sql = "UPDATE EMP SET VOTO=".$_POST['VOTO']." WHERE EMPNO=".$num;
    			$mf = (!$resultado = $mysqli->query($sql)) ? 'No se realizó la votación' : '<div class="alertOK">Votación finalizada</div>' ;
    		}else{
    			$mname = "El número y el nombre del empleado no coinciden";
    		}
		}else{
			$mname = "Inserte nombre de empleado";
		}
	}else{
		$mm = "El número de empleado no puede votar (7000-8000)";
	}
}

if(empty($mf)){
	echo '
	<form acction="'.$_SERVER['PHP_SELF'].'" method="post" class="formLS">
	<h2>Encuesta</h2><br>
	<h3>Número de empleado:</h3>
	<input name="EMPNO" placeholder="Número" />';
	if(!empty($mm)){		
		echo '<div class="alert">'.$mm.'</div>';
	}
	echo '<h3>Nombre Empleado</h3>
	<input name="ENAME" placeholder="Nombre"/>';
	if(!empty($mname)){	
		echo '<div class="alert">'.$mname.'</div>';
	}	
	echo '<h3>Voto</h3>
	<select type="radius" name="VOTO" value="1" class="vote">
	<option value="1">Si</option>
	<option value="2">No</option>
	</select>
	<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>';
}else{
	echo '<div class="alert">'.$mf.'</div>';
}
echo '<div class="div"><a href="index.php?mod=res"><button class="root" style="width:300px">ver resultados</button></a></div>';
?>