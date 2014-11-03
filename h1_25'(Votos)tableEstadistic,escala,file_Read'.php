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
function base($num){
	$i=1;
	do{
		$num=$num/10;
		$i=$i*10;
	}while($num>10);
	return $i;
}
$average = array_count_values(file('votos.txt', FILE_IGNORE_NEW_LINES));
$base=base(max($average));
$max=round((max($average)/$base));
?>

<table cellspacing=0 style="width:100%; margin:10px;">
	<tr><th colspan=<?php echo $max+1 ?> >Gráfico de barras</th></tr>
	<tr><td width=13%></td>
	<?php
		for($i=0;$i<=$max;$i++){
			echo "<td width=".(85/$base)."% style='border-left: 1px solid #000;'>".(($i)*$base)."</td>";
		}
		echo "</tr>";
		foreach ($average as $key => $value) {
			echo "<tr><td>$key - $value - $base</td>";
			//bloques por base
			for($j=1;$j<($value/$base);$j++){
				echo "<td  bgcolor='lightgreen' style='border-left: 1px solid #000;'></td>";
			}
			$value=($value%$base);
			//resto
			echo "
			<td style='border-left: 1px solid #000;'>
					<table width=".($value*85/$base)."% cellpadding='11px' cellspacing=0><tr>";
				echo "<td bgcolor='lightgreen'></td>";
			echo "	</tr></table>
			</td></tr>";
		}0 
	?>
</table>


</div>
</body>
</html>
