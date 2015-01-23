<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*25. Recuento de votos de votos de una elección. 
Realizar el escrutinio y presentar los resultados de los países candidatos
*/
include_once("style/style_old.css");
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
	<tr><th colspan=<?php echo $max+2 ?> >Gráfico de barras</th></tr>
	<tr><td width=8%></td>
	<?php
		for($i=0;$i<=$max;$i++){
			echo "<td width=".(92/$base)."% style='border-left: 1px solid #000;'>".(($i)*$base)."</td>";
		}
		echo "</tr>";
		foreach ($average as $key => $value) {
                    echo "<tr style='height: 30px;'><td align='right'>$key [$value]</td>";
                    //bloques en base que se colorean
                    for($j=1;$j<=($value/$base);$j++){
                            echo "<td   bgcolor='lightgreen' style='border-left: 1px solid #000;border-bottom: 2px solid #fff;border-top: 2px solid #fff;'></td>";
                    }
                    //resto
                    $resto=($value%$base);
                    if($resto>0)
                        echo "<td style='border-left: 1px solid #000;'>"
                            . "<table width=".($resto*92/$base)."% cellpadding='13px' cellspacing='0px'><tr><td bgcolor='lightgreen'></td></tr></table>"
                            . "</td>";
                   //finaliza tabla sin colrear
                    do{
                        $j++;
                        echo "<td style='border-left: 1px solid #000;'></td>";
                    }while($j<=$max);  
                    echo "</tr>"; //cierro fila 
		}
	?>
</table>


</div>
</body>
</html>
