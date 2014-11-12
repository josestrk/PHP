<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
WEB DE CINE
De todas las películas que tenemos en nuestro cine, en la página inicial debemos presentar 3 que cambian aleatoriamente cada vez que nos conectamos al cine , de las 12 que tienen en el cine .Utilizar array _rand para trabajar aleatoriamente.
*/
require_once('style.css');
require_once("h1_21'Clases,constructor'.php");

$c=new Cabecera('Introducir Pelis',"purple","#fff");

function name_date(){
	$result = microtime(true)*10000;
	return $result;
}

function UpPhoto($dir,$nombre){
	$target_dir = $dir;
	$target_file = $target_dir . $nombre ;

	$imageFileType = pathinfo(basename($_FILES["img"]["name"]),PATHINFO_EXTENSION);
	$uploadOk = 1;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["img"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["img"]["size"] > 50000000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	    return false;
	} else {
	    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	        return false;
	    }
	    return true;
	}
}

function createFilm($tit,$img,$text){
	$file="cartelera/cartelera.txt";
	$contenido="$tit\,$img\,$text\n";
		if (is_writable($file)) {
			if (!$gestor = fopen($file, 'a')) {
		         echo "No se puede abrir el archivo ($file)";
		         exit;
		    }
		    if (fwrite($gestor, $contenido) === FALSE) {
		        echo "No se puede escribir en el archivo ($file)";
		        exit;
		    }
			echo "Éxito, se escribió ($contenido) en el archivo ($file)";
	    	fclose($gestor);
	    } else {
	    	echo "El archivo $file no es escribible";
		}
}

?>
</head>
<body style="background: url('img/tx.jpg');background-repeat: repeat; ">

<?php $c->dibujar(); ?> 
<div class="formLS">
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST' enctype='multipart/form-data'>
    <h3>Nombre Peli: </h3><input type="text" name="titulo" style="margin:auto;">
    <br><h3>subir foto: </h3><input name="img" type="file" />
    <br><h3>Comentario</h3><textarea name="info" style="margin: 2px; width: 490px; height: 200px;resice:none; max-width:490px; min-width:490px;"></textarea>
    <br><input type='submit' value='Enviar' class='sb' style="width:300px"/>
</form>
<a href="h1_30_2'vieuFilms_Random'.php"><button class='sb' />CARTELERA</a>
<a href="h1_24'Cine(random,matrices,clases,newstyle)'.php"><button class='sb'>CARTELERA Random 24 </button></a>
</div>
<div style="float:none;"></div>
<div class="div" style="float: left;">

<?php
if (isset($_POST['titulo']) && isset($_POST['info'])) {
	$imageFileType = pathinfo(basename($_FILES["img"]["name"]),PATHINFO_EXTENSION);
	$nombre = name_date().".".$imageFileType;
	if(UpPhoto("cartelera/",$nombre)){
		$tittle= htmlspecialchars(nl2br($_POST['titulo']));
		$inf= htmlspecialchars(nl2br($_POST['info']));
		createFilm($tittle,$nombre,$inf);
		echo "<br><h5>new Film('$tittle','$nombre','$inf')</h5>";
	}
}
?>
</div>

</body>
</html>