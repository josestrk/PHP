<head><meta http-equiv="Content-Type" content="charset=utf-8"></head>
<?php
/*INFORMACION
Volver a poner el autoincrement al valor que sea
ALTER TABLE `libros` auto_increment = 2;
*/
require_once("conection_db.php");
if(isset($_POST['titulo']) && isset($_POST['autor'])){
	
	$titulo=$_POST['titulo'];
	$autor=$_POST['autor'];

	$sql="INSERT INTO libros(titulo, autor) VALUES ('$titulo', '$autor')";

	$enlace->query("SET NAMES 'utf8'");
	
	if (!$resultado = $enlace->query($sql)) {
		echo '<div class="alertFAIL">Error</div>';
	}else{
		echo '<div class="alertOK">Insertado con exito</div>';
	}
}

$sql = "SELECT id,titulo,autor FROM libros";
$enlace->query("SET NAMES 'utf8'");
$selection = $enlace->query($sql);

echo "<div class='div'><table align='center' border=1><tr><td>ID</td><td>TITULO</td><td>AUTOR</td></tr>";
while ($row = $selection->fetch_array(MYSQLI_NUM)) 
{
	echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
}
echo "</table></div>";
$selection->free();
$enlace->close();
?>