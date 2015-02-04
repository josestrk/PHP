<?php
//selection input and load info to bbdd
function select( $mysqli, $table, $tp, $name ){
    $sql='SELECT * FROM ' . $table;
    if( !$resultado = $mysqli->query( $sql ) ){
        throw new Exception ('No se accedio a datos');
    }else{
	    switch( $tp ){
	    	case 'select': viewSelect($resultado, $name);break;
	    	case 'radio': viewradio($resultado, $name);break;
	    	case 'checkbox': viewCheckbox($resultado, $name);break;
            case 'file': viewImputFile($name);break;
	    	default: viewInput($name);
	    }
	}
}

function selectNoTable( $tp, $name ){
    switch( $tp ){
        case 'file': viewImputFile($name);break;
        default: viewInput($name);
    }
}

//select
function viewSelect( $info, $name ){
	echo "<option style='background-color: rgb(40, 182, 123); color: whitesmoke;' class='quest'  name='0'  value='0'>...</option>";
	while( $row = $info->fetch_assoc() ){
		echo "<option style='background-color: rgb(40, 182, 123);' class='quest'  name=' $name '  value=" . $row['ID'] . ">" . $row['NAME'] . "</option>";
    }
}

//radio
function viewradio( $info, $name  ){
	while( $row = $info->fetch_assoc() ){
		echo "<li><input class='rad'  name='$name' type='radio' value=" . $row['ID'] . " onclick='this.form.submit()'>" . $row['NAME'] . "</li>";
    }
}

//checkbox
function viewCheckbox( $info,$name ){
	while( $row = $info->fetch_assoc() ){
		echo "<li><input class='check'  name='" . $name . "[]' type='checkbox' name='option1' value=" . $row['ID'] . ">" . $row['NAME'] . "</li>";
    }
}

//input
function viewInput( $name ){
		echo "<li><input class='quest' name=' $name ' autofocus></li>";
}

//file
function viewImputFile( $name ){
    echo "<li><input type='file' class='quest' name='res' autofocus><input type='submit' value='>'></li>";
}

function saveValues( $mysqli, $name, $img, $id_tipo, $id_zona, $id_dorm, $id_precio, $id_extra ){
    $sql = "INSERT INTO casa
    (NAME,IMAGEN,id_tipo,id_zona,id_dorm,id_precio,id_extra) 
    VALUES ('" . $name . "','" . $img . "'," . $id_tipo . "," . $id_zona . "," . $id_dorm . "," . $id_precio . ",'" . $id_extra . "');"; 
    $mysqli->query("SET NAMES 'utf8'");
    if ( !$resultado = $mysqli->query( $sql ) )
        echo'<div class="alertFAIL">Error al Insertar datos</div>';
    else
        echo "Añadida exitosamente";
}

function viewSearch($mysqli,$filter){
    $sql = 'SELECT * FROM casa WHERE id_tipo=' . $filter[0] . ' AND id_zona=' . $filter[1] . ' AND id_dorm=' . $filter[2] . ' AND id_precio=' . $filter[3];
    
    $sql .= (isset($filter[4])) ? ' AND id_extra like \'' . $filter[4] . '%\'' : " ";

    if( !$resultado = $mysqli->query( $sql ) ){
        throw new Exception ('No se accedio a datos');
    }else{
        $row = $resultado->fetch_assoc();
        if( empty( $row ) ){
            $mm = "<div class='simform-inner'>No hay casas disponibles para este filtro<br><a href='" . $_SERVER['PHP_SELF'] . "?delete' class='notifi' >Refescar filtros</a></div>";
        }else{
            $mm = "<div class='simform-inner'><table><tr><th>Nombre</th><th>Imagen</th></tr>";
            do{
             $mm .= "<tr><td>" . $row['NAME'] . "</td><td><img src='" . $row['IMAGEN'] . "' width='300px'></td></tr>";
            }while( $row = $resultado->fetch_assoc() );
            $mm .= "</table></div>";
        }
        echo $mm;
    }
}
?>