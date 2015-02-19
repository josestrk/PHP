<!doctype html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
<div class='div'>
    <h2>Introduce extensión</h2>
    <h5>Mostraré todos los ficheros con la extenxión insertada</h5>
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method='post' size="6">
        <input type="text" name="extension" value='<?php echo isset($_POST['extension']) ? $_POST['extension'] : '' ; ?>' style="margin:auto;">
    </form>
</div>

<?php

if(isset($_POST['extension'])){
    echo '<div class="div">';
    $ex=$_POST['extension'];
	$directorio = opendir("."); //ruta actual
	$mm = "No existen archivos con esta extensión";
	$sw = false;
	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
	    if (!is_dir($archivo) && pathinfo($archivo)['extension']==$ex)//verificamos si es o no un directorio
	    {
	    	$sw=true;
	        echo "[".$archivo. "]<br />"; //de ser un directorio lo envolvemos entre corchetes
	    }
	}

	if(!$sw){
		echo "<div class='alert'><b>" . $mm . "</b></div>";
	}
     echo '</div>';
}
?>
</body>
</html>
