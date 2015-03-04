<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
    <?php
session_start();
include('../style/style.css');
if(isset($_GET['delete'])){
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
}else{
    if(isset($_POST['name']) && isset($_POST['pass'])){
        if($_POST['name']=='alumno' && $_POST['pass']=='123456'){
            $_SESSION['id']=$_POST;
        }else{
            $sw=false;
        }
    }
}

    ?>
</head>
<body>
    <?php
if(!isset($_SESSION['id'])){
    echo '<META http-equiv="refresh" content="0.1;URL=index.php">';
}else{
    echo '<div class="formLS">
		<h2>Logged</h2>
	    <a class="btn" href="'.$_SERVER['PHP_SELF'].'?delete">Log Out</a>
	    <a class="btn" href="'.$_SERVER['PHP_SELF'].'?search">Buscar</a>
	</div>';
}
if (isset($_GET['search'])) {
    echo '<iframe src="https://www.google.com/maps/embed?
	pb=!1m14!1m12!1m3!1d12139.304500928252!2d-3.8553606000000005!3d40.4791115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1421050932043"
	width="400" height="300" frameborder="0" style="border:0; margin-top: 10%; "></iframe>';
}
if(isset($sw)){
    echo '<div class="alert">Error, Usuario inexistente</div>';
}

    ?>
</body>
</html>