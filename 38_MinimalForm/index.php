<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ejercicio 38</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/st.css" />
</head>
<body>
<?php
//includes
    session_start();
    require_once('config.php');
    require_once('sql/connection.php');
    require_once('sql/sql.php');
    require_once('imagen/photo.php');
    require_once('function.php');
    
//indice de questions
    $i = isset($_SESSION['i']) ? $_SESSION['i'] : 0 ;
//comprivación de tipo de acción (si cambio a modo edit reseteo indice y cambio array)
    if(isset($_GET['edit'])){ $_SESSION['edit']=true; $i=0;}

//Guardar la respuesta a la pregunta que emite
    if(isset($_POST) && $i!=0){
        if($i==2 && isset($_SESSION['edit'])){
            $_SESSION['q'.$i] = isset($_FILES['res']) ? UpPhoto("imagen/",'res') : "imagen/default.jpg" ;
        }else
            empty($_POST) ? $i=$i-1 :  $_SESSION['q'.$i]=$_POST ;
    }

    $array= (isset($_SESSION['edit'])) ?
        array(array('Casa'=> 'input'),array('Imagen'=> 'file'),array('Tipo' => 'select'),array('Zona' => 'radio'),array('Dormitorios'=>  'radio'),array('Precio'=> 'radio'),array('Extras'=> 'checkbox'))
        :
        array(array('Tipo' => 'select'),array('Zona' => 'radio'),array('Dormitorios'=>  'radio'),array('Precio'=> 'radio'),array('Extras'=> 'checkbox'));
    
    $max=sizeof($array);

//variables condicionales
    if(isset($_GET['delete'])){
        delete();
        echo '<META http-equiv="refresh" content="0;URL=index.php">';
    }
    if(isset($_GET['back'])){
        $i=$i-1;
    }
?>
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
    .'<a href="'.$_SERVER['PHP_SELF'].'?delete" class="notifi" >Buscar casas</a>'
    .'<form acction="'.$_SERVER['PHP_SELF'].'" mothod="post" style="display: inline;">'
    .'<button name="edit" class="notifi" >Crear casa</button></form>';
    echo '</div>';
?>
<header class="codrops-header">
    <h1>Form to exercise 38 <span>
        <?php echo (isset($_GET['edit']) || isset($_SESSION['edit']) ) ? 'Añadir casa' : 'Buscar'; ?> </span></h1>	
</header>
<section>

<div class="simform-inner">
    <form  action=<?php echo "$_SERVER[PHP_SELF]"; ?> method="post" id="theForm" class="simform" autocomplete="off" enctype='multipart/form-data'>
    <?php
    if($i<$max){
        mostrar($mysqli,$i,$max,$array[$i]);
    }else{
        if(isset($_SESSION['edit'])){
            $extras=isset($_SESSION['q7']['res'][0]) ? $_SESSION['q7']['res'][0] : " ";
            $extras.=isset($_SESSION['q7']['res'][1]) ? $_SESSION['q7']['res'][1] : " ";
            $extras.=isset($_SESSION['q7']['res'][2]) ? $_SESSION['q7']['res'][2] : " ";
            
            saveValues($mysqli,$_SESSION['q1']['res'],$_SESSION['q2'],$_SESSION['q3']['res'],
                        $_SESSION['q4']['res'],$_SESSION['q5']['res'],$_SESSION['q6']['res'],$extras);
            
            //para borrar el campo nombre de session y poder mostrar la casa
            unset($_SESSION['edit']);
            unset($_SESSION['q1']);
            unset($_SESSION['q2']);
        }
        if(sizeof($_SESSION)<5){
            $filter= "Error no se añadieron todos los filtros";
        }else{
            viewSearch($mysqli,filter());
        }
        delete();
    }
    ?>
    </form>		
</div>
</section>

</div><!-- /container -->
<script type="text/javascript">
var a =<?php echo (($i+1)/$max*100);?>;
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