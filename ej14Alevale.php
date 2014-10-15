<?php
echo"<html><head><meta charset=\"UTF-8\"></head><body><form name=\"input\" action=\"";

 echo $_SERVER['PHP_SELF'];

 echo "\" method=\"POST\">";

echo'<textarea name="texto" cols="40" rows="5">';

if(isset($_POST['texto'])){	echo $_POST['texto'];

}else{	echo "Texto a buscar";

}echo '</textarea><br>
<input type="text" name="palabra" value="';

if(isset($_POST['palabra'])){	echo $_POST['palabra'];

}else{	echo "Texto a buscar";

}echo'">
<input type="submit" name="Buscar" value="Contenido"><input type="submit" name="Buscar" value="Posiciones"><input type="reset" value="Borrar"></form></body>';


if (isset($_POST['Buscar']) && $_POST['Buscar']=="Contenido") {	if(isset($_POST['texto']) && isset($_POST['palabra'])){		$text=$_POST['texto'];

		$pal=$_POST['palabra'];

		if(found($pal,$text)){			echo "Si esta ".$pal." en ".$text;

		}else{			echo "No esta ".$pal." en ".$text;

		}	}else{		echo "No Has enviado ningun dato valido";

	}}if(isset($_POST['Buscar']) && $_POST['Buscar']=="Posiciones"){	$text=$_POST['texto'];

	$pal=$_POST['palabra'];


	$text=explode(" ", $text);

	for ($i=0;

 $i < count($text) ;

 $i++) { 		if ($pal==$text[$i]) {			echo "La palabra ".$pal." esta en la posicion ".($i+1)."<br>";

		}	}}
function found($pal, $text){	$text=explode(" ", $text);

	if (array_search($pal, $text)>(-1)) {		return true;

	}else{		return false;

	}}

?>