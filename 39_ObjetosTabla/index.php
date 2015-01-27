<?php
class Tabla{
	private $col;
	private $row;
	private $table;

	//si no lo inserta utiliza constructor vacio
	public function __construct( $col,$row ){
		$this->col = $col;
		$this->row = $row;
		$this->load();
	}

	public function __toString(){
		return $this->dibujar()."(".$this->col.",".$this->row.")";
	}

	public function load(){
		for( $i = 0; $i < $this->col; $i++ ){
			for( $j = 0; $j < $this->row; $j++ ){
				$this->table[$i][$j] = 0;
			}
		}
	}

	public function loadTable( $col,$row,$val ){
		$this->table[($col-1)][($row-1)] = $val;
	}

	public function dibujar(){
		$str = "<table border=1>";
		for( $i = 0; $i < $this->col; $i++ ){
			$str.="<tr>";
			for( $j = 0; $j < $this->row; $j++ ){
				 $str.= "<td>".$this->table[$i][$j]."</td>" ;
			}
			$str.="</tr>";
		}
		$str.= "</table>";
		return $str;
	}
}

$class = new Tabla(3,3);
$class->loadTable(3,3,1);

echo $class;
?>