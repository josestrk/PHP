<?php
class Emp{
	private static $num_emp=0;
	protected $id;
	public $nombre;
	public $apellidos;

	//si no lo inserta utiliza constructor vacio
	public function __construct($nombre,$apellidos){
		self::$num_emp++;
		$this->id= self::$num_emp;
		$this->nombre=$nombre;
		$this->apellidos=$apellidos;
	}

	public function __toString(){
		return $this->id." ".$this->nombre." ".$this->apellidos;
	}
}

$class= array(new Emp('Tomas','Turbado'),
new Emp('Aitor','menta'),new Emp('Aitor','menta'));
foreach ($class as $key => $value) {
	echo $value;
 } 

?>