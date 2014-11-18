<?php

if(isset($_POST['titulo']) && isset($_POST['autor'])){
	require_once("conection_db.php");
	
	$titulo=$_POST['titulo'];
	$autor=$_POST['autor'];

	$sql="INSERT INTO libros(titulo, autor) VALUES ('$titulo', '$autor')";


	if (!$resultado = $enlace->query($sql)) {
		echo '<div class="alertFAIL">Error</div>';
	}

	$sql = "SELECT * FROM libros";
	$selection = $enlace->query($sql);

	foreach ($selection as $value) {
		echo 'Se ha introducido '.$value[1].' de este autor '.$value[2].' con id '.$value[0];

	}

	$enlace->close();
}
?>