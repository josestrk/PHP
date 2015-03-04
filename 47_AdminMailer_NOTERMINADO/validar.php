<?php
function validate($user,$pass){
	$sw = true;
	if( $user == null or $pass == null ){
		$sw=!$sw;
	}else{
		require('sql/connection.php');
		//Sentencia para obtener usuario
		$query   = "SELECT user,tip from ADMIN WHERE  user = '$user' and pass = '$pass'"; 
		$result  = $mysqli -> query($query) or die('Error, fallo de la consulta '.$query); 
		
		if( $result->num_rows != 1 ){
			$sw=!$sw;
		}else{
			$registro=$result->fetch_row();		
			$_SESSION['intenconex'] = 0;// para que el usuario al salir no le de el aviso de error
			$_SESSION['db_is_logged_in'] = true;// activa la sesion
			$_SESSION['log'] = $registro[0];// COGE EN SESION[`LOG`] EL VALOR DE REGISTRO EL LOGIN
			$_SESSION['tipo'] = $registro[1];// COGE EN SESION[`LOG`] EL VALOR DE REGISTRO EL LOGIN
		}
	}
	return $sw;
}
?>
