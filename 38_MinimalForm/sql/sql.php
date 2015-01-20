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
		echo "<li><input class='check'  name='checks[]' type='checkbox' name='option1'value=".$row['ID'].">".$row['NAME']."</li>";
    }
}

function viewInput($info, $name){
	while($row=$info->fetch_assoc()){
		echo "<li><input class='quest' name='$name' id='".$row['ID']."' autofocus></li>";
    }
}

function saveValues(&$mysqli,$name,$id_tipo,$id_zona,$id_dorm,$id_precio,$id_extra){
    $sql="INSERT INTO casa
    (NAME,id_tipo,id_zona,id_dorm,id_precio,id_extra) 
    VALUES ('".$name."',".$id_tipo.",".$id_zona.",".$id_dorm.",".$id_precio.",'".$id_extra."');"; 
    $mysqli->query("SET NAMES 'utf8'");
    if (!$resultado = $mysqli->query($sql))
        echo'<div class="alertFAIL">Error al Insertar datos</div>';
    else
        echo "Añadida exitosamente";
    mostrarBusqueda($mysqli,$id);
}

function mostrarBusqueda(&$msqli,$filter1){
    //hacer búsqueda parametrizada al sql
    
}
?>