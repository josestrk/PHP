<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once('../style.css');
require_once("../h1_21'Clases,constructor'.php");

$c=new Cabecera('Librería',"ligthblue","#fff");
?>
</head>

<body>
	<form action="procesar.php" method="post" class="formLS">
		<input name="titulo" placeholder="Titulo" />
		<input name="autor" placeholder="Autor" />
		<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>

</body>
</html>