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
	header('Location: index.php');
} elseif (isset($_POST['provincia'])) {
	$_SESSION['provincia'] = $_POST['provincia'];
} elseif (!isset($_SESSION['provincia'])) {
	header('Location: index2.php');
}

cabecera(3);
formulario();
busqueda();

function formulario() {
	global $dormitorios;
	global $precios;

	echo '<form action="index4.php" method="post">
			<p><span class="paso">Paso 3: Elija las características básicas de la vivienda.</span></p>
			<fieldset>
				<table>
					<tr>
						<th>Número de dormitorios:</th>
						<td colspan="2">';

		foreach ($dormitorios as $key => $value) {
			echo '<input type="radio" name="dormitorios" value="' . $key . '">&#8239;' . $value . "\t";
		}
		
		echo '			</td>
					</tr>
					<tr>
						<th>Precio mínimo:</th>
						<td width="100px">
							<span id="min">50000</span> €
						</td>
						<td>
							<input type="range" id="rangemin" name="preciomin" value="50000" min="50000" max="1000000" step="10000" oninput="mostrar(\'min\')">
						</td>
					</tr>
					<tr>
						<th>Precio máximo:</th>
						<td width="100px">
							<span id="max">1000000</span> €
						</td>
						<td>
							<input type="range" id="rangemax" name="preciomax" value="1000000" min="50000" max="1000000" step="50000" oninput="mostrar(\'max\')">
						</td>
					</tr>
					<tr>
						<td class="buttons" colspan="3">
							<input type="submit" name="back" value="&lt; Atrás" />
							<input type="submit" name="submit" value="Siguiente &gt;" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>';

	echo '<script>
			function mostrar(id) {
				console.log(parseInt(document.getElementById("rangemin").value));
				debugger
				if (id === "min") {
					var value = parseInt(document.getElementById("rangemin").value);
					document.getElementById("min").innerHTML = value;
					cambiarsalto("rangemin");
					if (parseInt(document.getElementById("rangemax").value) < value) {
						document.getElementById("rangemax").value = value;
						document.getElementById("max").innerHTML = value;
						cambiarsalto("rangemax");
					}
				} else if (id === "max") {
					value = parseInt(document.getElementById("rangemax").value);
					document.getElementById("max").innerHTML = value;
					cambiarsalto("rangemax");
					if (parseInt(document.getElementById("rangemin").value) > value) {
						document.getElementById("rangemin").value = value;
						document.getElementById("min").innerHTML = value;
						cambiarsalto("rangemin");
					}
				}
			}

			function cambiarsalto(id) {
				var salto;
				var value = parseInt(document.getElementById(id).value);
				switch (true) {
					case (value < 100000):
						salto = 10000;
						break;
					case (value >= 100000 && value < 300000):
						salto = 25000;
						break;
					case (value >= 300000):
						salto = 50000;
						break;
				}
				document.getElementById(id).step = salto;
			}
		</script>';
}

function busqueda() {
	global $tipos, $provincias;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $provincias[$_SESSION['provincia']] . '</span>';
}
?>

</hody>
</html>
