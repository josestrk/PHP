<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<style>
.formLS{width: 400px;background-color: #EEE;border: 2px solid #666;color: #6DAAF8;padding: 15px;font-family: sans-serif;font-weight: 700;margin: auto;}
.sb{background-color: #4BC5B2;color: #FFF;margin-left: 40%;margin-top: 20px;border-radius: 20px;padding: 10px;}
</style>
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