<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<title>Ejercicio 38</title>

		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/st.css" />


<?php
function delete(){
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
}
session_start();
require_once('config.php');
require_once('sql/connection.php');
require_once('sql/sql.php');

//indice de questions
$i = isset($_SESSION['i']) ? $_SESSION['i'] : 0 ;
//comprivación de tipo de acción (si cambio a modo edit reseteo indice y cambio array)
if(isset($_GET['edit'])){ $_SESSION['edit']=true; $i=0;}
//Guardar la respuesta a la pregunta que emite
if(isset($_POST) && $i!=0) $_SESSION['result'.$i]=$_POST;


$array= 
    (!isset($_SESSION['edit'])) ?
    array(
    array('Tipo' => 'select'),
    array('Zona' => 'radio'),
    array('Dormitorios'=>  'radio'),
    array('Precio'=> 'radio'),
    array('Extras'=> 'checkbox'))
    :
    array(
    array('Casa'=> 'input'),
    array('Tipo' => 'select'),
    array('Zona' => 'radio'),
    array('Dormitorios'=>  'radio'),
    array('Precio'=> 'radio'),
    array('Extras'=> 'checkbox'));
$max=sizeof($array);

if(isset($_GET['delete'])){
    delete();
    echo '<META http-equiv="refresh" content="0;URL=index.php">';
}
if(isset($_GET['back'])){
    $i=$i-2;
}
?>
</head>
<body>
    <div class="container">
    <!-- Top Navigation -->
    <?php
        echo '<div style="display:block;text-align: end;">';
        if(isset($_SESSION)){
            echo '<span class="notifi">ON';
        }else{
            echo '<span class="alert">OFF';
        }
        echo '</span>'
        .'<a href="'.$_SERVER['PHP_SELF'].'?delete" class=\'btn\' >Borrar cookies</a>'
        .'<form acction="'.$_SERVER['PHP_SELF'].'" mothod="post" >'
        .'<button name="edit" value="Crear casa"></form>';
        echo '</div>';
    ?>
    <header class="codrops-header">
        <h1>Form to exercise 38 <span>
            <?php echo (isset($_GET['edit'])) ? 'Añadir casa' : 'Buscar'; ?> </span></h1>	
    </header>
    <section>

        <form action=<?php echo "$_SERVER[PHP_SELF]"; ?> method="post" id="theForm" class="simform" autocomplete="off">
            <div class="simform-inner">
                    <?php
                        if($i<$max){
                            foreach($array[$i] as $key => $value) {
                                echo '
                                <span><label for="'.($i).'"></label>'.$key.'</span>
                                <ol class="questions">
                                <li id="'.($i).'" class="questinfo"><ul>';
                                    if($value=='select')
                                    {
                                        echo '<li><select onchange="this.form.submit()" class="quest" name='.($i).'>';
                                        select($mysqli, $key,$value,$i);
                                        echo '</select></li>';
                                    }else{
                                        select($mysqli, $key,$value,$i);
                                    }
                                echo '</ul></li><li><button class="next" id="next">&#10140;</button>
                                <a href="index.php?back" class="next" id="back">&#10140;</a></li>';
                            }
                            $i++;
                            $_SESSION['i'] = $i;
                        }else{
                            var_dump($_SESSION);
                            delete();
                        }
                    ?>
                </ol>
                <div class="controls">
                    <div class="progress" id="barra"></div>
                    <span class="number" id="number">
                        <?php
                            echo ($i)."/$max";
                        ?>
                    </span>
                    <span class="error-message"></span>
                </div>

                <!-- / controls -->
            </div><!-- /simform-inner -->
            <span class="final-message"></span>
        </form><!-- /simform -->			
    </section>

    </div><!-- /container -->
    <script type="text/javascript">
    var a =<?php echo (($i)/$max*100);?>;
    onload = function() {
        document.getElementById('barra').style.width=a+"%";
        if (<?php echo ($i==1)? 1 : 0 ;  ?>) {
            document.getElementById('next').style.visibility='hidden';
        }else{
            document.getElementById('next').style.visibility='visible';
            document.getElementById('back').style.visibility='visible';
        };
    };
    </script>
</body>
</html>