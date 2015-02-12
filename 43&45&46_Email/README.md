43 - Formulario que permite enviar un mail

45 - Para mejorar el envío de correos enviamos html en nuestro propio correo.
Para ello tenemos los campos:

```php
$to,$from, $asunto,$cuerpo.

//Para poder añadir html, tenemos que aprender a enviar varias cabeceras con join.

//Tendremos que utilizar el siguiente código:

$Headers=array();
$headers[]=’Mime-version:1.0’;
$headers[]=’Content-type:text/html;charset=UTF-8’;
$headers[]=’Content-Transfer-Encoding:7bit’;
$headers[]=’from’.$from;

//Codigo html
$exito=mail($to,$aunto,$c uerpo , join(“\r\n”,$headers));
```

46 - 
Para enviar el mismo mail pero intercalando varias partes cambiamos lo siguiente: 

Debemos indicar al cliente de correo que los datos llegaran en varias partes .

Vamos a intercalar texto con html.

```php
ueid= uniqid('np');
 
//indicamos las cabeceras del correo
$headers = "MIME-Version: 1.0\r\n";
$headers .= "From: Foo \r\n";
$headers .= "Subject: Test mail\r\n";
//lo importante es indicarle que el Content-Type
//es multipart/alternative para indicarle que existirá
//un contenido alternativo
$headers .= "Content-Type: multipart/alternative;boundary=" . $uniqueid. "\r\n"

//Ahora metemos en cuerpo
 
$message = "";
 
$message .= "\r\n\r\n--" . $uniqueid. "\r\n";
$message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
$message .= "E-mail en Texto Plano sin formato.";
 
$message .= "\r\n\r\n--" . $uniqueid. "\r\n";
$message .= "Content-type: text/html;charset=utf-8\r\n\r\n";
$message .= "E-mail con <b>HTML</b>.";
 
$message .= "\r\n\r\n--" . $uniqueid. "--";

//Aqui ponemos el html

$exito=mail($to,$aunto,$message , join(“\r\n”,$headers));
```
