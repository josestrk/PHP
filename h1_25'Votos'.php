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
$average = array_count_values(file('votos.txt', FILE_IGNORE_NEW_LINES));
$max=round((max($average)/10));
?>

<table cellspacing=0 style="width:100%;">
	<tr><th colspan=<?php echo $max+2 ?> >Gráfico de barras</th></tr>
	<tr><td width:10%></td>
	<?php
		for($i=1;$i<=$max;$i++){
			echo "<td width=".(90/$max)."%>|".(($i-1)*10)."</td>";
		}
		echo "</tr>";
		foreach ($average as $key => $value) {
			echo "<tr><td>$key</td><td colspan='".($max+1) ."'><table width=".($value*$max*1.1)."% cellpadding=5px cellspacing=0>";
			echo "<td bgcolor='green'>$value</td>";
			echo "</table></td></tr>";
		}
	?>
</table>


</div>
</body>
</html>
