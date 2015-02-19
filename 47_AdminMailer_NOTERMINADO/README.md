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

admin.php
==============

A continuación  administramos nuestra lista en administrar.php, en la creamos listas de correos, eliminamos y podemos cambiar el nombre.

1. Primero comprobara que somos administradores para poder realizar esta tarea.
2. El administrador podrá administrar la lista ,  para ello creamos una página de administración.


Administración de lista
=======================

Podremos crear, eliminar  y modificar las listas de correo( admin.php) 

#Funciones de Configuración
•	atributos - Configuraremos los atributos basicos que tendra nuestra lista de usuarios, tales como edad, sexo, nacionalidad, etc

#Funciones de lista y usuario
•	list - Enumera las listas que tenemos para enviar, mediante estas listas podemos separar y mantener a nuestros grupos de usuarios, por ejemplo, podemos tener una lista de interes de automóviles, otra lista de tecnologia, otra lista de negocios etc.
•	usuarios - Muestra a todos los usuarios o suscriptores de nuestra base de datos
•	Importar - Aqui se puede importar usuarios de diferentes formas, la principal es subiendo mediante un archivos separados por coma CSV (esto se puede exportar mediante excel a CSV). Los usuarios deben estar en una misma columna con el encabezado "email"
•	exportar - En esta opción podemos exportar los usuarios de todas las listas o de una determinada lista, esta lista es exportada a formato CSV, la cual se podra abrir posteriormente en Excel.

El administrador debe poder enviar correos a todos los miembros de las distintas listas de correo, en destinatario aparece all (envio_rapido.php)

