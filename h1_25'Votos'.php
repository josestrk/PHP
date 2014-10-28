<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*25. Recuento de votos de votos de una elección. 
Realizar el escrutinio y presentar los resultados de los países candidatos
*/
require_once('style.css');
require_once("h1_21'Clases,constructor'.php");
$c=new Cabecera('VOTOS',"lightblue","#fff");
$c->dibujar();
?>
</head>
<body background='img/tx.jpg' style="background-repeat: repeat;">
	<div style='background: whitesmoke;'>
<?php
$average = file('votos.txt');
$array_items=array();
foreach ($average as $num_a => $item) {
	echo array_search($item, $array_items);
	}
var_dump($array_items);

?>
</div>
</body>
</html>