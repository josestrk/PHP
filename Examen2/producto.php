<?php
class Producto{
private $id;
private $nombre;
private $info;
private $precio;
//si no lo inserta utiliza constructor vacio
    public function __construct( $id,$nombre,$info,$precio ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio= $precio;
        $this->info= $info;
    }
    public function __toString(){
        return $this->id . "(" . $this->nombre . "," . $this->precio . ")";
    }
    public function idChange($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function getInfo(){
        return $this->info;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getFoto(){
        if  ($this->id==0)
            return "";
        return "<img src='imagenes/" . $this->id . ".jpg' style='width:200px'>";
    }
    public function dibujar(){
        return "<div class='producto'><span>$this->id</span> <span>$this->nombre</span> " . $this->precio . " €</div>";
    }
    public function dibujarConFoto(){
        return "<td style='width:200px'>" . $this->getFoto() . "</td> <td>$this->nombre</td><td>" . $this->precio . " €</td>";
    }
}
?>