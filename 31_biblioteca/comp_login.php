<?php
session_start(); 
if(!isset($_POST['nombre']) or !isset($_POST['pass'])) 
{
	$_SESSION['intenconex']=1;
	echo '<html> 
	<body>
	<meta http-equiv="refresh" content="0;URL=login.php">
	</body></html>';
}
else
{
	$nombre=$_POST['nombre'];//variables enviadas por post
	$pass=$_POST['pass'];
	
	require('conexionmysql.php');
	//Sentencia para obtener usuario
	$query   = "SELECT login,tipo from USUARIOS WHERE  login = '$nombre' and passwd = password('$pass')"; 
	$result  = $on -> query($query) or die('Error, fallo de la consulta'.$query); 
	
	if(($num_total_registros = $result->num_rows)!=1)// si hay mas de uno o 0 dara error en el sistema y pedira volver a logearse
	{
		$_SESSION['intenconex']=1;
		echo '<html> 
		<body>
		<SCRIPT LANGUAGE="JavaScript">
		alert("ERROR el usuario no existe registrese");
		</script>
		<meta http-equiv="refresh" content="0;URL=login.php">
		</body></html>';
	}
	// NO DA ERROR 
	$registro=$result->fetch_row(MYSQLI_NUM);
	
	$_SESSION['intenconex']=0;// para que el usuario al salir no le de el aviso de error
	$_SESSION['db_is_logged_in'] = true;// activa la sesion
	
	$_SESSION['log'] = $registro[0];// COGE EN SESION[`LOG`] EL VALOR DE REGISTRO EL LOGIN
	$_SESSION['tipo'] = $registro[1];// COGE EN SESION[`LOG`] EL VALOR DE REGISTRO EL LOGIN
	echo '<html> <head>
	<link href="estilo.css" rel="stylesheet" type="text/css" />
	</head>
	<body> 
		<div class="login">
		<p>Bienvenido '.$registro[0].'</p>
		</div>
		<div class="cuerpo">
		<h3>Bienvenido al Portal iLibreria</h3>	
		<center>
		<p><img src="load-in-progress.gif" /></p>
		</center>
	  	</div>
		<meta http-equiv="refresh" content="2;URL=index.php">
	</body>
	</html>';
}
?>
