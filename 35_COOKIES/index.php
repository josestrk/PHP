<!doctype html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
Antes de introducir las películas nos aparece una pantalla de configuración de nuestro sitio web,
donde escogemos el color de fondo con el que queremos que nos presente toda la información. 
También nos pedirá el idioma.
A continuación cuando nos pida los datos de las películas, lo hará en ese idioma y con ese color de fondo.
Este fichero será 
*/
//bool setcookie ( string $nombre [, string $valor [, int $expira = 0 [, string $ruta [, string $dominio [, bool $segura = false [, bool $httponly = false ]]]]]] );
include('url/style.css');
if (isset($_POST['color']) && isset($_POST['box-color']) && isset($_POST['background'])){
	setcookie('Fecha',date('Y-m-d H:i:s'), time()+60*60,'/');
	setcookie('idioma','ESP',time()+60*60,'/');
	setcookie('color',$_POST['color'],time()+60*60,'/');
	setcookie('box-color',$_POST['box-color'],time()+60*60,'/');
	setcookie('background',$_POST['background'],time()+60*60,'/');
}
?>
</head>
<body>
<?php
if (isset($_POST['color']) && isset($_POST['box-color']) && isset($_POST['background'])){
	echo '<div class="formLS">
		<h2>Configuración de cartelera</h2>
		<form>
		    <h3>Color de texto: 
		    <select type="text" name="color" style="margin:auto;">
			    <option value="'.$_POST['color'].'">'.$_POST['color'].'</option>
		    </select></h3>
		    <br>
		    <h3>Color de carteles: <select type="text" name="box-color" style="margin:auto;">
			    <option value="'.$_POST['box-color'].'">'.$_POST['box-color'].'</option>
		    </select></h3>
		    <h3>Fondo: <select type="text" name="background" style="margin:auto;">
			    <option value="'.$_POST['background'].'">'.$_POST['background'].'</option>
		    </select></h3>
		    <input type="submit" value="Enviar" class="sb" style="width:300px"/>
		</form>
	</div>';
	echo '<div class="notifi">Gracias por activar las cookies</div>';
	echo '<META http-equiv="refresh" content="0.8;URL=url/index35.php">';
}
if(!isset($_POST['color']) ){
	echo'<div class="formLS">
		<h2>Configuración de cartelera</h2>
		<form action='.$_SERVER['PHP_SELF'].' method="POST" enctype="multipart/form-data">
		    <h3>Color de texto: 
		    <select type="text" name="color" style="margin:auto;">
			    <option value="orange">naranja</option>
			    <option value="green">verde</option>
			    <option value="grey">gris</option>
		    </select></h3>
		    <br>
		    <h3>Color de carteles: <select type="text" name="box-color" style="margin:auto;">
			    <option value="orange">naranja</option>
			    <option value="green">verde</option>
			    <option value="grey">gris</option>
		    </select></h3>
		    <h3>Fondo: <select type="text" name="background" style="margin:auto;">
			    <option value="../img/backindex.jpg">fondo 1</option>
			    <option value="../img/backindex2.jpg">fondo 2</option>
			    <option value="../img/backindex3.jpg">fondo 3</option>
		    </select></h3>
		    <input type="submit" value="Enviar" class="sb" style="width:300px"/>
		</form>
	</div>';
}
?>
	</div>
</body>
</html>