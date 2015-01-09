
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method='GET' enctype='multipart/form­data'>
	<br>Introduzca Numero de filas a mostrar<input type="text" name="numero" style="margin:auto;">
	<input type='submit' value='Enviar'/>
</form>

<?php
require_once('configuracion.php');

if (isset($_GET['numerodebajo'])) {
	$numerodebajo=$_GET['numerodebajo'];
}else{
	$numerodebajo=0;
}

if(isset($_GET['numero']) && is_numeric($_GET['numero'])==1){
	$sql="SELECT * FROM EMP limit ".$numerodebajo.",".$_GET['numero'];
	$resultado = $mysqli->query($sql);
	$numero=$_GET['numero'];
}else{
	$numero=10;
	$resultado = $mysqli->query("SELECT * FROM EMP limit 10");
}

echo '<table>';
echo '<tr><th>EMPNO</th><th>ENAME</th><th>JOB</th><th>MGR</th><th>HIREDATE</th><th>SAL</th><th>COMM</th><th>DEPTNO</th><th>VOTO</th></tr>';
while($fila=$resultado->fetch_assoc()){
	echo '<tr>';
	foreach ($fila as $key => $value) {
		echo '<td>'.$value.'</td>';
	}
	echo '</tr>';
}
echo '</table>';


$resultado = $mysqli->query("SELECT * FROM EMP");
$total=0;
while($fila=$resultado->fetch_assoc()){
	$total++;
}

echo '<br><br> Pagina: ';

$paginas=$total/$numero;

for ($i=0; $i < $paginas; $i++) { 	
	echo '<a href="listado.php?numero='.$numero.'&numerodebajo='.(($i)*$numero).'">'.($i+1).'</a>';
}

?>