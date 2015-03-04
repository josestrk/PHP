<html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
	function login(){
		echo '<form action="' . $_SERVER['PHP_SELF'] . '?it=admin" class="formLS" method="POST">
		<h3>Administrar</h3>
		<ul class="login">
        <li><span>Usr:</span><input name="user_47" type="text" size="13px" value="' . isset($_POST['user_47']) . '" require></li>
        <li><span>Pass:</span><input name="pass_47" type="password" size="13px" require></li>
        <li><input type="submit" value="Log-in" class="sb"></li>
        </ul>
		</form>';
	}

	if( isset($_GET['it']) ){
		if( $_GET['it'] == 'susciption' ){
			include ('suscripcion.php'); 
		}elseif ( $_GET['it'] == 'admin' ){
			session_start();
			require ('validar.php');
			if( (isset($_POST['user_47']) && isset($_POST['pass_47']) && validate($_POST['user_47'], $_POST['pass_47'])) || isset($_SESSION['log'])){
				include("admin.php");
			}else{
				echo '<div class="alert">Error, password o usuario incorrectos</div>';
				login();
			}
		}
	}else{
		echo '<div class="div"><a href="index.php?it=susciption"><button class="root">Susciption</button></a></div>';
		login();
	}
	?>
</body>
</html>