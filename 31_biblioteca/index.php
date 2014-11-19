<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Librer&iacute;a</title>
	<style type="text/css">
        @import url("estilo.css");
    </style>
	<?php

	if (isset($_SESSION['log']))
	{
		$log=$_SESSION['log'];
			if ($_SESSION['tipo']== "administrador")$admin=true;
			else $admin=false;
	}else $log="ERROR no existe usuario";
    if (isset($_GET['bloc']))$sell=$_GET['bloc'];
    else $sell="";
	require('conexionmysql.php');
	require('funcion.php');
    ?>
    <SCRIPT LANGUAGE="JavaScript">
		<!-- Begin Script para popUp de ventana
		function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400px,height=400px,left = 762,top = 334');");
		}
		// End -->
	</script>
</head>
<body>
<?php

if (!isset($_SESSION['log'])){
	echo '<SCRIPT LANGUAGE="JavaScript">
		alert("ERROR el usuario no existe registrese");
		</script>';
	echo '<meta http-equiv="refresh" content="0;URL=login.php">';
}
?>
	<div class="login">
        <?php

        echo "BIENVENIDO $log ";
        ?>
        <br />
        <a href="limpiasesion.php" class="desconectar">Desconectar</a>
    </div>
    <H1 align="left">iLibreria</H1>
    <div class="cuerpo">
        <hr>
        <div class="cabeza">
            <ul class="cabeza">
            <li>Buscar libros por titulo o autor ('*' para listado completo)</li>
            <form action="index.php" method="get">
            <li><INPUT TYPE="text" SIZE="20" VALUE="<?php
 echo $sell; ?>" NAME="bloc"><input type="submit" value="Buscar" name=orden		 /> </li>
            </form>
            <?php
 
			if($admin){
            echo '<form action="index.php" method="get">
            <li><input type="submit" src="" value="Alta de ejemplar" name=altej /></li>
            </form>';
			}
			?>
            </ul>
        	<hr>
        </div>
    <?php

		if($admin){ // Solo siendo administrador se puede acceder a estas opciones sino se imposibilita el uso de las mismas	
			//DAR DE alta
			if (isset($_GET['altej']))
			{
				altaLibro();
			}
			if (isset($_POST['ralta']))
			{
				listadoAltas($_POST['ralta'],$_POST['t'],$_POST['a'],$_POST['n']);
			}
			//modificacion final MODIFICAR BD
			if (isset($_GET['modificar']))
			{
						modifiLibro($_GET["id"], $_GET["t"], $_GET["a"], $_GET["n"]);
			}
			//cofirmar borrado y borrar de la BD (+ la foto)
			if (isset($_GET['idM']))
			{
						delLibro($_GET['idM']);
			}
			//modificacion de FOTO en BD
			if (isset($_POST['idFoto']))
			{
						upphoto($_POST['idFoto'],$sell);
			}
		}
        // listar mas cerrar conexion
        if (isset($sell) and $sell<>"")//si no exisiste sell o esta vacio no lista
        {	
         $sell=$_GET['bloc'];// sell recibe el valor del bloque de texto para funcionar con el
                if(isset($_GET['idEdit']))//lista modificando el campo que se quiere editar
                {
                    listar($sell,$_GET['orden'],$_GET['idEdit']);
                }
                elseif(isset($_GET['idDel'])){//lista modificando el campo que se quiere borrar
                    listar($sell,$_GET['orden'],$_GET['idDel']);
                }
				elseif(isset($_GET['modF'])){//lista modificando el campo que se quiere modificar foto o ponerle una foto nueva
                    listar($sell,$_GET['orden'],$_GET['modF']);
                }
                else{// si no exisiste valor de modificación solo lista los valores que incluyan sell en titulo o autor
                    listar($sell,$_GET['orden'],0);
                }
        }		
    ?>
    </div>
    <div class="pie">
    	<hr>
        <p>Libreria Jos&eacute; Trincado<br>&hearts;&spades;&clubs;&diams;</p>
    </div>
</body>
</html>
