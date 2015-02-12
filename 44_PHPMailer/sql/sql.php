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
	echo "<option style='background-color:#00CCFF; color: whitesmoke;' class='quest'  name='0'  value='0'>...</option>";
	while( $row = $info->fetch_assoc() ){
		echo "<option style='background-color: #00CCFF;' class='quest'  name=' $name '  value=" . $row['ID'] . ">" . $row['NAME'] . "</option>";
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
            $mm = "<div class='simform-inner'><table><tr><th>Nombre</th><th>Imagen</th><th>Email</th></tr>";
            do{
             $mm .= "<tr><td>" . $row['NAME'] . "</td><td><img src='" . $row['IMAGEN'] . "' width='300px'></td><td>";
             $mm .= "<p onclick=\"callmail('";
                $mm.= $row['NAME'] . "','" . $row['IMAGEN']; 
             $mm .= "')\">Contactar</p>";
             $mm .= "<div id='mail' style='display:none'>" . pintamail($row['NAME'] , $row['IMAGEN']) . "</div>";
             $mm .= "</td></tr>";
            }while( $row = $resultado->fetch_assoc() );
            $mm .= "</table></div>";
        }
        echo $mm;
    }
}

function pintamail($name,$img){
    $inmodata = "c/ Navalcon 16, Collado Villalba 28030";
    $envio = "</form>
    <form style='font-size: 25px;' action='sender.php' class='formLS' method = 'POST'>
    <input name='inmobiliaria' type='hidden' value=" . $inmodata . "/>
    <input name='casa' type='hidden' value=" . $name . "/>
    <input name='img' type='hidden' value=" . $img . "/>
    <div><h3 style='margin: 0px;'>Nombre </h3><input name='name' type='text' style='float: right;margin:auto;' required /></div>
    <div><h3 style='margin: 0px;'>Email </h3><input name='email' type='mail' style='float: right; margin:auto;' required /></div>
    <div><h3 style='margin: 0px;'>Telefono </h3><input name='phone' type='number' style='float: right; margin:auto;' required /></div>
    <h3>Mensaje</h3><textarea name='ms' style='margin: 2px; width: 200px; height: 200px;resize:none; max-width:200px; min-width:200px;'></textarea>
    <button>Enviar Email</button>
    </form>";
    return $envio;
}


?>