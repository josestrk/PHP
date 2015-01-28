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
	header('Location: index3.php');
} else {
	foreach ($extras as $extra) {
		if (isset($_POST[$extra])) {
			$_SESSION['extras'][$extra] = $_POST[$extra];
		} else {
			unset($_SESSION['extras']);
			header('Location: index4.php');
		}
	}
}

cabecera(5);
busqueda();
var_dump($_SESSION);

function busqueda() {
	global $tipos, $provincias;
	echo '<span class="busqueda">Buscando ' . $tipos[$_SESSION['tipo']] . ' en ' . $provincias[$_SESSION['provincia']] . '</span>';
}
?>

</hody>
</html>
