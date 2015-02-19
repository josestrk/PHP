<?php
if ( isset($_SESSION['log']) ){
	$log = $_SESSION['log'];
    $admin = ( $_SESSION['tipo'] == "administrador" ) ? true : false;
}else{
	echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">';
}
?>
<div class="container">
<?php
//Top Navigation
echo '<div style="display:block;text-align: end;">';
echo (isset($_SESSION)) ? '<span class="notifi">&#10004;<small>Session: ' . $log . ' </small>' : '<span class="alert">OFF';
echo '</span>'
. '<a href="' . $_SERVER['PHP_SELF'] . '?delete" class="btn" >Log OUT</a></div>';

// Content
$date_t = date("j/F/Y g:i a");
echo '
	<div class="header">
	<h3>Bienvenido al Panel de Administración 
	<br> <small>' . $date_t . '</small></h3>	
	<center>
	</center>
  	</div>';
?>
</div>