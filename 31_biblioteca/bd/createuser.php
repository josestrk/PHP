<?php
require('conexionmysql.php');
$login=$_POST['login'];
$pas1=$_POST['pass1'];
$pas2=$_POST['pass2'];
	// comprovacion de que la clave introducida 2 veces esta Ok
	if(strlen($login)<=3)
	{
		echo '<html> 
		<SCRIPT LANGUAGE="JavaScript">
		alert("Debes introducir un nombre con mas de 3 caracteres su nombre tiene: '.strlen($login).'");
		</script> 
		<body>
		<meta http-equiv="refresh" content="0;URL=../login.php">
		</body></html>';
	}
	else
	{
		// comprovacion de que la clave introducida 2 veces esta Ok
		if(strlen($pas1)>=4)
		{
			if($pas1!=$pas2)
			{
				echo '<html> 
				<SCRIPT LANGUAGE="JavaScript">
				alert("La contraseña no coincide con la comprobación");
				</script> 
				<body>
				<meta http-equiv="refresh" content="0;URL=../login.php">
				</body></html>';
			}
			else
			{
				//Sentencia para saber si existe usuario
				$query   = "SELECT * from USUARIOS WHERE  login = '".$login."'";
				$result  = $on->query($query) or die('Error, fallo de la consulta'.$query); 
					if(($num_total_registros = $result -> num_rows )!=0)// si hay alguno fallara
					{
						echo '<html>
						<SCRIPT LANGUAGE="JavaScript">
						alert("Usuario ya existe -'.$num_total_registros.'");
						</script>  
						<body>
						<meta http-equiv="refresh" content="0;URL=../login.php">
						</body></html>';
					}
					else
					{
						// NO DA ERROR Crear usuario
						$query   = 'insert into USUARIOS values("","'.$login.'",password("'.$pas1.'"),"usuario")';
						$result  = $on -> query($query) or die('Error, fallo en la creacion'.$query); 
						echo '<html>
						<SCRIPT LANGUAGE="JavaScript">
						alert("Usuario creado con exito");
						</script> 
						<body>
						<meta http-equiv="refresh" content="0;URL=../login.php">
						</body></html>';
					}
			}
		}
		else
		{
			echo '<html>
				<SCRIPT LANGUAGE="JavaScript">
				alert("La password o contraseña debe estar constituida pro almenos 4 caracteres");
				</script> 
				<body>
				<meta http-equiv="refresh" content="0;URL=login.php">
				</body></html>';
		}
	}

mysql_close();
?>