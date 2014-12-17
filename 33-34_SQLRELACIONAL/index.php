<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require('conection.php');
include('../style.css');
require('funciones.php');
?>
</head>
<body>
<?php
// UpPhoto('../cartelera/')
	
	if(isset($_GET['edit'])){
		echo '<div class="formLS">
					<form action='.$_SERVER['PHP_SELF'].' method=\'POST\' enctype=\'multipart/form-data\'>
					    <h3>Nombre Pelicula: </h3><input type="text" name="titulo" style="margin:auto;">
					    <br><h3>Subir foto: </h3><input name="img" type="file" />
					    <h3>Actor: <select type="text" name="actor" style="margin:auto;">';
					  	roption($mysqli,'personal');
					  	echo '</select></h3>
					    <h3>Director: <select type="text" name="director" style="margin:auto;">';
					    roption($mysqli,'personal');
					    echo '</select></h3>
					    <h3>Tipo: <select type="text" name="tipo" style="margin:auto;">';
					    roption($mysqli,'tipos');
					    echo'</select></h3>
					    <h3>Año: <input type="text" name="año" style="margin:auto;"></h3>
					    <input type=\'submit\' value=\'Enviar\' class=\'sb\' style="width:300px"/>
					</form>
			   </div>';
	}elseif (isset($_POST['titulo']) && isset($_POST['actor']) && isset($_POST['director']) && isset($_POST['tipo']) && isset($_POST['año'])){
		createfilm($mysqli, $_POST['titulo'], $_POST['tipo'], UpPhoto('../cartelera/'), $_POST['actor'], $_POST['director'], $_POST['año']);
		echo '<a href="index.php?edit=true" class=\'sb\'>Editar Peliculas</a>';
		echo '<a href="crear.php" class=\'sb\' >Crear bbdd</a>';
		mostrar($mysqli);	
	}else{
		echo '<a href="index.php?edit=true" class=\'sb\'>Editar Peliculas</a>';
		echo '<a href="crear.php" class=\'sb\' >Crear bbdd</a>';
		mostrar($mysqli);
	}
?>
</body>
</html>