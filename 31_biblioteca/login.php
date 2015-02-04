<!DOCTYPE HTML PUBLIC "-//W3C/DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
    <title>iLibreria</title>
	<link href="estilo.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
    <div class="login">
        <ul class="login">
        <form action='comp_login.php' method='POST'>
        <li>Usuario: <input name="nombre" type="text" size="13px"></li>
        <li>Contrase&ntilde;a: <input name="pass" type="password" size="13px"></li>
        <li><input type='submit' value='Entrar' class="submit"></li>
        </form>
        </ul>
	</div>
     <form action='login.php' class="newuser" method="post">
		    <input type="hidden" name="Nus" value="">
            <input type='submit' value='Nuevo usuario' class="submit">
     </form>
    <div class="cuerpo">
        <hr>
        <H1>iLibreria</H1>
        <?php
		if(isset($_POST['Nus'])){
			echo "
			<div class='crear'>
			<form action='createuser.php' method='POST'>
			<p>
			Nombre Usuario: <input name='login' type='text' size='13px'><br>
        	Contrase&ntilde;a: <input name='pass1' type='password' size='13px'><br>
			Comprobacion: <input name='pass2' type='password' size='13px'><br>
			</p>
			<input type='submit' value='Crear' class='submit'>
			</font></div>";
		}
		?>
	</div>
    <div class="pie">
    	<hr>
        <p>Libreria Jos&eacute; Trincado<br>&hearts;&spades;&clubs;&diams;</p>
    </div>
    </body>
</html>