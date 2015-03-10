<?php
class Carrito {
    private $id;
    private $num;
    private $articulos;
    
    public function __construct($id,$articulos) {
        $this->id = $id;
        $this->articulos = $articulos;
        $this->num=sizeof($this->articulos);
    }
    
    public function addArt($art) {
        array_push($this->articulos,$art);
        $this->num +=1;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getNum(){
        return $this->num=sizeof($this->articulos)-$this->getCant(0);
    }
    
    public function quitArt($idart) {
        foreach( $this->articulos as $i){
            if($i->getId() == $idart){
                $i->idChange(0);
                $this->num -=$this->getCant($i->getId());
                $i->modCant(0);
            }
        }
    }
    
    public function artFind($id){
        $art=$this->articulos;
        foreach($art as $i){
            if($i->getId() == $id){
                return true;
            }
        } 
        return false;
    }
    
    public function getCant($id){
        $art=$this->articulos;
        foreach($art as $i){
            if($i->getId() === $id)
                return $i->getCant();
        }
        return false;
    }
    
    public function modCant($id,$mod){
        $art=$this->articulos;
        foreach($art as $i){
            if($i->getId() === $id)
                return $i->modCant($mod);
        }
        return false;
    }
    public function totalCant(){
        $cant=0;
        $art=$this->articulos;
        foreach($art as $i){
            
            $cant += $i->getCant();
        }
        return $cant;
    }
    
    
    public function __toString(){
        return $this->id . "(" . $this->num . ",ARTICULOS:" . $this->articulos . ")";
    }
    
    public function dibujar($path){
        $total=0;
        $mm = "<div class='carrito'> <h3>Carrito $this->id</h3><h4>Productos:$this->num</h4>";
        $mm .="<div class='productos'>";
        foreach( $this->articulos as $i){
            if($i->getId() != 0){
                $total += $i->getPrecio();
                $mm .= "<div class='quit'><a href='" . $_SERVER['PHP_SELF'] . "?" . $path . "carrito=see&quit=" . $i->getId() . "'>Quit</a></div>" . $i->dibujar();
            }
        }
        $mm .= "</div><h4>Total:" . $total . "€</h4></div>";
        return $mm;
    }
    public function dibujarConFoto($path){
        $total=0;
        $save= array();
        $mm = "<div class='carrito'> <h3>Carrito $this->id</h3><h4>Productos:" . $this->totalCant() . "</h4>";
        $mm .="<table class='productos'><th></th><th>Cantidad</th><th>Foto</th><th>Producto</th><th>Precio</th>";
        foreach( $this->articulos as $i){
            if($i->getId() != 0){
                if(!in_array($i->getId(),$save)){
                    $total += $i->getPrecio();
                    $mm .= "<tr><td class='quit'><a href='" 
                        . $_SERVER['PHP_SELF'] . "?" . $path . "carrito=see&quit=" 
                        . $i->getId() . "'>Quit</a></td>"
                        . "<td>"
                        . $this->addCart($i)
                        . "</td>"
                        . $i->dibujarConFoto() . "</tr>";
                    array_push($save,$i->getId());
                }
            }
        }
        $mm .= "</table><h4>Total:" . $total . "€</h4></div>";
        return $mm;
    }
    public function addCart($info){
       $id=$info->getId();
       $mm = "<form class='formLS' action='index.php?index2=2&view_cart=1&actuliza=yes' method = 'POST'>";
        $mm .= '<input type="hidden" value="' . $id . '" name="id"/>';
        $mm .= '<input type="hidden" value="' . $info->getNombre() . '" name="nombre"/>';
        $mm .= '<input type="hidden" value="' . $info->getInfo() . '" name="info"/>';
        $mm .= '<input type="hidden" value="' . $info->getPrecio() . '" name="precio"/>';
        $mm .= "<input name='qty' type='number' style='width:100px; margin:auto;' value='" 
            . $this->getCant($id) . "' required />
            <input type='submit' value='Mod Quantity' 
            class='sb' style='width:100px' required /></form>";
        return $mm;
    }
}
?>