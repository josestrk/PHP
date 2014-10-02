<meta charset="utf-8" />
<?php
$baraja =array();

function fullArrayE(&$baraja,$tam){
	for($i= 0; $i< $tam; $i++){
		if($i<10){
			$baraja[$i]=($i+1)." COPAS";
		}elseif ($i>=10 && $i<20){
			$baraja[$i]=($i-9)." BASTOS";
		}elseif ($i>=20 && $i<30){
			$baraja[$i]=($i-19)." ESPADAS";
		}else{
			$baraja[$i]=($i-29)." OROS";
		}
	}
}
function fullArrayF(&$baraja,$tam){
	for($i= 0; $i< $tam; $i++){
		if($i<13){
			$baraja[$i]=($i+1)."♦";
		}elseif ($i>=13 && $i<26){
			$baraja[$i]=($i-12)."♣";
		}elseif ($i>=26 && $i<39){
			$baraja[$i]=($i-25)."♠";
		}else{
			$baraja[$i]=($i-38)."♥";
		}
	}
}

function desordenarBaraja( &$baraja ) {
	$i= 0;
	do{
    	$carta = array_rand( $baraja, 1);
		if(!existe($baraja[$carta], $azarbraja)){
			$azarbraja[$i]= $baraja[$carta];
			$i++;
		}
	}while($i< sizeof($baraja));
	$baraja=$azarbraja;
}

function existe( $carta,&$azarbraja) {
	for($i = 0; $i < sizeof($azarbraja) ; $i++ ) {
    	if( $carta === $azarbraja[$i] ){
			return true;
		}
	}
	return false;
}

function visualizar(&$baraja) {
  for($i = 0; $i < sizeof($baraja) ; $i++ ) {
    echo $baraja[$i]."<br>";
  }
}
function visualizarPlayer(&$baraja,$repartir) {
	static $player=1;
	static $extraigo=0;
	if($player >= 3){
		echo "<hr>MESA<br>";
	}else{
		echo "<hr>Player ".$player."<br>";
	}
	for($i = $extraigo; $i < $extraigo+$repartir ; $i++ ) {
		echo $baraja[$i]."<br>";
	}
  	$extraigo=$i;
	$player++;
}



echo 'Pulsa F5 para barajar de nuevo'.'<br>'.'<br>';
fullArrayF($baraja,52);
desordenarBaraja($baraja);

echo "<h3>POKER</h3><br><br>";
visualizarPlayer($baraja,2);
visualizarPlayer($baraja,2);
visualizarPlayer($baraja,3);
visualizarPlayer($baraja,1);
visualizarPlayer($baraja,1);


echo "<h3>POKER TEXAS</h3><br><br>";
visualizarPlayer($baraja,5);
visualizarPlayer($baraja,5);
visualizarPlayer($baraja,5);

?>