<html>
<head>
	<meta http-equiv='Content-type' content='text/html; charset=utf-8'/>
	<link rel='stylesheet' type='text/css' href='estilo.css'>
</head>
<body>

<?php
session_start();
include 'cabecera.php';
include 'opciones.php';

if (isset($_POST['back'])) {
	header('Location: index2.php');
} elseif (isset($_POST['dormitorios']) && isset($_POST['preciomin']) && isset($_POST['preciomax'])) {
	$_SESSION['dormitorios'] = $_POST['dormitorios'];
	$_SESSION['preciomin'] = $_POST['preciomin'];
	$_SESSION['preciomax'] = $_POST['preciomax'];
} elseif (!isset($_SESSION['dormitorios']) || !isset($_SESSION['preciomin']) || !isset($_SESSION['preciomax'])) {
	header('Location: index3.php');
}

cabecera(4);
formulario();
busqueda();
var_dump($_SESSION);

function formulario() {
	global $extras;

	echo '<form action="index5.php" method="post">
			<p><span class="paso">Paso 4: Elija las características extra de la vivienda.</span></p>
			<fieldset>
				<table>';

	foreach ($extras as $extra) {
		echo '<tr>';
		echo '<th>' . $extra . ':</th>';
		echo '<td>
				<input type="radio" name="' . $extra . '" value="1">Sí
				<input type="radio" name="' . $extra . '" value="0">No
				<input type="radio" name="' . $extra . '" value="2" checked>Indiferente
			</td>';
		echo '</tr>';
	}


	echo '			<tr>
						<td class="buttons" colspan="2">
							<input type="submit" name="back" value="&lt; Atrás" />
							<input type="submit" name="submit" value="Siguiente >" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>';
}

function busqueda() {
	global $tipos, $provincias;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $provincias[$_SESSION['provincia']] . '</span>';
}
?>

</hody>
</html>
