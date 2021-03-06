<meta charset="UTF-8" />
<?php
require_once('../config.php');

$mysqli = new mysqli(SERVER, USER, PASS);

if ( $mysqli->connect_errno ) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}

//Crear base de datos
$sqlbd= "CREATE DATABASE IF NOT EXISTS ".BBDD." DEFAULT COLLATE latin1_spanish_ci;";

if(!$connect = $mysqli->query( $sqlbd)){
    printf("Falló la creación de la bade de datos: %s\n", $mysqli->connect_error);
    exit();    
}else{
    $mysqli->select_db(BBDD);
    
    ///*************************************
    $key='USUARIOS';//nombre tabla**********
    ///*************************************
    
    //DROP
    $sql="DROP TABLE ".$key;
    if(!$mysqli->query($sql)) 
        echo '<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';
    
    //CREATE 
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            NAME      VARCHAR(200),
            APES      VARCHAR(200),
            EMAIL     VARCHAR(200),        
            CONSTRAINT ".$key."_pk PRIMARY KEY (ID)
            ) engine=InnoDB;";
    $mysqli->query("SET NAMES 'latin1_spanish_ci'");
    if(!$mysqli->query($sql))
        echo'<div class="alertFAIL">Error al crear la tabla</div>';
    else
        echo'<div class="alert">Tabla ' . $key . ' creada con Éxito</div>';  
    
    ///*************************************
    $key='LISTA';//nombre tabla*************
    ///*************************************

    //DROP
    $sql="DROP TABLE ".$key;
    if(!$mysqli->query($sql)) 
        echo '<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';

    //CREATE 
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            NAME      VARCHAR(200),
            CONSTRAINT ".$key."_pk PRIMARY KEY (ID)
            ) engine=InnoDB;";
    $mysqli->query("SET NAMES 'latin1_spanish_ci'");
    if(!$mysqli->query($sql))
        echo'<div class="alertFAIL">Error al crear la tabla</div>';
    else
        echo'<div class="alert">Tabla ' . $key . ' creada con Éxito</div>';  

    //RELACIONAL

    ///*************************************
    $key='US_LI';//nombre tabla*************
    ///*************************************

    //DROP
    $sql="DROP TABLE ".$key;
    if(!$mysqli->query($sql)) 
        echo '<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';
    
    //CREATE 
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            ID_US     INT,
            ID_LI     INT,

            FOREIGN KEY (ID_US) REFERENCES USUARIOS(ID) ON DELETE CASCADE ON UPDATE CASCADE,
            FOREIGN KEY (ID_LI) REFERENCES LISTA(ID) ON DELETE CASCADE ON UPDATE CASCADE,
            
            CONSTRAINT ".$key."_pk PRIMARY KEY (ID)
            ) engine=InnoDB;";
    $mysqli->query("SET NAMES 'latin1_spanish_ci'");
    if(!$mysqli->query($sql))
        echo'<div class="alertFAIL">Error al crear la tabla</div>';
    else
        echo'<div class="alert">Tabla ' . $key . ' creada con Éxito</div>';    

    ///*************************************
    $key='ADMIN';//nombre tabla*************
    ///*************************************

    //DROP
    $sql="DROP TABLE ".$key;
    if(!$mysqli->query($sql)) 
        echo '<div class="alertFAIL">No Existe la tabla '.$key.' por lo que se ha creado.</div>';
    
    //CREATE 
    $sql="CREATE TABLE IF NOT EXISTS ".$key."
           (ID        INT NOT NULL AUTO_INCREMENT,
            USER     VARCHAR(200),
            TIP      VARCHAR(200),
            PASS     VARCHAR(200),

            CONSTRAINT ".$key."_pk PRIMARY KEY (ID)
            ) engine=InnoDB;";
    $mysqli->query("SET NAMES 'latin1_spanish_ci'");
    if(!$mysqli->query($sql))
        echo'<div class="alertFAIL">Error al crear la tabla</div>';
    else
        echo'<div class="alert">Tabla ' . $key . ' creada con Éxito</div>';

    $sql= "INSERT INTO ".$key."
    (USER,TIP,PASS) 
    VALUES ('admin','administrador','manager');"; 
    $mysqli->query("SET NAMES 'utf8'");
    if (!$resultado = $mysqli->query($sql))
        echo'<div class="alertFAIL">Error al Insertar en '.$key.'-'.$v.'</div>';
    
    $mysqli->close();
    echo '<META http-equiv="refresh" content="0.8;URL=../index.php">';
}
?>