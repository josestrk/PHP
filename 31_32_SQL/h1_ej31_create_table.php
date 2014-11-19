<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once('../style.css');
require_once("../h1_21'Clases,constructor'.php");
$c=new Cabecera('Crear tabla',"ligthblue","#fff");
$alert = "alertNULL";
$mensaje= "";
?>
</head>

<body style="height: 1000px;">
<?php
$c->dibujar();
if(isset($_POST['bd_name'])){
	$enlace = new mysqli('localhost', 'root', '123456');
	if ( $enlace->connect_errno ) {
	   $mensaje="Falló la conexión";
	   $alert = "alert";
	}else{
		$sqlbd= "CREATE DATABASE IF NOT EXISTS ".$_POST["table_name"]." DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_spanish_ci;";
		if(!$connect = $enlace->query( $sqlbd)){
			$mensaje='fallo creacion Base de datos';
			$alert = "alert";
		}else{
			$enlace->close();
			$enlace = new mysqli('localhost', 'root', '123456', $_POST["table_name"]);
			$sql='CREATE TABLE IF NOT EXISTS '.$_POST["table_name"].'
			(
			ID INT NOT NULL AUTO_INCREMENT,
			'.$_POST["campo1"].' varchar(255),
			'.$_POST["campo2"].' varchar(255),
			 PRIMARY KEY (id)
			) ENGINE=InnoDB;';

			if ($resultado = $enlace->query($sql)) {
				$mensaje="Se creo tabla";
				$alert = "alertOK";
	    	}else{
	    		$mensaje="ERROR AL CREAR TABLA";
	    		$alert = "alert";
	    	}
		}
		$enlace->close();
	}
}else{
	echo '
	<form acction="'.$_SERVER['PHP_SELF'].'" method="post" class="formLS">
		<input name="bd_name" placeholder="Base de datos"/>
		<input name="table_name" placeholder="Nombre de la tabla"/>
		<input name="campo1" placeholder="Titulo" />
		<input name="campo2" placeholder="Autor" />
		<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>';
}
echo '<div class="'.$alert.'">'.$mensaje.'</div>';
?>
</body>
</html>