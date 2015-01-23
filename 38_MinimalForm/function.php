<?php
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
function mostrar($mysqli,$i,$max,$array){
	foreach($array as $key => $value) {
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
}
?>