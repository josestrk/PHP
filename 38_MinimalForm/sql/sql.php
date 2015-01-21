<?php
function select(&$mysqli, $table, $tp, $name){
    //sql
    $sql='SELECT * FROM '.$table;
    if(!$resultado = $mysqli->query($sql)){
        throw new Exception ('No se accedio a datos');
    }else{
	    //view mode
	    switch($tp){
	    	case 'select': viewSelect($resultado, $name);break;
	    	case 'radio': viewradio($resultado, $name);break;
	    	case 'checkbox': viewCheckbox($resultado, $name);break;
	    	default: viewInput($resultado, $name);
	    }
	}
}

function viewSelect($info, $name){
	echo "<option style='background-color: rgb(40, 182, 123); color: whitesmoke;' class='quest'  name='0'  value='0'>...</option>";
	while($row=$info->fetch_assoc()){
		echo "<option style='background-color: rgb(40, 182, 123);' class='quest'  name='$name'  value=".$row['ID'].">".$row['NAME']."</option>";
    }
}

function viewradio($info, $name){
	while($row=$info->fetch_assoc()){
		echo "<li><input class='rad'  name='$name' type='radio' value=".$row['ID']." onclick='this.form.submit()'>".$row['NAME']."</li>";
    }
}

function viewCheckbox($info, $name){
	while($row=$info->fetch_assoc()){
		echo "<li><input class='check'  name='".$name."[]' type='checkbox' name='option1' value=".$row['ID'].">".$row['NAME']."</li>";
    }
}

function viewInput($info, $name){
	while($row=$info->fetch_assoc()){
		echo "<li><input class='quest' name='$name' id='".$row['ID']."' autofocus></li>";
    }
}

function saveValues($mysqli,$name,$id_tipo,$id_zona,$id_dorm,$id_precio,$id_extra){
    $sql="INSERT INTO casa
    (NAME,id_tipo,id_zona,id_dorm,id_precio,id_extra) 
    VALUES ('".$name."',".$id_tipo.",".$id_zona.",".$id_dorm.",".$id_precio.",'".$id_extra."');"; 
    $mysqli->query("SET NAMES 'utf8'");
    if (!$resultado = $mysqli->query($sql))
        echo'<div class="alertFAIL">Error al Insertar datos</div>';
    else
        echo "Añadida exitosamente";
}

function mostrarBusqueda($mysqli,$filter){
    $sql='SELECT * FROM casa WHERE id_tipo='.$filter[0].' AND id_zona='.$filter[1].' AND id_dorm='.$filter[2].' AND id_precio='.$filter[3];
    $sql.= (isset($filter[4])) ? ' AND id_extra like \''.$filter[4].'%\'' : " ";

    if(!$resultado = $mysqli->query($sql)){
        throw new Exception ('No se accedio a datos');
    }else{
        if(empty($row)){
            echo "<div class='questions'>No hay casas disponibles para este filtro<br><a href='".$_SERVER['PHP_SELF']."?delete' class='notifi' >Refescar filtros</a></div>";
        }else{
            while($row=$resultado->fetch_assoc()){
             echo "<div class='questions'>".$row['NAME']."</div>";
            }
        }
    }
}
?>