<!doctype html style="height: 100%;">
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once('../style/style_old.css');
require_once("../h1_21'Clases,constructor'.php");

$c=new Cabecera('Librería',"ligthblue","#fff");
?>
</head>

<body>
<?php
if ($_GET['mod']!='ver') {
	echo'<form action="procesar.php" method="post" class="formLS">
		<h3>Inserta en Libreria</h3>
		<input name="titulo" placeholder="Titulo" />
		<input name="autor" placeholder="Autor" />
		<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>';
}else{
	include('procesar.php');
}
?>
</body>
</html>