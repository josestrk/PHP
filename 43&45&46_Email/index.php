<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
</head>
<body style="background: url('../img/tx.jpg');background-repeat: repeat; ">
<?php
include_once("style/style.css");
require_once("cabecera.php");

$c=new Cabecera( 'Mail sender',"grey","#fff" );

function sendmail(){
	$mensaje = "De:".$_POST['name']." \n email:".$_POST['email']
        ."\nEmpresa:".$_POST['enterprise']." \n 	Telefono:".$_POST['phone']
        ."\nMensaje:".$_POST['ms']."\n";
	
	$cabeceras = 'From:' . $_POST['email'] . "\r\n" .
    'Reply-To:' . $_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	$result = mail($_POST['to'],'Mail to DAW class',$mensaje, $cabeceras ); 
	return $result;
}
?>

<?php $c->dibujar(); ?> 

<form class="formLS" action=<?php echo $_SERVER['PHP_SELF']; ?> method = 'POST'>
    <div><h3>Para </h3></div><div><input type="" name="to" style="margin:auto;" value="jose@makeonweb.com" readonly></div>
    <div><h3>Nombre </h3></div><div><input name="name" type="text" style="margin:auto;" required /></div>
    <div><h3>Empresa </h3></div><div><input name="enterprise" type="text" style="margin:auto;" required /></div>
    <div><h3>Email </h3></div><div><input name="email" type="mail" style="margin:auto;" required /></div>
    <div><h3>Telefono </h3></div><div><input name="phone" type="number" style="margin:auto;" required /></div>
    <h3>Mensaje</h3><textarea name="ms" style="margin: 2px; width: 450px; height: 200px;resice:none; max-width:490px; min-width:490px;"></textarea>
    <div><input type='submit' value='Enviar' class='sb' style="width:300px" required /></div>
</form>

<div style="float:none;"></div>
<?php
if(isset($_POST['email'])){
	$sent=sendmail();
	if($sent)
		echo '<div align="center" class="notifi">MAIL HAS BEEN SENT</div>';
	else
		echo '<div align="center" class="alert">ERROR TO SEND</div>';
}else{
    echo '<div align="center" class="alert">Debe insertar un email para enviar</div>';
}
?>

</body>
</html>