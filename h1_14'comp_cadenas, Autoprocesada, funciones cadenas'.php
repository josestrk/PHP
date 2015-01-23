<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style/style_old.css");
?>
</head>
<body>
<h3> Ejercicio 14 </h3>

<?php
/*14 - Escribir una función personalizada llamada buscar($aguja,$pajar) que devuelva un array con la posición de todas las ocurrencias de aguja en pajar, o el valor FALSE en caso de que no haya ninguna.
Probarla con la llamada buscar ('Ana', 'Ana Irene Palma').*/

function buscar($aguja,$pajar){
	$cadenas = preg_replace('/ +/', ' ', $pajar);
	$findPalabra = array();
	$resalt = "<blockquote>";

	$cadenas = explode ( " " , $cadenas); //transformo la cadena en un array de cadenas
	foreach ($cadenas as $indice => $palabra){
		if ( strcmp(  strtolower( trim ($palabra,"!*@;:.,?\t\n") ), strtolower( trim ($aguja,"!*@;:.,?\t\n") )  ) === 0 ){
			$findPalabra[] = $indice;
			$resalt.="<strong>".$palabra."</strong> ";
		}else{
			$resalt.=$palabra." ";
		}
		//(strcmp(  strtolower( trim ($palabra,"!*@;:.,?\t\n") ), strtolower( trim ($aguja) ) ) === 0 ) ? ( ($findPalabra[] = $indice) && ($resalt.="<strong>".$palabra."</strong> ") ) : $resalt.=$palabra." ";
	}
	
	echo $resalt."</blockquote>";
	return $findPalabra;
}


if(isset($_POST['aguja']) && isset($_POST['pajar'])){
	if (empty($_POST['aguja']) || empty($_POST['pajar']))
		header ('refres: 5, url='.$_SERVER['PHP_SELF']);
	else{
		echo "<blockquote>".$_POST['pajar']."</blockquote>";	
		
		$search= buscar ($_POST['aguja'], $_POST['pajar']);
		
		if( sizeof($search)> 0 ){
			foreach ( $search as $value ) 
				echo "Es la ".($value+1)."ª palabra <br>";
		}else
			echo "No existe la palabra en la frase";
		
		echo '<a href="'.$_SERVER['PHP_SELF'].'"><button>volver</button></a>';
	}
}else{
	echo '<div class="formLS">
		<h3>Buscar palabra</h3>
		<form action="'.$_SERVER['PHP_SELF'].'" method="post">
			Frase: <textarea rows="4" cols="30" name="pajar" style="margin: 2px; width: 388px; height: 283px;" required ></textarea><br>
			Palabra: <input type="text" name="aguja" required /><br>
			BUSCAR POR:
			<input type="submit" value="Cadenas" name="b" class="sent" />
		</form>
        </div>';
}
?>
---End ej14---
<hr/>
</body>
</html>