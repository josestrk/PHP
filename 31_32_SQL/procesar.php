<?php

if(isset($_POST['titulo']) && isset($_POST['autor'])){
	
	require_once("conection_db.php");
	
	$titulo=$_POST['titulo'];
	$autor=$_POST['autor'];

	$sql="INSERT INTO libros(titulo, autor) VALUES ('$titulo', '$autor')";

	if (!$resultado = $enlace->query($sql)) {
		echo '<div class="alertFAIL">Error</div>';
	}else{
		echo '<div class="alertOK">Insertado con exito</div>';
	}

	$sql = "SELECT id,titulo,autor FROM libros";
	$selection = $enlace->query($sql);
	
	echo "<table border=1><tr><td>ID</td><td>TITULO</td><td>AUTOR</td></tr>";
	while ($row = $selection->fetch_array(MYSQLI_NUM)) 
	{
		echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
	}
	echo "</table>";
	$selection->free();
	$enlace->close();
}
?>