<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require('conection.php');
include('style.css');
require('funciones.php');
?>
<style>
body {
    background-image:url(<?php echo $_COOKIE['background'] ?>);
    text-align: left;
}
.cartel{
    width: 30%;
    height: 400px;
    border-bottom: 2px groove <?php echo  $_COOKIE['box-color'] ?>;
    margin: 20px 15px;
    box-shadow: 0px 10px 20px <?php echo $_COOKIE['box-color']?>;
    float: left;
    overflow-y: hidden;
    overflow-x: hidden;
    background-size: 100% 100%;
}
.cartel > h1 {
    margin-top: 245px;
    margin-left: inherit;
    border-radius-right: none; 
}
.cartel > *{
    border-radius: 5px;
    color: <?php echo $_COOKIE['color']?>;
    padding: 7px;
    background-color: rgba(255,255,255,0.8);
    margin-left: 4px;
    box-shadow: 2px 1px 9px #CCC;
}
</style>
</head>
<body>
<?php
/*
use to 35 cookie files
*/
if(!isset($_COOKIE['Fecha']) && !isset($_COOKIE['idioma']) && !isset($_COOKIE['background']) && !isset($_COOKIE['color'])  && !isset($_COOKIE['box-color'])){
	echo "<div class='alert'>Debe activar su configuración Redirigiendo ...</div>";
	echo '<META http-equiv="refresh" content="3;URL=../index.php">';
}else{
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
		echo '<div style="display:block;text-align: end;"><span class="notifi"> Fecha:'.$_COOKIE['Fecha'].' Idioma:'.$_COOKIE['idioma'].'</span>';
			try{
				createfilm($mysqli, $_POST['titulo'], $_POST['tipo'], UpPhoto('../cartelera/'), $_POST['actor'], $_POST['director'], $_POST['año']);
			}catch(Exception $e){
				echo'<div class="alert">'.$e->getMessage().'</div>';
			}
			echo '<a href="index35.php?edit=true" class=\'btn\'>Editar Peliculas</a>'.
			'<a href="crear.php" class=\'btn\' >Crear bbdd</a>'
		.'</div>';
		try{
			mostrar($mysqli);
		}catch(Exception $e){
			echo'<div class="alert">'.$e->getMessage().'</div>';
		}
	}else{
		echo '<div style="display:block;text-align: end;"><span class="notifi"> Fecha:'.$_COOKIE['Fecha'].' Idioma:'.$_COOKIE['idioma'].'</span>'
		.'<a href="quit.php" class=\'btn\' >Borrar cookies</a>'
		.'<a href="index35.php?edit=true" class=\'btn\'>Editar Peliculas</a>'
		.'<a href="crear.php" class=\'btn\' >Crear bbdd</a></div>';
		try{
			mostrar($mysqli);
		}catch(Exception $e){
			echo'<div class="alert">'.$e->getMessage().'</div>';
		}
	}
}

?>
</body>
</html>