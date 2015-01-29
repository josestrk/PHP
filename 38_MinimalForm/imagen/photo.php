<?php
function UpPhoto($dir,$name){
	$target_dir = $dir;
	$nombre = microtime(true) * 10000;
	$imageFileType = pathinfo(basename($_FILES[$name]["name"]),PATHINFO_EXTENSION);
	$target_file = $target_dir . $nombre.'.'. $imageFileType ;

	$uploadOk = 1;

	// Fichero y nuevo tamaño
	$nombre_fichero = $_FILES[$name]["tmp_name"];//$_FILES[$nombre];

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES[$name]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	       	throw new Exception ("File is not an image");
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    throw new Exception ("Sorry, file already exists.");
	    $uploadOk = 0;
	}
	// Check file size Bites
	if ($_FILES[$name]["size"] > 50000000) {
	    throw new Exception ("Sorry, your file is too large");
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    throw new Exception ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    throw new Exception ("Sorry, your file was not uploaded.");
	    return false;
	} else {
	    list($ancho, $alto) = getimagesize($nombre_fichero);
        $nuevo_ancho =300;
        $nuevo_alto = 300;
        // Cargar
        $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        
        switch($imageFileType){
            case "jpg":
                $origen = imagecreatefromjpeg($nombre_fichero);
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
                if (!imagejpeg($thumb,$target_file)) {
                    throw new Exception ("Sorry, there was an error uploading your file.");
                    return false;
                }
            break;
            case "png":
                $origen = imagecreatefrompng($nombre_fichero);
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
            
                if (!imagepng($thumb,$target_file)) {
                    throw new Exception ("Sorry, there was an error uploading your file.");
                    return false;
                }
            break;
            case "gif":
                $origen = imagecreatefromgif($nombre_fichero);
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
                if (!imagegif($thumb,$target_file)) {
                    throw new Exception ("Sorry, there was an error uploading your file.");
                    return false;
                }
            break;
            case "jpeg":
                $origen = imagecreatefromjpeg($nombre_fichero);
                imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
                if (!imagejpeg($thumb,$target_file)) {
                    throw new Exception ("Sorry, there was an error uploading your file.");
                    return false;
                }
            break;
        }
        
	    return $target_file;
	}
}

?>