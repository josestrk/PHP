<?php
    require_once('../44_PHPMailer/PHPMailer-master/class.phpmailer.php');
	require_once('../44_PHPMailer/PHPMailer-master/PHPMailerAutoload.php');
	$mail = new PHPMailer();
	//indico a la clase que use SMTP
	$mail->IsSMTP();
	//permite modo debug para ver mensajes de las cosas que van ocurriendo
	$mail->SMTPDebug = 2;
	//Debo de hacer autenticación SMTP
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	//indico el servidor de Gmail para SMTP
	$mail->Host = "smtp.gmail.com";
	//indico el puerto que usa Gmail
	$mail->Port = 465;
	//indico un usuario / clave de un usuario de gmail
	$mail->Username = "jose@makeonweb.com";
	$mail->Password = "123456shot";
	$mail->SetFrom('info@makeonweb.com', 'Soporte MakeOnWeb');
	$mail->Subject = "Envio de email usando SMTP de Gmail";
	$mail->MsgHTML('<h1>ASDA</h1>
					<p>alwdvaliuvdw</p>');
	//indico destinatario
	$email = "josenass22@gmail.com";
	$mail->AddAddress($email, 'MOW');
	if(!$mail->Send()) {
		echo "Error al enviar: " . $mail->ErrorInfo;
	} else {
		echo "Mensaje enviado!";
	} 
?>