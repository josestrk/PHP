<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*
WEB DE CINE
De todas las películas que tenemos en nuestro cine, en la página inicial debemos presentar 3 que cambian aleatoriamente cada vez que nos conectamos al cine , de las 12 que tienen en el cine .Utilizar array _rand para trabajar aleatoriamente.
*/
require_once('style.css');
require_once("h1_21'Clases,constructor'.php");
$c=new Cabecera('CINE',"yellow","blue");
?>
</head>
<body>
<?php
$c->dibujar();
?>
</body>
</html>