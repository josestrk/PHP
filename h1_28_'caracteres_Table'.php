<table border="1">
<?php
$i=0;
$max=0;
while($i<=238){
    
    if($i<17){
        echo '<tr><th>'.$i.'</th>';
        for($j=$i;$j<=$i+16;$j++){
            echo '<td>'.$j.'</td>';
        }
        echo '</tr>';
    }
    echo '<tr><th>'.$i.'</th>';
    for($j=$i;$j<=$i+16;$j++){
        echo '<td>'.chr($j).'</td>';
    }
    echo '</tr>';
    $i=$j;
}
?>
</table>