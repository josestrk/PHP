<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require('conection.php');
include('../style/style.css');
require('funciones.php');
?>
</head>
<body>
<?php
/*
Requisitos de inserción
Realizar un formulario de petición de datos para insertar una serie de películas, actores y tipos.
Cuando introduzcamos las películas el tipo de película nos lo presentara una lista desplegable. (terror, humor, etc)
Cualquier tipo de error que se produjese en la base de datos, tanto de conexión, como de inserción deben ser comunicados a los usuarios con error.php
*/
	
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
		echo '<div style="display:block;text-align: end;">';
			try{
				createfilm($mysqli, $_POST['titulo'], $_POST['tipo'], UpPhoto('../cartelera/'), $_POST['actor'], $_POST['director'], $_POST['año']);
			}catch(Exception $e){
				echo'<div class="alert">'.$e->getMessage().'</div>';
			}
			echo '<a href="index.php?edit=true" class=\'btn\'>Editar Peliculas</a>'.
			'<a href="crear.php" class=\'btn\' >Crear bbdd</a>'
		.'</div>';
		try{
			mostrar($mysqli);
		}catch(Exception $e){
			echo'<div class="alert">'.$e->getMessage().'</div>';
		}
	}else{
		echo '<div style="display:block;text-align: end;"><a href="index.php?edit=true" class=\'btn\'>Editar Peliculas</a>
		<a href="crear.php" class=\'btn\' >Crear bbdd</a></div>';
		try{
			mostrar($mysqli);
		}catch(Exception $e){
			echo'<div class="alert">'.$e->getMessage().'</div>';
		}
	}
?>
</body>
</html>