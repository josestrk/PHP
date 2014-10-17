<?php
/*
19-15
En este ejercicio vamos a crear dos funciones de validación del lado del servidor que pueden serle de utilidad frecuentemente (recuerde que para validar las fechas ya disponemos de la función checkdate).
	1.	Cree una función llamada is_nif($cadena) que compruebe si cadena es:
		a.	Un número seguido de una única letra.
		b.	La letra es la correspondiente a ese número.
	2.	Cree una función llamada is_email($cadena) que compruebe si cadena:
		a.	Contiene un único signo @.
		b.	Contiene un único punto por detrás de ese signo @.
		c.	Contiene caracteres antes de la @, entre la @ y el punto, y detrás del punto.
	3. Introduccion

*/
function is_nif($cadena){
	$i=0;
	$sw=true;
	$ms="";
	trim($cadena);
	$char=substr($cadena, -1);
	$num=substr($cadena, 0, -1);//intval transforma el string forzandolo a ser numerico

	if(!is_string($char)){
		$sw=false;
		$ms.="<br>El ultimo no es un caracter";
	}
	if(!is_numeric($num)){//is_numeric comprueba que es numerico
		$sw=false;
		$ms.="<br>La cadena no es numerica";
	}
	if (!$char==letra($num)) {
		$sw=false;
		$ms.="<br>El caracter $char no pertenece a ese DNI";
	}
	echo $ms;
	return $sw;
}

function letra($dni){
        $letras=['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
        return $letras[$dni%23];
}

function is_email($cadena)
{
	if(boolval(preg_match( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$cadena)))
	{
		return true;
	}else{
		echo "Email no valido";
		return false;
	}
}

function valInput($sacar)
{
	if(empty($sacar) || $sacar=="" || !isset($sacar)){
		echo "<span style='color:red;font-weight:900;'>Input FAILED</span>";
		return false;
	}
	return true;
}

function valInputStr(&$sacar)
{
	if(valInput($sacar)){
		$sacar = htmlspecialchars(strip_tags(trim($sacar)));
		return true;
	}
	return false;
}

?>