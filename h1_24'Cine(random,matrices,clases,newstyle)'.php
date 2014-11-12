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
$peliculas=array(
	new Film('El bosque','bosque.jpg','lorem ipsum colore samsdbew2bewqe'),
	new Film('Happens Vegas','vegas.jpg','...'),
	new Film('4f','4f.jpg','De todas las películas que tenemos en nuestro cine, en la página inicial  debemos presentar 3 que cambian aleatoriamente cada vez que nos conectamos al cine , de las 12 que tienen en el cine .Utilizar array _rand para trabajar aleatoriamente'),			
	new Film('Pinos','pino.jpg','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vestibulum lacus non arcu malesuada scelerisque. Morbi nunc magna, sagittis id facilisis bibendum, gravida sit amet arcu. Nunc nisi ipsum, eleifend at sapien imperdiet, elementum faucibus massa. Donec porta lorem at lectus vehicula fringilla. Phasellus porttitor felis id sem lobortis, quis congue nisi euismod. Donec at lectus mauris. Donec laoreet efficitur urna ac varius. Etiam sollicitudin malesuada neque sed rhoncus. Praesent consectetur condimentum sem, semper pharetra risus commodo eu. Nunc varius justo laoreet, dapibus eros eu, feugiat ex. Cras malesuada sapien eget commodo placerat. Mauris ante metus, volutpat ut blandit id, volutpat at lorem. Mauris dictum ipsum arcu, vitae aliquet lorem pharetra eget. Suspendisse porttitor tellus velit, quis ultrices arcu dictum et.'),
	new Film('Puentes','puente.jpg','lorem ipsum colore samsdbew2bewqe'),
	new Film('Albaricoques','alba.jpg','lorem ipsum colore samsdbew2bewqe')
);


//pinta cabecera
$c->dibujar();
?>
<center>
<?php

//pintar peliculas
$cont=0;
$arrayres=array();
do{
	$num=rand(0, 5);
	if(!in_array($num, $arrayres)){	
		$cont++;
		$peliculas[$num]->printing();
		array_push($arrayres, $num);
	}
}while ($cont<3);

?>
</center>
</body>
</html>