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
$max=5;
$i = isset($_SESSION['i']) ? $_SESSION['i'] : 0 ;
$array= array(
    array('Tipo' => 'select'),
    array('Zona' => 'radio'),
    array('Dormitorios'=>  'radio'),
    array('Precio'=> 'radio'),
    array('Extras'=> 'checkbox'));

if(isset($_POST) && $i!=0) $_SESSION['result'.$i]=$_POST;
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
        .'<a href="'.$_SERVER['PHP_SELF'].'?delete" class=\'btn\' >Borrar cookies</a>';
    ?>
    <header class="codrops-header">
        <h1>Form to exercise 38 <span>Guided input's</span></h1>	
    </header>
    <section>

        <form action=<?php echo "$_SERVER[PHP_SELF]"; ?> method="post" id="theForm" class="simform" autocomplete="off">
            <div class="simform-inner">

                    <?php
                        if($i<$max){
                            foreach($array[$i] as $key => $value) {
                            echo '
                            <span><label for="'.($i+1).'"></label>'.$key.'</span>
                            <ol class="questions">
                            <li id="'.($i+1).'" class="questinfo"><ul>';
                                if($value=='select')
                                {
                                    echo '<li><select onchange="this.form.submit()" class="quest" name='.($i+1).'>';
                                    select($mysqli, $key,$value,$i+1);
                                    echo '</select></li>';
                                }else{
                                    select($mysqli, $key,$value,$i+1);
                                }
                            echo '</ul></li><li><button class="next" id="next">&#10004;</button></li>';
                            }
                            $_SESSION['i'] = $i+1;
                        }else{
                            var_dump($_SESSION);
                            delete();//TO DO
                        }
                    ?>
                </ol>
<!--						<button class="submit" type="submit">Enviar resultados</button>-->
                <div class="controls">
                    <div class="progress" id="barra"></div>
                    <span class="number" id="number">
                        <?php
                            echo ($i+1)."/$max";
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
    var a =<?php echo (($i+1)/$max*100);?>;
    onload = function() {
        document.getElementById('barra').style.width=a+"%"; 
        document.getElementById('next').style.visibility='visible';
        };
    </script>
</body>
</html>