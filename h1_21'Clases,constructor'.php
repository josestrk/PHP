<?php
/*21. Crear micebecera.php que pretende visualizar la cabecera con el siguiente aspecto
La clase Mi_Cabecera, tendrá su constructor y el método dibujar. Esta clase debe ser incluida en micanecera.php que será el programa que utiliza la clase creada
*/
class Cabecera{
	private $titulo;
	private $color;
	private $colorfondo;

	//si no lo inserta utiliza constructor vacio
	public function __construct($tit,$coloro,$colorf){
		$this->titulo=$tit;
		$this->color=$coloro;
		$this->colorfondo=$colorf;
	}

	public function dibujar(){
		echo '<div style="width:100%; height:70px; border-bottom: 3px groove yellow; border-top: 3px groove yellow; background-color:'. $this->colorfondo .';" align="center">
		<h1 style="color:'. $this->color .'">'. $this->titulo .'</h1></div>';
	}
}
?>