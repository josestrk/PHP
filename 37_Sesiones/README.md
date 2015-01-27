Desactive las cookies de su navegador e intente acreditarse. No podrá porque el servidor no puede recibir de ningún modo su SID (está configurado para aceptarlo sólo a través de cookies).

	Desactive la directiva session.use_only_cookies y active la directiva session.use_trans_sid, reinicie todos los servicios de WAMP, recargue la página acreditacion.php y muestre su código fuente en Firefox. Compruebe que se ha añadido automáticamente un campo oculto con el SID de la sesión.

Intente acreditarse

Comprobará que sí se ha acreditado correctamente, pero el problema reside en que informacion.php no ha recibido el SID porque use_trans_sid no actúa sobre los headers y tendremos que incluir el SID manualmente. Cambia el código  el código añadiendo 

header('Location: informacion.php?'.SID);

Efectivamente ahora sí ha podido acreditarse correctamente. Coloque el puntero sobre Terminar sesión y compruebe en la barra de estado del navegador que aquí use_trans_sid sí ha incluido automáticamente el SID. Coloque a continuación el puntero sobre GOOGLE y confirme que aquí no lo ha incluido porque no es un url relativo (hacerlo hubiera sido un despropósito desde el punto de vista de la seguridad).


DIRECTIVAS A CAMBIAR PHP.INI PARA NO USAR COOKIES
session.use_only_cookies = 0
session.use_trans_sid = 1
