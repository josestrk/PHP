<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style.css");
?>
</head>
<body>
	<div class="formLS">
		<h3>Buscadores</h3>
		<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
			Tipo de búsqueda: 
			<input type="checkbox" name="tip" value="h1_14'comp_cadenas, Autoprocesada, funciones cadenas'.php"> Tipo ej14 
			<input type="checkbox" name="tip2" value="h1_16'comp_cadenas, Autoprocesada, funciones cadenas, 2botones en submit'.php"> Tipo ej16<br>
			<input type="submit" value="Submit" class="sb" >
		</form>
	</div>
	<hr>
	<?php
	if(isset($_POST['tip']))
		include $_POST['tip'];
	if(isset($_POST['tip2']))
		include $_POST['tip2'];
	?>
	---End ej17---
</body>
</html>