47

Vamos a trabajar con una lista de  correo, administrar listas, etc. 
==================================================================

Primero creamos muestra base de datos donde guardamos  información para controlar las subscripciones de nuestros periódicos.

Preparación
===========

 ```sql
Tabla usuarios
===============

(id, nombre, apellido, dirección de correo.)
Tabla lista
============

id de la lista y el nombre de la lista

Tabla que relacionacionada (usuarios con suscripciones)
```
Cuando creamos las tablas tendremos que ver un mensaje de éxito como que se han creado todas las tablas.

Todo lo anterior lo haremos en #crear.php

Vamos a crear nuestra clase #correo_basico.php
- to
- cc 
- from 
- asunto 
- boolean texto
- texto
- boolean html
- htmlbody


Vamos a utilizar una clase que nos vamos hacer llamada #clase_simple.php
Tendrá:
- to
- cc 
- from 
- asunto 
- boolean texto
- texto
- boolean html
- htmlbody

Metodos: enviosolotexto, enviohtml, enviogeneral, etc

Creación
========

#suscripcion.php
Los usuarios se podrán subscribir a la lista de correos que deseen, para ello  les presentamos otro formulario 

adminitrar.php
==============

A continuación  administramos nuestra lista en administrar.php, en la creamos listas de correos, eliminamos y podemos cambiar el nombre.
