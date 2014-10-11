<h3> Ejercicio 13 </h3>

<?php
/*13- Crear una función que nos cree una tabla. El prototipo de la función debe ser como el que aparece a continuación
crear_tabla(4, 6,'width: 60px;','height: 40px;','background: pink;','border: 3px dashed blue;');
Los parámetros en rojo son obligatorios y los demás no lo son, por tanto, cuando no los pasan tomara el alto y ancho de 70 el color azul y el borde negro.
*/
function crear_tabla($col, $row){
    $args= func_get_args();
    $style=array('width:70px;','height:70px;','background:#0af;','border:3px dashed black;');
    $define_st=array();

    unset($args[0]);//elimino el 1º parámetro
    unset($args[1]);//elimino el 2º parámetro

    foreach($args as $arg){
        $pr =  explode ( ":" , $arg); //saco el tipo del estilo parametrizado
        $sw = true; 
        for($i= 0; $i < sizeof($style); $i++){
            $stcut =  explode ( ":" , $style[$i]); //saco el literal de por defecto 
            if ($pr[0] == $stcut[0]){
                $style[$i] = $arg; // si existe lo modifico
                $sw = !$sw;
            }
        }
        if($sw){
            $style[]= $arg; // no existe tipo de estilo lo añado
        }
    }
    
    echo "<table border=1; cellspacing=0;><tbody>";
    for($i= 0; $i < $row; $i++)
    {
        echo "<tr ".$dar_style.">";
        for($j= 0; $j < $col; $j++)
        {
            echo "<td style='";
            foreach ($style as $st) 
                echo $st; // muestro todos los estilos mandados por parámetro y los default
            echo "'></td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
}

crear_tabla(4, 6,'width: 60px;','height: 40px;','background: pink;','border: 4px groove blue;');
crear_tabla(4, 6,'height:50px;','border-radius:15px;');
crear_tabla(4, 6,'width: 20px;','height: 20px;','background: #A7a;','border: 3px inset #d50;');
crear_tabla(6, 4,'border: 3px inset #05d;','border: 2px solid #05d;');

echo "<br>---Fin ej13---<br>"
?>