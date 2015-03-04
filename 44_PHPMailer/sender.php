<?php
require_once( 'PHPMailer/class.phpmailer.php');
require_once( 'PHPMailer/PHPMailerAutoload.php');
function sendmail(){
	
  $mail = new phpmailer();
  $mail->PluginDir = "includes/";
  $mail->Mailer = "smtp";
//<<<<<<< HEAD
//
//  //Asignamos a Host el nombre de nuestro servidor smtp
//  $mail->Host = "smtp.makeonweb.com";
//=======
//  $mail->Host = "smtp.hotpop.com";
//>>>>>>> origin/master

  $mail->SMTPAuth = true;
  $mail->Username = "jose@makeonweb.com"; 
  $mail->Password = "º1234567890";

  $mail->From = "info@makeonweb.com";
  $mail->FromName = "Soporte de MakeOnWeb";
    
  $mail->Timeout=30;
  $mail->AddAddress($_POST['email']);
  $mail->Subject = "Contacto web inmobiliaria";
  $mail->Body = $_POST['ms'];
  $mail->AltBody = $_POST['ms'];
  $mail->AddAttachment($_POST['img']);
  $exito = $mail->Send();
  $intentos=1; 
  while ((!$exito) && ($intentos < 5)) {
	sleep(5);
     	//echo $mail->ErrorInfo;
     	$exito = $mail->Send();
     	$intentos=$intentos+1;	
	
   }
 
		
   if(!$exito)
   {
	echo "Problemas enviando correo electrónico a ".$valor;
	echo "<br/>".$mail->ErrorInfo;	
   }
   else
   {
	echo "Mensaje enviado correctamente";
   } 
}

if(isset($_POST['email'])) sendmail();
?>