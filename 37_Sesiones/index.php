<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
    <?php
/*
Cree un script llamado acreditacion.php con el siguiente contenido.
En este script empezamos la sesión
*/
session_start();
function delete(){
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
}
if(isset($_GET['delete'])){
    delete();
}else{
    if(isset($_POST['name']) && isset($_POST['pass'])){
        if($_POST['name']=='alumno' && $_POST['pass']=='123456'){
            if(isset($_SESSION['id']))
                delete();
            $_SESSION['id']=$_POST;
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
if(isset($_SESSION['id'])){
    echo '<div class="notifi">Gracias por Iniciar sesion</div>';
    echo '<META http-equiv="refresh" content="0.5;URL=informacion.php">';
}else{
    echo '<div class="formLS">
<h2>Log In</h2>
	<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
	    <h3>Username: <input type="text" name="name" style="margin:auto;"/></h3>
	    <h3>Password: <input type="password" name="pass" style="margin:auto;"/></h3>
	    <input type="submit" value="Enviar" class="sb" style="width:300px"/>
	</form>
	</div>';

}
if(isset($sw)){
    echo '<div class="alert">Error, Usuario inexistente</div>';
}

    ?>
</body>
</html>