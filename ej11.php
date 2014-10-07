<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<style>
.tab{
	margin: auto;
	border: #F50 solid 2px;
	/*border-collapse: collapse;*/
	border-spacing: 0;
}
.c{
	height: 20px;
	width: 20px;
}
.cb{
	background:#000;
}
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
<h3> Ejercicio 2 </h3>
    
<?php
/*2-Realizar un unico programa que nos presente un formulario de peticion de DNI
cuando el DNI no exista y que nos visualizar la letra del DNI cuando el DNI si exista.*/
function letra(){
        global $dni;
        $letras=['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
        return $letras[$dni%23];
}

if(isset($_REQUEST['dni'])){
    $dni=$_REQUEST['dni'];
    echo "<p>DNI:".$dni."-".letra()."</p>";
}else{
    echo '<div class="formLS">
		<h3>Obtener letra</h3>
		<form action="'.$_SERVER['PHP_SELF'].'" method="post">
			DNI (sin letra): <input type="name" min="1" name="dni" required /><br>
			<input type="submit" value="Enviar" class="sent" />
		</form>
          </div>';
}
?>

    
<h3> Ejercicio 3 </h3>

<table cellspacing=0 border=1>
    
<?php
/*3-Realizar un fichero php que genere la siguiente tabla dinamicamente*/
$variable=4;// si desea modificar los máximos cambiar este número
for($i= 0; $i <= $variable; $i++){
	echo "<tr>";
	for($j= 0; $j <= $variable; $j++){
            if($i==0 && $j==0)
                echo "<th></th>";
            elseif($i==0)
                echo "<th>".$j."</th>";
            elseif ($j==0)
                echo "<th>".$i."</th>";
            else
                echo "<td>".$i."".$j."</td>";
        }
	echo "</tr>";
}
echo "</table><br>---Fin ej3---<br>";
?>

<h3> Ejercicio 4 </h3>

<form method="post" action="ej11.php"> 
    Cantidad de tablas de multiplicar: <input type="number" size="10" max="14" min="1" name="mult" value=<?php echo (isset($_POST['mult'])) ? $_POST['mult'] : 10;  ?> />
</form>

<?php
/*4- Realizar una pagina autoprocesada en la que se presentan las tablas de multiplicar.
Si no le pasamos numero de filas nos presenta las 10 tablas pero si nos pasan como parámetro el número de filas*/
$mult= (isset($_POST['mult'])) ? $_POST['mult'] : 10 ;
for($i=1;$i<=$mult;$i++){
    echo "<div style='float:left;padding:5px;'>";
    for($j=1;$j<=10;$j++){
        echo $i."*".$j."=".($i*$j)."<br>";
    }
    echo "</div>";
}
echo "<div style='float:none;height: 180px;'></div><br>---Fin ej4---<br>";
?>

<h3> Ejercicio 5 </h3>

<?php
$ccaa = array(
"Andalucía"=> array(
						"Almería",
						"Cádiz",
						"Córdoba",
						"Granada",
						"Huelva",
						"Jaén",
						"Málaga",
						"Sevilla"),
"Aragón"=> array(
						"Huesca",
						"Teruel",
						"Zaragoza"),
"Asturias"=> array(
						"Asturias"),
"Islas Baleares"=> array(
						"Islas Baleares"),
"Islas Canarias"=> array(
						"Santa Cruz de Tenerife",
						"Las Palmas"),
"Cantabria"=> array(
						"Cantabria"),
"Castilla la Mancha"=> array(
						"Albacete",
						"Ciudad Real",
						"Cuenca",
						"Guadalajara",
						"Toledo"),
"Castilla y León"=> array(
						"Ávila",
						"Burgos",
						"León",
						"Palencia",
						"Salamanca",
						"Segovia",
						"Soria",
						"Valladolid",
						"Zamora"),
"Cataluña"=> array(
						"Barcelona",
						"Gerona",
						"Lérida",
						"Tarragona"),
"Extremadura"=> array(
						"Badajoz",
						"Cáceres"),
"Galicia"=> array(
						"La Coruña",
						"Lugo",
						"Orense",
						"Pontevedra"),
"La Rioja"=> array(
						"La Rioja"),
"Madrid"=> array(
						"Madrid"),
"Murcia"=> array(
						"Murcia"),
"Navarra"=> array(
						"Navarra"),
"País Vasco"=> array(
						"Álava",
						"Guipúzcoa",
						"Vizcaya"),
"Valencia"=> array(
						"Alicante",
						"Castellón",
						"Valencia")
);

echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
$ca= isset($_POST['ccaa']) ? $_POST['ccaa'] : " ";
echo "<select name='ccaa'>";
	foreach($ccaa as  $key => $value){
		if($key == $ca)
			echo "<option value=".$key." selected>".$key."</option>";

		echo "<option value=".$key.">".$key."</option>";
	}

echo "</select>";
echo "<input type='submit' value='enviar'>";

if(isset($_POST['ccaa'])){
	echo "<select name='prov'>";
	$key=$ca;
	foreach($ccaa[$key] as  $value){
		echo "<option value=".$value.">".$value."</option>";
	}
	echo "</select>";
}
?>
</FORM>
<br>---Fin ej5---<br>



<h3> Ejercicio 6 </h3>

<?php
/*6- LCG*/
define('a','219');//multiplicador
define ('c','0');//incremento
define ('m','32749');//modulo
$hora= getdate();
$semilla= $hora['seconds'];

function aleatorio_LCG($semilla){
	static $x= NULL;//siguiente de la secuencia
	if($x== NULL)
		$x= $semilla;
	$x=(a * $x + c)% m;
		return $x;
}
	echo aleatorio_LCG($semilla).'<br>';

echo "<br>---Fin ej6---<br>";
?>﻿

<h3> Ejercicio 7 </h3>

<table cellspacing=0 border=1>
    
<?php
/*7- Aprovechando la función anterior generar una matriz de 20*20 con 400 números aleatorios que no estén repetidos*/
$variable=20;// puede variar este valor
$max= $variable * $variable;
$array= array();

function existe( $num,&$array) {
	for($i = 0; $i < sizeof($array) ; $i++ ) {
    	if( $num == $array[$i] ){
			return true;
		}
	}
	return false;
}

for($i= 0; $i < $max; $i++){
	$num=aleatorio_LCG($semilla);
	existe($num,$array) ? $i-- : $array[$i]=$num;
}

$cont=0;
for($i= 0; $i < $variable; $i++){
	echo "<tr>";
	for($j= 0; $j < $variable; $j++, $cont++)
		echo "<td>".$array[$cont]."</td>";
	echo "</tr>";
}
echo "</table><br>---Fin ej7---<br>";
?>

<h3> Ejercicio 8 </h3>
<?php
/*8- Obtener una función que baraja una baraja española Version:Global y por referencia*/
$Gbaraja = array("AS P","AS E","AS O","AS B");
$array= array("AS P","AS E","AS O","AS B");

function barajarReferencia(&$baraja) {
    $i= 0;
    do{
        $carta = array_rand( $baraja, 1);
        if(!existe($baraja[$carta], $azarbraja)){//uso existe de ejercicio 7
                $azarbraja[$i]= $baraja[$carta];
                $i++;
        }
    }while($i< sizeof($baraja));
    $baraja=$azarbraja;
}
function barajarGlobal() {
    global $Gbaraja;
    for($i = 0; $i < sizeof($Gbaraja) ; $i++ ) {
    	if( $num == $array[$i] ){
            return true;
	}
    }
    return false;
}
 print_r($array); echo "<br>";
 barajarReferencia($array);
 print_r($array); echo "<br>";
 print_r($Gbaraja); echo "<br>";
 barajarGlobal();
 print_r($Gbaraja); echo "<br>";

echo "<br>---Fin ej8---<br>";
?>
  
<h3> Ejercicio 9 </h3>
<?php
/*9- Escribir un programa que muestre un mensaje diferente en función de la hora del día. 
Por ejemplo si es por la mañana muestra “Buenos Días”*/
$getFecha= getdate();
$hora=$getFecha["hours"];
if($hora<12){
    echo "<h4>Buenos días</h4>";
}elseif ($hora>= 12 && $hora<15){
    echo "<h4>Medio dia</h4>";
}elseif ($hora>= 15 && $hora<21){
    echo "<h4>Buenas tardes</h4>";
}else{
    echo "<h4>Buenas noches</h4>";
}

echo "<br>---Fin ej9---<br>";
?>

<h3> Ejercicio 10 </h3>

<table class="tab">
<!-- Estilos de tabla en la etiqueta <head> al pricipio del cocumento -->    
<?php
/*10-Crear un tablero de ajedrez mediante una tabla utilizando un bucle for anidado dentro de otro.*/
	for($i=0; $i < 8; $i++)
	{
		echo "<tr>";
		for($j=0; $j < 8; $j++)
			echo (($i+$j)%2==0) ? '<td class="c cb"></td>' : '<td class="c cn"></td>';
		echo "</tr>";
	}
echo "</table><br>---Fin ej10---<br>"
?>

<h3> Ejercicio 11 </h3>

<?php
/*11- Dado un número entero almacenado en la variable $numero, escribir el código necesario para asignar a la variable $es_primo el valor TRUE en caso de que ese número sea primo, y el valor FALSE en caso contrario.
Se sugiere ir probando a dividir ese número entre todos los inferiores a la mitad de él (si no es divisible de forma exacta por ningún número inferior a su mitad, ya sólo puede serlo por sí mismo) empezando por 2 y continuando sólo con los impares (si no es divisible entre 2 no lo será tampoco entre ningún otro par), y en cuanto el módulo de alguna de esas divisiones sea nulo, determinar que no es primo y abandonar el bucle con un break.
Si se alcanza el final del bucle, es número debe ser primo.
*/
function esPrimo($num){
	for($i=2;$i<$num/2;$i++)
	{
		if($num%$i==0){
			return false;
			break;
		}
	}
	return true;
}

$numero=10;
echo ($numero." es primo? ".esPrimo($numero)."<br>");
$numero=7;
echo ($numero." es primo? ".esPrimo($numero)."<br>");
$numero=11;
echo ($numero." es primo? ".esPrimo($numero)."<br>");
echo "<br>---Fin ej11---<br>"
?>

<h3> Ejercicio 12 </h3>

<?php
/*12- Para garantizar la cadena de frío de cierto número de cajas con vacunas en un transporte se ha instalado en cada una de ellas un sensor que ha ido recogiendo la evolución de la temperatura. 
Los datos recogidos por los sensores están disponibles en el array $temperaturas del código que se muestra a continuación.Añada el código necesario para que se indique qué cajas han estado en algún
 momento sometidas a una temperatura superior a 4º. 
*/
$tempMax=4;//4 será la temperatura mínima a la que saltrá la aletra
$temperaturas=array();
$temperaturas['Caja_1']=array(1,1,2,3,2,1,2,3,3,3,2,1,3,4);
$temperaturas['Caja_2']=array(0,0,3,2,4,3,2,0,1,2,3,4,2,1);
$temperaturas['Caja_3']=array(3,1,2,3,5,2,2,0,1,2,3,4,2,1);
$temperaturas['Caja_4']=array(2,2,2,3,5,2,3,2,0,1,2,3,0,1);
$temperaturas['Caja_5']=array(0,3,2,3,5,2,3,2,0,1,2,3,0,1);

foreach($temperaturas as $key => $value)//$value sera el array de temperaturas de cada caja
	for($i=1; $i < sizeof($value); $i++)
	{
		if($value[$i] >= $tempMax)
		{
			echo "Alerta temperatura superior a ".$tempMax." en: ".$key." momento con indice: ".$i." TEMP: ".$value[$i]."<br>";
			//break;
		}
	}	
echo "<br>---Fin ej12---<br>"
?>

<h3> Ejercicio 13 </h3>

<?php
/*13- Crear una función que nos cree una tabla. El prototipo de la función debe ser como el que aparece a continuación
crear_tabla(4, 6,'width: 60px;','height: 40px;','background: pink;','border: 3px dashed blue;');
Los parámetros en rojo son obligatorios y los demás no lo son, por tanto, cuando no los pasan tomara el alto y ancho de 70 el color azul y el borde negro.
*/
function crear_tabla($col, $row){
	$args= func_get_args();
	
	$x= isset($args[2]) ? $args[2] :'width: 70px;';
	$y= isset($args[3]) ? $args[3] :'height: 70px;';
	$color= isset($args[4]) ? $args[4] :'background: blue;'; 
	$border= isset($args[5]) ? $args[5] :'border: 3px dashed black;';

	$tabla="<table style='".$x."".$y."".$color."".$border."'></tbody>";
	for($i=0; $i < $row; $i++)
	{
		$tabla.='<tr>';
		for($j=0; $j < $col; $j++)
		{
			$tabla.='<td></td>';
		}
		$tabla.='</tr>';
	}
	$tabla.='</tbody></table>';
	
	return $tabla;
}

echo crear_tabla(4, 6,'width: 60px;','height: 40px;','background: pink;','border: 3px dashed blue;');
echo crear_tabla(4, 6,'width: 60px;');

echo "<br>---Fin ej13---<br>"
?>
</body>
</html>