<?php
    require('conection.php');
    
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
            IMG      VARCHAR(50),

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
        ('Toy story',1,7902,1,1,'../cartelera/4f.jpg'),
        ('Braveheart',2,7698,1,10,'../cartelera/4f.jpg'),
        ('Mogambo',1,7698,1,10,'../cartelera/4f.jpg'),
        ('Moulin Rouge',2,7839,1,15,'../cartelera/4f.jpg');
        -- ('E.T.',1,7698,1,10),
        -- ('La momia',3,7839,1,10),
        -- ('Mujercitas',2,7839,1,10),
        -- ('El séptimo sello',4,7566,1,10),
        -- ('Moby Dick',3,7566,1,10),
        -- ('Reservoir dogs',1,7698,1,10),
        -- ('El halcón maltés',1,7788,1,10),
        -- ('El exorcista',1,7698,1,1),
        -- ('El exorcist2',3,7566,1,10),
        -- ('El exorcista3',4,7782,1,10)";
    $mysqli->query("SET NAMES 'utf8'");
    if (!$resultado = $mysqli->query($sql)){
        echo "fallo en crear pelis";
    }else{
        echo "Todo correcto";
    }
    $mysqli->close();
    echo '<META http-equiv="refresh" content="2;URL=index.php">';
?>