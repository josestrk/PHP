<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style/style_old.css");
?>
</head>
<body>
<?php
/*
Cree en calendario_funciones.php una función llamada formulario_evento() que reciba como argumentos opcionales el año, el mes, el día, la hora,
el minuto, un campo id, el título, y el comentario (por este orden), y que en caso de ausencia de alguno de ellos (excepto el id) incluya en el
 formulario un campo solicitándolo (si no se han omitido, deberán mostrarse en los campos del formulario). La función deberá comprobar que los 
 argumentos recibidos constituyen una fecha válida (ckeckdate si la fecha está completa, y si está incompleta el año deberá estar comprendido entre 
 2000 y 2037, y el mes entre 1 y 12), que la hora es válida (hora entre 0 y 23, y minuto entre 0 y 55 a múltiplos de 5), y que los otros dos argumentos son de tipo
  string y el id de tipo numérico (no NULL). El formulario deberá contener además un campo oculto cuyo valor sea el id, y un botón submit para confirmar. 
  El action del formulario debe ser procesar.php?operacion=confirmar y el método POST. El archivo procesar.php lo crearemos en un tema posterior.
*/
//CONSTANTES TOTALES
define ('DIA',31);
define ('ANNO',2037);
define ('HORA',23);
define ('MIN',55);

function formulario_evento(){
	$mms="Fecha correcta";
	$tip="alert";
	if($_POST['dia'] && $_POST['mes'] && $_POST['anno'])
		if (!boolval(checkdate ( $_POST['mes'] , $_POST['dia'] , $_POST['anno'] )))
			$mms="Error fecha invalida";
		else
			$tip="alertOK";
	else
		$mms="No ha introducido bien la fecha y/o hora";
	return "<div class='$tip'>$mms</div>";
}

function formularioText_evento(){
	$mms="<div class='formLS'><h2>Registro</h2>";

	if (!isset($_POST['titulo']))
		$mms.="No ha introducido Titulo";
	elseif(!isset($_POST['coment']))
		$mms.="No ha introducido Comentario";
	else
		$mms.="<br>".$_POST['id']."||\t\t".$_POST['dia']."/".$_POST['mes']."/".$_POST['anno']."\t\t".$_POST['hora'].":".$_POST['min']."\t\t\t<h4>".$_POST['titulo']."</h4>\t".$_POST['coment'];
	$mms.="</div>";

	return $mms;
}


//you can sent Max or Array,[min,interval]
function rellena_formulario(){
	$arguments= func_get_args();
	if( !empty($arguments[0]) && is_numeric($arguments[0]) ){
		$max=$arguments[0];
		$initial= isset($arguments[2]) ? $arguments[2] : 1;
		$default=isset($arguments[1]) ? $arguments[1] : $initial;
		$interval= !empty($arguments[3]) ? $arguments[3] : 1;
		
		for( $i=$initial; $i<= $max; $i= $interval+$i ){
			if($i==$default)
				echo '<option value="'.$i.'" selected>'.$i.'</option>';
			else
				echo '<option value="'.$i.'">'.$i.'</option>';
		}
	}else{
		$default=isset($arguments[1]) ? $arguments[1] : 1;
		foreach($arguments[0] as $key => $value){
			if($key==$default)
				echo '<option value="'.$key.'" selected>'.$value.'</option>';
			else
				echo '<option value="'.$key.'"">'.$value.'</option>';
		}
	}
}

?>

<div class="formLS">
	<?php
	if(isset($_GET['operacion']) && $_GET['operacion']=='confirmar')
		echo formulario_evento();
	?>
	
	<form action=<?php echo "$_SERVER[PHP_SELF]?operacion=confirmar" ?> method='post'>
	<blockquote>
		Día:<select name="dia"> <?php isset($_POST['dia']) ? rellena_formulario(DIA, $_POST['dia']) : rellena_formulario(DIA) ;  ?> </select>
		Mes:<select name="mes"> <?php isset($_POST['mes']) ? rellena_formulario(array(NULL, 'ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'), $_POST['mes']) : rellena_formulario(array(NULL, 'ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE')); ?> </select>
		Año:<select name="anno"> <?php isset($_POST['anno']) ? rellena_formulario(ANNO,$_POST['anno'], 2000) : rellena_formulario(ANNO,0,2000); ?> </select>
	</blockquote>
	<blockquote>
		<select name="hora"> <?php isset($_POST['hora']) ? rellena_formulario(HORA, $_POST['hora']) : rellena_formulario(HORA); ?> </select>
		:<select name="min"> <?php isset($_POST['min']) ? rellena_formulario(MIN,$_POST['min'],0,5) : rellena_formulario(MIN,0,0,5); ?> </select>
	</blockquote>
	<blockquote>
		Título:<br><input type="text" name="titulo" value = <?php echo isset($_POST['titulo']) ? $_POST['titulo'] : ' '; ?>><br>
		Comentario: <br>
		<textarea rows="4" cols="30" name="coment" style="margin: 2px; min-height: 183px; max-height: 383px;resice:none; max-width:450px; min-width:420px;"><?php echo isset($_POST['coment']) ? $_POST['coment'] : ''; ?></textarea>
		<br>
		<input type="hidden" value="100" name="id" />
		<input type="submit" value="confirmar" name="confirmar" class="sent" />
	</blockquote>
	</form>
</div>
<?php
	if(isset($_GET['operacion']) && $_GET['operacion']=='confirmar'){
		echo formularioText_evento();
	}
?>
</body>
</html>
