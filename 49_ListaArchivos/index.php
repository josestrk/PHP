<!doctype html>
<head>
	<meta http-equiv="Content-Type" content="charset=utf-8">
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
</head>
<body>
<div class='div'>
    <h2>Introduce extensión</h2>
    <h5>Mostraré todos los ficheros con la extenxión insertada</h5>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='get' size="6">
        <input type="text" name="raiz" value='<?php echo isset($_GET['raiz']) ? $_GET['raiz'] : '' ; ?>' style="margin:auto;">
    </form>
</div>

<?php
require ('functions.php');
if(isset($_GET['raiz'])){
    echo '<div class="div">';
    $raiz=$_GET['raiz'];
	$directorio = opendir($raiz); //ruta actual
	$mm = "No existen directorio";
	$sw = false;
    echo '<h2>Elementos del Directorio ' . realpath($raiz) . '</h2>';
    echo "<table class='table'>";
	while ($archivo = readdir($directorio)){
	    $sw=true;
        echo $archivo."--->";
        var_dump(pathinfo($archivo)['dirname']);
        echo checkfile('./'.$archivo);
        echo "<br>";
//         if (0==0){
//             echo "<tr><td style='font-size: 24px;'>&#9993;</td><td>" . $archivo;
//             echo "</td><td style='font-size: 24px;'>";
//             echo "<a href='" . $_SERVER['PHP_SELF'] . "?raiz=" . realpath($raiz) . "/" . $archivo . "'>&#9999;</a></td></tr>";
//         }else{
// 	        echo "<tr><td style='font-size: 24px;'>&#9763;</td><td>" . $archivo . "</td><td style='font-size: 24px;'>&#9999;</td></tr>"; //de ser un directorio lo envolvemos entre corchetes
//         }
	}
    echo "</table>";
	if(!$sw){
		echo "<div class='alert'><b>" . $mm . "</b></div>";
	}
     echo '</div>';
}
?>
</body>
</html>
