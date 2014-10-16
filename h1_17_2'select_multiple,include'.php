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
		Ejercicios:<br>
		 
		<select name="ejercicios[]" multiple="multiple" style="width:150px;">
		  	<option value="ej1-14.php">1-13</option>
		  	<option value="h1_14'comp_cadenas, Autoprocesada, funciones cadenas'.php">14</option>
			<option value="h1_16'comp_cadenas, Autoprocesada, funciones cadenas, 2botones en submit'.php">16</option>
			<option value="h1_17'select,include'.php">17</option>
		</select>
		<input type="submit" value="Submit" class="sb" >
		</form>
	</div>
	<hr>
	<?php
	if(isset($_POST['ejercicios'])){
		$ejercicio=$_POST['ejercicios'];
		foreach( $ejercicio as $key => $value)
			include $value;
	}
	?>
	---End ej17-2---
</body>
</html>