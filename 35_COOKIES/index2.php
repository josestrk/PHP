<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
Antes de introducir las películas nos aparece una pantalla de configuración de nuestro sitio web,
donde escogemos el color de fondo con el que queremos que nos presente toda la información. 
También nos pedirá el idioma.
A continuación cuando nos pida los datos de las películas, lo hará en ese idioma y con ese color de fondo.
Este fichero será 
*/
//bool setcookie ( string $nombre [, string $valor [, int $expira = 0 [, string $ruta [, string $dominio [, bool $segura = false [, bool $httponly = false ]]]]]] );
include('../style/style.css');
?>
</head>
<body>
	<div class='div'>
<?php
setcookie('Fecha',date('Y-m-d H:i:s'));
setcookie('preferencias[idioma]','español');
setcookie('preferencias[fondo]','rojo');
var_dump($_COOKIE);
if(!isset($_COOKIE['Fecha'])){
	echo 'No se han activado cookies';
}else{
	echo 'Gracias por activar las cookies';
}
echo "<br><a class='btn' href=$_SERVER[PHP_SELF]>Refresh</a>";
?>
	</div>
</body>
</html>