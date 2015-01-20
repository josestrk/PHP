<meta charset="UTF-8" />
<?php
require('../config.php');
require('connection.php');
$q= array(
    'Tipo' => array('Piso','Adosado','Chale','Mansion'),
    'Zona' => array('Residencial','Rural','Urbana','Exteriores'),
    'Dormitorios'=>  array('1','2','3','4'),
    'Precio'=> array('100.000','200.000','300.000','400.000'),
    'Extras'=> array('Jardin','Piscina','Garage')
);

//Crear base de datos
$sqlbd= "CREATE DATABASE IF NOT EXISTS ".BBDD." DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";

if(!$connect = $mysqli->query( $sqlbd)){
    printf("Falló la creación de la bade de datos: %s\n", $mysqli->connect_error);
    exit();    
}else{
    $mysqli->select_db(BBDD);

    //DROPs
    foreach($q as $key => $value){
        $sql="DROP TABLE ".$key;
        if(!$mysqli->query($sql)) echo'<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';

        //CREATE TIPOS
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
    $key="Casa";//nombre tabla
    
    $sql="DROP TABLE ".$key;
    if(!$mysqli->query($sql)) echo'<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';

    //CREATE TIPOS
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            NAME     VARCHAR(200),
            id_tipo     INT,
            id_zona     INT,
            id_dorm     INT,
            id_precio   INT,
            id_extra    varchar(5),
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
    $mysqli->close();
 echo '<META http-equiv="refresh" content="2;URL=../index.php">';
}
?>