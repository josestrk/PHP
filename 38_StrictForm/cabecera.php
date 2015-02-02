<?php
function cabecera($pagina) {
	$paginas = array(1 => 'Tipo', 2 => 'Provincia', 3 => 'Características', 4 => 'Extras', 5 => 'Enviar');
	echo '<h1>Búsqueda de vivienda</h1>';
	$indice = array();
	foreach ($paginas as $key => $value) {
		$str = $key . '. ' . $value;
		if ($key == $pagina) {
			$indice[$key] = '<b>' . $str . '</b>';
		} else {
			$indice[$key] = '<span class="gris">' . $str . '</span>';
		}
	}
	echo '<p>' . implode('<span class="azul"> &gt; </span>', $indice) . '</p>';
}
?>