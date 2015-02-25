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
        <br>
        <input type="checkbox" name="open" value="1"/> Desplegar los directorios
    </form>
</div>
<style type="text/css">
#mydiv {
    top: 50%;
    left: 50%;
    width: 30em;
    height: 18em;
    margin-top: -9em;
    margin-left: -15em;
    border: 1px solid #ccc;
    background-color: #F3F3FD;
    position: fixed;
    overflow: scroll;
}
</style>
<?php
require ('functions.php');

function replaceNewLines($subject, $replace) {
    return str_replace(array("\r\n", "\n\r", "\n", "\r"), $replace, $subject);
}

function infoFile($file, $i){
    echo "<tr><td style='font-size: 24px;'>&#9763;</td><td>";
            try{
               echo "[" . linkinfo($file) . "]";
            } catch (Exception $e) {
                echo "-l";
            }
            echo "</td><td>";
            echo checkperm($file);
            echo "</td><td id='showFile". $i ."' style='font-size: 24px;'>&#9993;</td></tr>"; //de ser un directorio lo envolvemos entre corchetes
            $arc = file_get_contents($file);
            echo '<script>
                    document.getElementById("showFile'. $i .'").onclick = function(){
                        document.getElementById("showFile'. $i .'").innerHTML = "';
                        echo '<div id=\"mydiv\">'.replaceNewLines(htmlentities(htmlspecialchars($arc)), "<br>").'</div>"
                    }
                    </script>';

            // echo '<div>';
            // echo htmlspecialchars($arc);
            // echo '</div>';
}

if(isset($_GET['raiz'])){
    echo '<div class="div">';
    $raiz=$_GET['raiz'];
    $directorio = opendir(realpath($raiz)); //ruta actual
    $mm = "No existen directorio";
    $sw = false;
    echo '<h2>Elementos del Directorio ' . realpath($raiz) . '</h2>';
    echo "<table class='table'>";
    $i=0;
    while ($archivo = readdir($directorio)){
        $sw=true;
        $file=realpath($raiz) . '/' . $archivo;
        if (is_dir($file)){
            echo "<tr><td style='font-size: 24px;'>&#9993;</td><td>" . $archivo;
            echo "</td><td></td><td style='font-size: 24px;'>";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?raiz=" . realpath($raiz) . "/" . $archivo . "'>&#9999;</a></td></tr>";
        }else{
            echo $file . "[" . $archivo . "]";
            infoFile($file, $i);
            $i++;
        }
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
