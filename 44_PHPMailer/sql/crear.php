<meta charset="UTF-8" />
<?php
require('../config.php');
require('connection.php');

$q= array(
    'Tipo' => array('Piso','Adosado','Chale','Mansion'),
    'Zona' => array('Residencial','Rural','Urbana','Exteriores'),
    'Dormitorios'=>  array('1','2','3','4'),
    'Precio'=> array('100.000','200.000','300.000','400.000'),
    'Extras'=> array('Jardin','Piscina','Garage','Nada')
);

//Crear base de datos
$sqlbd= "CREATE DATABASE IF NOT EXISTS ".BBDD." DEFAULT COLLATE latin1_spanish_ci;";

if(!$connect = $mysqli->query( $sqlbd)){
    printf("Falló la creación de la bade de datos: %s\n", $mysqli->connect_error);
    exit();    
}else{
    $mysqli->select_db(BBDD);
    
    $fkey='casa';
    $sql="DROP TABLE ".$fkey;
    if(!$mysqli->query($sql)) 
        echo '<div class="alertFAIL">No Existe la tabla '.$fkey.' por lo que se ha creado.</div>';
    
    //DROPs
    foreach($q as $key => $value){
        $sql="DROP TABLE ".$key;
        if(!$mysqli->query($sql)) 
            echo '<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';
        //CREATE
        $sql="CREATE TABLE IF NOT EXISTS ".$key."
               (ID        INT NOT NULL AUTO_INCREMENT,
                NAME     VARCHAR(200),
                CONSTRAINT ".$key."_pk PRIMARY KEY (ID)) engine=InnoDB;";
        $mysqli->query("SET NAMES 'utf8'");
        if(!$resultado = $mysqli->query($sql))
            echo'<div class="alertFAIL">Error al crear la tabla</div>';

        //INSERT's
        foreach($value as $v){
            $sql="INSERT INTO ".$key." (NAME) VALUES ('".$v."');"; 
            $mysqli->query("SET NAMES 'utf8'");
            if (!$resultado = $mysqli->query($sql))
                echo'<div class="alertFAIL">Error al Insertar en '.$key.'-'.$v.'</div>';
        }
        
    }
    
    //Especifica
    $key=$fkey;//nombre tabla
    $v="Casa GRANDE";
    
    //CREATE CASA
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            NAME     VARCHAR(200),
            IMAGEN   VARCHAR(200),
            id_tipo     INT,
            id_zona     INT,
            id_dorm     INT,
            id_precio   INT,
            id_extra    varchar(5),
            
            FOREIGN KEY (id_tipo) REFERENCES Tipo(ID) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (id_zona) REFERENCES Zona(ID) ON UPDATE CASCADE ON DELETE RESTRICT,
            FOREIGN KEY (id_dorm) REFERENCES Dormitorios(ID) ON UPDATE CASCADE ON DELETE RESTRICT,
            FOREIGN KEY (id_precio) REFERENCES Precio(ID) ON UPDATE CASCADE ON DELETE RESTRICT,
            
            CONSTRAINT ".$key."_pk PRIMARY KEY (ID)
            ) engine=InnoDB;";
    $mysqli->query("SET NAMES 'utf8'");
    if(!$mysqli->query($sql))
        echo'<div class="alertFAIL">Error al crear la tabla</div>';

    //INSERT's
    $sql="INSERT INTO ".$key."
    (NAME,IMAGEN,id_tipo,id_zona,id_dorm,id_precio,id_extra) 
    VALUES ('".$v."','imagen/default.jpg',1,1,1,1,'123');"; 
    $mysqli->query("SET NAMES 'utf8'");
    if (!$resultado = $mysqli->query($sql))
        echo'<div class="alertFAIL">Error al Insertar en '.$key.'-'.$v.'</div>';
    
    $mysqli->close();
    echo '<META http-equiv="refresh" content="2;URL=../index.php">';
}
?>