<?php
	session_start();	
	if (!isset($_SESSION['identificativo'])){
		die();
	}else{	
		echo '<form action="procesar_transferencia.php" method="POST">';
		echo '<label for="id_cantidad">Cantidad:</label>';
		echo '<input type="text" id="id_cantidad" name="cantidad"/>';
		echo '<br />';
		echo '<label for="id_destino">Destino:</label>';
		echo '<input type="text" id="id_destino" name="destino"/>';
		echo '<br />';
		echo '<input type="submit" value="Enviar"/>';
		echo '</form>';
	}
?>
