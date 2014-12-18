<?php
function listPersonal(&$mysqli,$iddir,$idact){
    $sql="SELECT * FROM personal WHERE ID=$iddir OR ID=$idact";
    $resultado = $mysqli->query($sql);
    $res = array('DIR' => '','ACTOR' => '');
    if(!$resultado){
        throw new Exception ('No se accedio a datos');
    }else{
    	while($row=$resultado->fetch_assoc()){
    		if ($iddir == $row['ID']) {
    			$res['DIR']=$row['NAME'];
    		}
    		if ($idact == $row['ID']) {
    			$res['ACTOR']=$row['NAME'];
    		}
    	}
    	return $res;
    }
}

function mostrar(&$mysqli){
    $sql="SELECT pelicula.NAME as pname, pelicula.AÑO, pelicula.IMG, pelicula.DIR, pelicula.ACTOR, tipos.NAME as tname FROM pelicula, tipos WHERE pelicula.REF_TP=tipos.id";
    $mysqli->query("SET NAMES 'utf8'");
    $resultadolist = $mysqli -> query($sql);

    if(!$resultadolist){
        throw new Exception ('No se accedio a datos');
    }else{
    	while($rowlist=$resultadolist->fetch_assoc()){
    		$personal=listPersonal($mysqli, $rowlist['DIR'],$rowlist['ACTOR']);
    		printing($rowlist,$personal);
    	}
    }
}

function printing($row, $personal){
	echo '<div class="cartel" style="background-image: url(\''.$row['IMG'].'\');">
	<h1>'.$row['pname'].'</h1>
	<blockquote>Director '.$personal['DIR'].'<BR>Actor '.$personal['ACTOR'].'<BR>Año '.$row['AÑO'].'<BR>Tipo '.$row['tname'].'<BR>
	</blockquote></div>';
}

function createFilm(&$mysqli, $tit, $tipo, $img, $actor, $director, $ano){
	if(!$img){
		throw new Exception ("error foto peli");
	}else{
		if(verifytable($mysqli,$tipo, 'tipos') && verifytable($mysqli,$actor, 'personal') && verifytable($mysqli,$director, 'personal')){
			$sql="INSERT INTO pelicula (NAME, REF_TP, AÑO, ACTOR, DIR, IMG)  VALUES ('$tit', $tipo, $ano, $actor, $director, '$img')";
			$mysqli->query("SET NAMES 'utf8'");
		    if (!$resultado = $mysqli -> query($sql)){
		        throw new Exception ($mysqli -> error);
		    }
		}else{
			throw new Exception ("Revise sus datos");
		}
	}
}

function verifytable(&$mysqli,$dato, $tabla){
	$sql="SELECT * FROM $tabla WHERE ID=".$dato;
	$res= $mysqli->query($sql);
	if($row= $res->fetch_assoc()){
		return true;
	}else{
		return false;
	}
}

function roption(&$mysqli, $tabla){
	$sql="SELECT * FROM $tabla";
    $resultado = $mysqli->query($sql);

    if(!$resultado){
        throw new Exception ('No se accedio a datos');
    }else{
    	while($row=$resultado->fetch_assoc()){
    		echo "<option value=".$row['ID'].">".$row['NAME']."</option>";
    	}
    }
}

function UpPhoto($dir){
	$target_dir = $dir;
	$nombre = microtime(true) * 10000;
	$imageFileType = pathinfo(basename($_FILES["img"]["name"]),PATHINFO_EXTENSION);
	$target_file = $target_dir . $nombre.'.'. $imageFileType ;
	
	$uploadOk = 1;

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["img"]["tmp_name"]);
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
	// Check file size
	if ($_FILES["img"]["size"] > 50000000) {
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
	    if (!move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
	        throw new Exception ("Sorry, there was an error uploading your file.");
	        return false;
	    }
	    return $target_file;
	}
}

?>