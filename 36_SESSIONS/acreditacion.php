<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
Cree un script llamado acreditacion.php con el siguiente contenido.
En este script empezamos la sesión
*/
if(isset($_GET['delete'])){
	session_start();
	$_SESSION=array();
	unset($_SESSION);
	session_destroy();
}else{
	if(isset($_POST['name']) && isset($_POST['pass'])){
		if($_POST['name']=='alumno' && $_POST['pass']=='123456'){
			session_start();
			$i=sizeof($_SESSION);
			$i++;
			$_SESSION['id_'.$i]=$_POST;
		}else{
			$sw=false;
		}
	}
}
include('../style/style.css');
?>
</head>
<body>
<?php
if(isset($_SESSION)){
	echo '<div class="notifi">Gracias por Iniciar sesion</div>';
	echo "<a class='btn' href=$_SERVER[PHP_SELF]?delete=3>Log Out</a>";
	echo '<div class="div"><h3>Sesiones: </h3><ol style="
    text-align: left;margin: auto;padding: 0px 40%;font-size: 18px;">';
	foreach($_SESSION as $n){
		echo '<li>'.$n['name'].'</li>';
	}
	echo '</ol></div>';
}
echo '<div class="formLS">
<h2>Log In</h2>
	<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
	    <h3>Username: <input type="text" name="name" style="margin:auto;"/></h3>
	    <h3>Password: <input type="password" name="pass" style="margin:auto;"/></h3>
	    <input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>
	</div>';
if(isset($sw)){
	echo '<div class="alert">Error, Usuario inexistente</div>';
}

?>
</body>
</html>