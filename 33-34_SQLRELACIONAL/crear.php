<?php
    require('conection.php');
    
    //Crear base de datos
    $sqlbd= "CREATE DATABASE IF NOT EXISTS ".BBDD." DEFAULT CHARACTER SET latin1 DEFAULT COLLATE latin1_spanish_ci;";
    
    if(!$connect = $mysqli->query( $sqlbd)){
        printf("Falló la creación de la bade de datos: %s\n", $mysqli->connect_error);
        exit();    
    }else{
        $mysqli->select_db(BBDD);
        //DROPs
        $sql="DROP TABLE pelicula";
        if(!$mysqli->query($sql)) echo'<div class="alertFAIL">No Existe la tabla pelicula</div>';
        $sql="DROP TABLE tipos";
        if(!$resultado = $mysqli->query($sql)) echo'<div class="alertFAIL">No Existe la tabla tipos</div>';
        $sql="DROP TABLE personal";
        if(!$resultado = $mysqli->query($sql)) echo'<div class="alertFAIL">No Existe la tabla personal</div>';
        
        //CREATE TIPOS
        $sql="CREATE TABLE IF NOT EXISTS tipos
               (ID        INT NOT NULL AUTO_INCREMENT,
                NAME     VARCHAR(20),
                CONSTRAINT tip_pk PRIMARY KEY (ID)) engine=InnoDB;";
        $mysqli->query("SET NAMES 'utf8'");
        if(!$resultado = $mysqli->query($sql))
            echo'<div class="alertFAIL">Error al crar la tabla</div>';

        $sql="INSERT INTO tipos (NAME) VALUES 
            ('TERROR'),
            ('COMEDIA'),
            ('POTAR'),
            ('PAPABLES');"; 
        $mysqli->query("SET NAMES 'utf8'");
        if (!$resultado = $mysqli->query($sql));
        
        //CREATE personal
        $sql="CREATE TABLE IF NOT EXISTS personal
               (ID        INT NOT NULL AUTO_INCREMENT,
                NAME     VARCHAR(20),
                CONSTRAINT emp_empno_pk PRIMARY KEY (ID)) engine=InnoDB;";
        $mysqli->query("SET NAMES 'utf8'");
        if(!$resultado = $mysqli->query($sql))
            echo'<div class="alertFAIL">Error al crar la tabla</div>';

        $sql="INSERT INTO personal VALUES 
            (3,'SMITH'),
            (1,'ALLEN'),
            (15,'WARD'),
            (10,'JONES');";
        $mysqli->query("SET NAMES 'utf8'");
        if (!$resultado = $mysqli->query($sql));

        //CREATE PELICULA
        $sql="CREATE TABLE IF NOT EXISTS pelicula
               (ID        INT NOT NULL AUTO_INCREMENT,
                NAME     VARCHAR(20),
                REF_TP    INT,
                AÑO       INT(4),
                ACTOR     INT,
                DIR       INT,
                IMG      VARCHAR(250),

                INDEX (REF_TP),
                INDEX (ACTOR),
                INDEX (DIR),

                FOREIGN KEY (REF_TP) REFERENCES tipos(ID)
                ON UPDATE CASCADE ON DELETE RESTRICT,


                FOREIGN KEY (ACTOR) REFERENCES personal(ID)
                ON UPDATE CASCADE ON DELETE RESTRICT,

                FOREIGN KEY (DIR) REFERENCES personal(ID)
                ON UPDATE CASCADE ON DELETE RESTRICT,

                CONSTRAINT peli_pk PRIMARY KEY (ID)) ENGINE=InnoDB";
        $mysqli->query("SET NAMES 'utf8'");
        if(!$resultado = $mysqli->query($sql))
            echo'<div class="alertFAIL">Error al crar la tabla</div>';

        $sql="INSERT INTO pelicula (NAME, REF_TP, AÑO, ACTOR, DIR, IMG)  VALUES 
            ('Toy story',1,2000,1,1,'http://www.showbiz411.com/wp-content/uploads/2014/11/Hollywood-Film-Awards-main-page.jpg'),
            ('Braveheart',2,2000,1,10,'http://www.showbiz411.com/wp-content/uploads/2014/11/Hollywood-Film-Awards-main-page.jpg'),
            ('Mogambo',1,2000,1,10,'http://www.showbiz411.com/wp-content/uploads/2014/11/Hollywood-Film-Awards-main-page.jpg'),
            ('Moulin Rouge',2,2000,1,15,'http://www.showbiz411.com/wp-content/uploads/2014/11/Hollywood-Film-Awards-main-page.jpg'),
            ('E.T.',3,2005,1,10,'http://www.showbiz411.com/wp-content/uploads/2014/11/Hollywood-Film-Awards-main-page.jpg');";
        $mysqli->query("SET NAMES 'utf8'");
        if (!$resultado = $mysqli->query($sql)){
            echo "fallo en crear pelis";
        }else{
            echo "Todo correcto";
        }
        $mysqli->close();
        echo '<META http-equiv="refresh" content="2;URL=index.php">';
    }
?>