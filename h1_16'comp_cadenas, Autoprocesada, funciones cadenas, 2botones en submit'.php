<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<style>
.formLS{
        width: 400px;
        background-color: #EEE;
        border: 2px solid #666;
        color: #6DAAF8;
        padding: 15px;
        font-family: sans-serif;
        font-weight: 700;
        margin: auto;
}
.sent{
        background-color: #4BC5B2;
        color: #FFF;
        margin: auto;
        float: right;
        border-radius: 20px; 
        padding: 5px;
}
</style>
</head>
<body>
<h3> Ejercicio 16 </h3>

<?php
/*14 - Escribir una función personalizada llamada buscar($aguja16,$pajar16) que devuelva un array con la posición de todas las ocurrencias de aguja16 en pajar16, o el valor FALSE en caso de que no haya ninguna.
Probarla con la llamada buscar ('Ana', 'Ana Irene Palma').*/

function buscar16($aguja16,$pajar16,$tp,$t1,$t2){
	$cadenas = preg_replace('/ +/', ' ', $pajar16);
	$findPalabra = array();
	$resalt = "<blockquote>";

	if( $t1 ){
		$cadenas = explode ( " " , $cadenas); //transformo la cadena en un array de cadenas
		foreach ($cadenas as $indice => $palabra){
			if ( strcmp(  strtolower( trim ($palabra,"!*@;:.,?\t\n") ), strtolower( trim ($aguja16,"!*@;:.,?\t\n") )  ) === 0 ){
				$findPalabra[] = $indice;
				$resalt.="<strong>".$palabra."</strong> ";
			}else{
				$resalt.=$palabra." ";
			}
			//(strcmp(  strtolower( trim ($palabra,"!*@;:.,?\t\n") ), strtolower( trim ($aguja16) ) ) === 0 ) ? ( ($findPalabra[] = $indice) && ($resalt.="<strong>".$palabra."</strong> ") ) : $resalt.=$palabra." ";
		}
	}elseif ( $t2 ){
		for ($i=0;$i<strlen($cadenas)-1; $i++){
			$j=0;
			if(strtolower($cadenas[$i])==strtolower($aguja16[$j])){
				$indice=$i;
				do{
					(strtolower($cadenas[$i+$j])===strtolower($aguja16[$j])) ? $sw=true : $sw=false;
					$j++;
				}while($j<strlen($aguja16) && $sw);

				if($sw){
					do{
						$resalt.="<strong>".$cadenas[$i]."</strong>";
						$i++;
					}while($i<strlen($aguja16));
					$findPalabra[] = $indice;
				}
			}
			$resalt.=$cadenas[$i];
		}
	}
	

	echo $resalt."</blockquote>";
	return $findPalabra;
}


if(isset($_POST['aguja16']) && isset($_POST['pajar16'])){
	if (empty($_POST['aguja16']) || empty($_POST['pajar16']))
		header ('refres: 5, url='.$_SERVER['PHP_SELF']);
	else{
		echo "<blockquote>".$_POST['pajar16']."</blockquote>";	
		$tp= (isset($_POST['b1'])) ? $_POST['b1'] : $_POST['b2'];
		
		$search= buscar ($_POST['aguja16'], $_POST['pajar16'], $tp,isset($_POST['b1']),isset($_POST['b2']));
		
		if( sizeof($search)> 0 ){
			foreach ( $search as $value ) 
				echo "Es la ".($value+1)."ª ".$tp." <br>";
		}else
			echo "No existe la palabra en la frase";
		
		echo '<a href="'.$_SERVER['PHP_SELF'].'"><button>volver</button></a>';
	}
}else{
	echo '<div class="formLS">
		<h3>Buscar palabra</h3>
		<form action="'.$_SERVER['PHP_SELF'].'" method="post">
			Frase: <textarea rows="4" cols="30" name="pajar16" style="margin: 2px; width: 388px; height: 283px;" required ></textarea><br>
			Palabra: <input type="text" name="aguja16" required /><br>
			BUSCAR POR:
			<input type="submit" value="Palabras" name="b1" class="sent" />
			<input type="submit" value="Cadenas" name="b2" class="sent" />
		</form>
        </div>';
}
?>
---End ej16---
<hr/>
</body>
</html>