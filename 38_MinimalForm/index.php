<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ejercicio 38</title>

    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/st.css" />


    <?php
//includes
    session_start();
    require_once('config.php');
    require_once('sql/connection.php');
    require_once('sql/sql.php');
    require_once('imagen/photo.php');

//functions
    function delete(){
        $_SESSION=array();
        unset($_SESSION);
        session_destroy();
    }
    function filter(){
        unset($_SESSION['i']);
        $filter=array();
        foreach ($_SESSION as $value) {
            foreach ($value as $data) {
                if(is_array($data)){
                    $aux="";
                    foreach ($data as $res) 
                        $aux.="%".$res;
                    array_push($filter,$aux);
                }else{
                    array_push($filter,$data);
                }
            }
        }
        return $filter;
    }
    
//varialbes
    //indice de questions
    $i = isset($_SESSION['i']) ? $_SESSION['i'] : 0 ;
    //comprivación de tipo de acción (si cambio a modo edit reseteo indice y cambio array)
    if(isset($_GET['edit'])){ $_SESSION['edit']=true; $i=0;}

    //Guardar la respuesta a la pregunta que emite
    if(isset($_POST) && $i!=0){
        if($i==2 && isset($_SESSION['edit'])){
            $_SESSION['q'.$i] = isset($_FILE['img']) ? "imagen/".UpPhoto("imagen",'img') 
                : "imagen/default.jpg" ;
        }else
            $_SESSION['q'.$i]=$_POST;
    }

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
        array('Imagen'=> 'file'),
        array('Tipo' => 'select'),
        array('Zona' => 'radio'),
        array('Dormitorios'=>  'radio'),
        array('Precio'=> 'radio'),
        array('Extras'=> 'checkbox'));
    
    $max=sizeof($array);

//variables condicionales
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
            foreach($array[$i] as $key => $value) {
                echo '
                <span><label for="'.($i).'"></label>'.$key.'</span>
                <ol class="questions">
                <li id="'.($i).'" class="questinfo"><ul>';
                    if($value=='select')
                    {
                        echo '<li><select onchange="this.form.submit()" autofocus class="quest" name="res">';
                        select($mysqli, $key,$value,'res');
                        echo '</select></li>';
                    }elseif($key=="Casa" || $key=="Imagen" ){
                        selectNoTable($value,'res');
                    }else{
                        select($mysqli, $key,$value,'res');
                    }
                    echo '</ul></li>
                    <li><button class="next" id="next" type="submit">&#10140;</button>
                        <a href="index.php?back" class="next" id="back">&#10140;</a>
                    </li>';
            }
            $i++;
            $_SESSION['i'] = $i;
            echo '</ol>
            <div class="controls">
            <div class="progress" id="barra"></div>
            <span class="number" id="number">
            '.($i).'/'.$max.'
            </span>
            <span class="error-message"></span>
            </div>';
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