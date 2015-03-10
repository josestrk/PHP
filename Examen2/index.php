<html>
    <head>
        <meta http-equiv="Content-Type" content="charset=utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    <?php
    include("carrito.php");
    include("producto.php");
    include("checkcarrito.php");
    if(isset($_GET['destroy']))
        destroy();
    if( !check() )
        $_SESSION['carrito']= new Carrito(1,[]);
    $ca=$_SESSION['carrito'];
    if(isset($_POST['qty']))
        include("actualizar.php");

    if( isset($_GET['index1']) ){
        echo '<div style="display:block;text-align:left"><a href="' . $_SERVER['PHP_SELF'] . '" class="btn" >&lt;&lt Volver</a></div>';
        include ('index1.php'); 
    }elseif( isset($_GET['index2']) ){
        include ('principal.php'); 
        if(isset($_GET['detail'])){
            echo '<div style="display:block;text-align:left;float:left;"><a href="' . $_SERVER['PHP_SELF'] . '?index2=2" class="btn" >&lt;&lt Volver a catátlogo</a></div><div style="display:block;text-align:right"><a href="' . $_SERVER['PHP_SELF'] . '?index2=2&view_cart=1" class="btn" > Cart </a></div>';
            include ('detalle.php'); 
        }elseif(isset($_GET['view_cart'])){
            echo '<div style="display:block;text-align:left"><a href="' . $_SERVER['PHP_SELF'] . '?index2=2" class="btn" >&lt;&lt Volver a catátlogo</a></div>';
            include ('view_cart.php');
        }else{
            echo '<div style="display:block;text-align:left;float: left;"><a href="' . $_SERVER['PHP_SELF'] . '" class="btn" >&lt;&lt Volver</a></div><div style="display:block;text-align:right"><a href="' . $_SERVER['PHP_SELF'] . '?index2=2&view_cart=1" class="btn" > Cart </a></div>';
            mostrar($mysqli);
        }
    }else{
        echo '<div class="div"><a href="index.php?index1=1"><button class="root">Ejercicio 1</button></a></div>';
        echo '<div class="div"><a href="index.php?index2=2"><button class="root">Ejercicio 2</button></a></div>';
        echo '<div class="div"><a href="index.php?destroy=1"><button class="root">Borrar sessones</button></a></div>';
    }
    ?>
    </body>
</html>