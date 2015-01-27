<?php
class Opcion{
	private $titulo;
	private $enlace;
	private $colorFondo;

	//si no lo inserta utiliza constructor vacio
	public function __construct( $titulo,$enlace,$colorFondo ){
		$this->titulo = $titulo;
		$this->enlace = $enlace;
		$this->colorFondo=$colorFondo;
	}

	public function __toString(){
		return $this->colorFondo."(".$this->titulo.",".$this->enlace.")";
	}

	public function dibujar(){
		return "<a href=".$this->enlace." style='background:".$this->colorFondo."'>".
		$this->titulo."</a>";
	}
}

class Menu{
	private $menu;
	private $type;

	public function __construct( $type ){
		$this->menu = array();
		$this->type = $type;
	}

	public function insert($item){
		array_push($this->menu,$item);
	}

	public function dibujar(){
		echo "<ul style='display:".$this->type.";list-style:none;'>";
		foreach ($this->menu as $value) {
			echo "<li>".$value->dibujar()."</li>";
		}
		echo "</ul>";
	}
}


$class = new Opcion("enlace1","../","yellow");
echo $class->dibujar();

$menu = new Menu("flex");
$menu->insert($class);
$menu->insert($class);
echo $menu->dibujar();






?>