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
//new Film('El bosque','bosque.jpg','lorem ipsum colore samsdbew2bewqe'),

?>
</head>
<body background='img/tx.jpg' style="background-repeat: repeat; ">

<?php $c->dibujar(); ?> 
<div class="formLS">
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='POST' enctype='multipart/form-data'>
    Nombre Peli: <input type="text" name="titulo" style="margin:auto;">
    <br>subir foto: <input name="img" type="file" />
    <br><textarea name="info" style="margin: 2px; width: 490px; height: 200px;resice:none; max-width:490px; min-width:490px;"></textarea>
    <br><input type='submit' value='Enviar' class='sb' />
</form>
</div>
<div style="float:none;"></div>
<div class="div">

<?php

if (isset($_POST['titulo']) && isset($_POST['img']) && isset($_POST['info'])) {
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["img"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
	if ($_FILES["img"]["size"] > 500000) {
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
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
}



?>

</div>

</body>
</html>