<?php

echo '
<form acction="'.$_SERVER['PHP_SELF'].'" method="GET" class="formLS">
<h2>Listado de empelados</h2><br>
<h3>Número de empleado por página:</h3>
<input name="empnum" type="number" max="100" value="'; 
echo isset($_GET['empnum']) ? $_GET['empnum'] : '10'; 
echo '"/>
<input type="hidden" value="list" name="mod"/>
<input type="hidden" value="0" name="min" />
<br><input type="submit" value="Enviar" class="sb" style="width:300px"/>
</form>';
if (isset($_GET['empnum'])){
	$min= (isset($_GET['min'])) ? $_GET['min'] : '0';
	echo "<table border='1' collspan='0' class='table' align='center'> 
	<tr><td>EMPNO</td><td>ENAME</td><td>JOB</td><td>MGR</td><td>HIREDATE</td><td>SAL</td><td>COMM</td><td>DEPTNO</td><td>VOTO</td></tr>";
	
	$sql = "SELECT * FROM EMP limit ".$min.",".$_GET['empnum'].";";
	$resultado = $mysqli -> query( $sql );
	
	while ($fila = $resultado->fetch_assoc()) {
    echo " <tr><td>".$fila['EMPNO']."</td><td>".$fila['ENAME']."</td><td>".$fila['JOB']."</td>
    <td>".$fila['MGR']."</td><td>".$fila['HIREDATE']."</td><td>".$fila['SAL']."</td>
    <td>".$fila['COMM']."</td><td>".$fila['DEPTNO']."</td><td>";
    echo ($fila['VOTO']==1) ? 'SI' : 'NO' ;
    echo "</td></tr>";
    }
    echo "</table>";
    $min=$min+$_GET['empnum'];
    $num_fila = $resultado -> num_rows;
    if($num_fila == $_GET['empnum'])echo '<a href="index.php?mod=list&min='.$min.'&empnum='.$_GET['empnum'].'"><button class="root" style="width:300px">siguiente →</button></a>';
}
?>