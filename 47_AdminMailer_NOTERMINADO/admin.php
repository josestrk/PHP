<?php
if (!isset($_GET['delete']) ){
	$log = $_SESSION['log'];
	$admin = ( $_SESSION['tipo'] == "administrador" ) ? true : false;
}else{
	$_SESSION=array();
	unset($_SESSION);
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;URL=' . $_SERVER['PHP_SELF'] . '">';
}
?>
		<div class="container">

	<div class="header">
		<?php
		//Top Navigation
		echo '<div style="display:block;text-align: end;">';
		echo (isset($_SESSION)) ? '<span class="notifi">&#10004;<small>Session: ' . $log . ' </small>' : '<span class="alert">OFF';
		echo '</span>'
			. '<a href="' . $_SERVER['PHP_SELF'] . '?delete=delete" class="btn" >Log OUT</a></div>';

		// Content
		$date_t = date(" j / F / Y g:i a");
		?>
		<h2>Bienvenido al Panel de Administración<br><?php echo $date_t; ?></h2>
		<ul class="admin">
			<li><a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=create'; ?>><button class="root">crear</button></a></li><li>
			<a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=erase'; ?>><button class="root">eliminar</button></a></li><li>
			<a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=modifi'; ?>><button class="root">modificar</button></a></li><li>
			<a href=<?php echo $_SERVER['PHP_SELF'].'?it=admin&md=see'; ?>><button class="root">mostrar</button></a></li>
		</ul>
	</div>
	<?php
		if(isset($_GET['md'])){
			$md=$_GET['md'];
			if($md=='create' || $md=='erase' || $md=='modifi' || $md=='see')
				include("md/".$md.".php");
		}else{
			echo '<div class="div"><h4>Elije una opción</h4></div>';
		}
	?>