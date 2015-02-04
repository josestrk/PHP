Utilizando la clase phpmailer vamos a añadir una funcionalidad al ejercicio de la vivienda. Si encontramos alguna vivienda que nos interesa, podemos enviar un mail a la inmobiliaria pidiendo información de dicha casa. Para iodentificar la casa que sea, enviamos todos los campos de la base de datos, dirección, tipo, ubicación y la imagen de la vivienda. Esxto lo pasamos como fichero adjunto, y todo lo demás en el body.

Adjuntamos el fichero con $mail¬>AddAttachment("ruta/archivo_adjunto.gif");

Incluimos los datos en el body con $body="contenido..."

Concatenamos todos los campos que hemos leído

La dirección de la inmobiliaria ser aun campo ocualto que nos pasa el formulario