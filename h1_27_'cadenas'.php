<?php

//inserta tamaño añadiendo a la url el get ej: ?tam=20

$l= isset($_GET['tam']) ? $_GET['tam'] : 5;
echo '<center>';
//árbol
for($i=1;$i<=$l;$i++){
    for($j=1;$j<=$i;$j++){
            echo "*";
    }
    echo "<br>";
}
//tallo
for($i=0;$i<2;$i++){
    echo "**<br>";
}
    
echo '</center>';

?>
