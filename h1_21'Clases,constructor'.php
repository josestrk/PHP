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
		echo '<div style="width:100%; height:70px; border-bottom: 3px groove yellow; border-top: 3px groove yellow; background:'. $this->colorfondo .';
background: -moz-linear-gradient(top,  '. $this->colorfondo .' 0%, #f3f3f3 50%, #ededed 51%, '. $this->colorfondo .' 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'. $this->colorfondo .'), color-stop(50%,#f3f3f3), color-stop(51%,#ededed), color-stop(100%,'. $this->colorfondo .')); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  '. $this->colorfondo .' 0%,#f3f3f3 50%,#ededed 51%,'. $this->colorfondo .' 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  '. $this->colorfondo .' 0%,#f3f3f3 50%,#ededed 51%,'. $this->colorfondo .' 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  '. $this->colorfondo .' 0%,#f3f3f3 50%,#ededed 51%,'. $this->colorfondo .' 100%); /* IE10+ */
background: linear-gradient(to bottom,  '. $this->colorfondo .' 0%,#f3f3f3 50%,#ededed 51%,'. $this->colorfondo .' 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='. $this->colorfondo .', endColorstr='. $this->colorfondo .',GradientType=0 ); /* IE6-9 */
; " align="center">
		<h1 style="color:'. $this->color .'; text-shadow: 19px 12px 5px grey;">'. $this->titulo .'</h1></div>';
	}
}
?>