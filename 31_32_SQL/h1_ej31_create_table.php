<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once('../style/style_old.css');
require_once("../h1_21'Clases,constructor'.php");
$c=new Cabecera('Crear tabla',"ligthblue","#fff");
$alert = "alertNULL";
$mensaje= "";
require_once('conection_sql.php');
?>
</head>

<body style="height: 1000px;">
<?php
$c->dibujar();
if(isset($_POST['bd_name'])){
	//creamos la bbdd
	$sqlbd= "CREATE DATABASE IF NOT EXISTS ".$_POST["bd_name"]." DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_spanish_ci;";
	if(!$connect = $enlace->query( $sqlbd)){
		$mensaje='fallo creacion Base de datos';
	}else{
		//nos conectamos a la bbdd 
		$enlace->select_db($_POST['bd_name']);
		//creamos tabla
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
	//cerramos conexion bbdd
	$enlace->close();
}else{
	echo '
	<form acction="'.$_SERVER['PHP_SELF'].'" method="post" class="formLS">
		<h3>Nombre base de datos</h3><br>
		<input name="bd_name" placeholder="Base de datos"/>
		<h3>Nombre tabla</h3><br>
		<input name="table_name" placeholder="Nombre de la tabla"/>
		<h3>Nombre campo1[texto]</h3><br>
		<input name="campo1" placeholder="Titulo" />
		<h3>Nombre campo2[texto]</h3><br>
		<input name="campo2" placeholder="Autor" />
		<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>';
}
echo '<div class="'.$alert.'">'.$mensaje.'</div>';
echo '<div class="div"><a href="h1_32.php?mod=insert"><button class="sb" style="width:300px">Insertar en Tabla</button></a></div>';
echo '<div class="div"><a href="h1_32.php?mod=ver"><button class="sb" style="width:300px">Ver en Tabla</button></a></div>';
?>
</body>
</html>