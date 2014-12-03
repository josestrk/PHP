<?php
function mostrar(&$mysqli){
    $sql="SELECT * FROM pelicula";
    $resultado = $mysqli->query($sql);

    if(!$resultado){
        echo'<div class="alertFAIL">No se accedio a datos</div>';
    }else{
    	while($row=$resultado->fetch_assoc()){
    			echo $row['NAME'].'<BR>';
    	}
    }
}

?>