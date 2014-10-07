<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel=stylesheet href="css/css1.css" type="text/css">
</head>
<body>
<?php
	function calculaMax( $max , $valor ){
		if( $valor > $max )
			$max= $valor;
		return $max;
	}
	function media( $sum , $cant ){
		return $sum / $cant;
	}

	if(isset($_POST['nombre']) && isset($_POST['e1'])){
	
		echo "<div class='1'><p>NOMBRE:".$_POST['nombre']."</p>";
		$i= 1;
		$ac= 0;
		do{
			$ac+=$_POST['e'.$i];
			$i++;
		} while( isset($_POST['e'.$i]) );
		echo "<p>Nota media:".media($ac,$i)."</p>";
		
		$maxima=0;
		$i=1;
		do{
			$maxima= calculaMax( $maxima, $_POST['e'.$i] );
			$i++;
		} while( isset($_POST['e'.$i]) );
		
		echo "<p>Nota máxima:".$maxima."</p></div>";
	
	}else{
		echo "<div class='2'>No has introducido todos los datos</div>";
	}
	echo "<a href='ej2.html'><input type='button' value='Volver'/></a>";
?>
</body>
</html>