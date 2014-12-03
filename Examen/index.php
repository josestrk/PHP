<html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once ('conection.php');
require_once ('crear.php');
require_once ('style.css');
?>
</head>
<body>
	<?php 
	if(isset($_GET['mod'])){
		if($_GET['mod']=='list'){
			include ('listado.php'); 
		}elseif ($_GET['mod']=='votos'){
			include ('votacion.php'); 
		}else{
			include ('resultado.php');
			echo '<img src="grafica.php?si='.$sisper.'&no='.$nonper.'">';
			echo "<div class='div'>Número de votos emitidos: ".$total."<br> Sí: ".$sis." votos (".$sisper.")<br> No: ".$nos."  votos (".$nonper.")</div>";
		}
		echo '<div class="div"><a href="index.php"><button class="root" style="width:300px">Volver a Inicio</button></a></div>';
	}else{
		echo '<div class="div"><a href="index.php?mod=votos"><button class="root" style="width:300px">Votación</button></a></div>';
		echo '<div class="div"><a href="index.php?mod=list"><button class="root" style="width:300px">Listado</button></a></div>';
	}
	?>
</body>
</html>
