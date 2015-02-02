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

cabecera(1);
formulario();

function formulario() {
	global $tipos;

	echo '<form action="index2.php" method="post">
			<p><span class="paso">Paso 1: Elija el tipo de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<th>Tipo:</th>
						<td>
							<select name="tipo">';

		foreach ($tipos as $key => $value) {
			echo '<option value="' . $key . '">' . $value . '</option>';
		}
		
		echo '					</select>
						</td>
					</tr>
					<tr>
						<td class="buttons" colspan="2">
							<input type="submit" value="Siguiente >" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>';
}
?>

</hody>
</html>
