<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
WEB DE CINE
De todas las películas que tenemos en nuestro cine, en la página inicial debemos presentar 3 que cambian aleatoriamente cada vez que nos conectamos al cine , de las 12 que tienen en el cine .Utilizar array _rand para trabajar aleatoriamente.
*/
require_once('style.css');
require_once("h1_21'Clases,constructor'.php");
$c=new Cabecera('CINE',"purple","#fff");

class Film{
	private $titulo;
	private $img;
	private $desc;

	//si no lo inserta utiliza constructor vacio
	public function __construct($tit,$img,$desc){
		$this->titulo=$tit;
		$this->img=$img;
		$this->desc=$desc;
	}

	public function printing(){
		echo '<div style="width:30%; height:400px; border-bottom: 2px groove yellow; background: linear-gradient(to right, #a4edfc 0%,#ffffff 49%,#ffffff 51%,#a4edfc 100%); margin: 20px 15px;  box-shadow: 10px 10px  60px #666; float: left; overflow-y: auto;overflow-x: hidden;" align="center">
		<img src="cartelera/'.$this->img.'" width=240px height=200px><h1 style="color:lightblue">'. $this->titulo .'</h1><blockquote>'. $this->desc .'</blockquote></div>';
	}
}

?>
</head>
<body background='img/tx.jpg' style="background-repeat: repeat; ">
<?php

$myfile= @fopen("cartelera.txt","r") or die;
$array=array();
$i=0;

if($myfile){
	while(($a = fgets($myfile)) !== false){
		$a = explode("\\,", $a);
		array_push($array, (new Film ($a[0],$a[1],$a[2])));
	}
	if (!feof($myfile)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($myfile);
}


//pinta cabecera
$c->dibujar();
?>
<center>
<?php

//pintar peliculas
$cont=0;
$arrayres=array();
do{
	$num=rand(0, (sizeof($array)-1));
	if(!in_array($num, $arrayres)){	
		$cont++;
		$array[$num]->printing();
		array_push($arrayres, $num);
	}
}while ($cont<3);

?>
</center>
</body>
</html>