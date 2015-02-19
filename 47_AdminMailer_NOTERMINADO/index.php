<html>
<head>
<meta http-equiv="Content-Type" content="charset=utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
	function login(){
		echo '<div class="div"><h4>Administrar</h4>
		<ul class="login">
        <form action="' . $_SERVER['PHP_SELF'] . '?it=admin" method="POST">
        <li>Usuario: <input name="user_47" type="text" size="13px" value="' . isset($_POST['user_47']) . '" require></li>
        <li>Contrase&ntilde;a: <input name="pass_47" type="password" size="13px" require></li>
        <li><input type="submit" value="Log-in" class="root"></li>
        </form>
        </ul></div>';
	}

	if( isset($_GET['it']) ){
		if( $_GET['it'] == 'susciption' ){
			include ('suscripcion.php'); 
		}elseif ( $_GET['it'] == 'admin' ){
			require ('validar.php');
			if( isset($_POST['user_47']) && isset($_POST['pass_47']) && validate($_POST['user_47'], $_POST['pass_47']) ){
				include ('admin.php');
			}else{
				login();
				echo '<div class="alert">Error, password o usuario incorrectos</div>';
			}
		}
		echo '<div class="cartel"><a href="index.php"><button class="root" style="width:300px">Volver a Inicio</button></a></div>';
	}else{
		echo '<div class="div"><a href="index.php?it=susciption"><button class="root" style="width:300px">Susciption</button></a></div>';
		login();
	}
	?>
</body>
</html>