49.	 Realizar un  administrador de archivos sencillo.
Utilizaremos parte del php del ejercicio 48 y además añadiremos otros scripts de php.
En concreto debemos controlar :

•	Navegación por el árbol del web. Se podrá acceder a cada uno de los directorios situados por debajo del directorio donde esta nuestro index. También podremos ver los ficheros que cuelgan de dichos directorios
•	Borrado de ficheros . Podremos eliminar un fichero en concreto
•	Renombrar ficheros
•	Crear nuevos directorios Siempre lo crea en el que nos encontramos en ese momento
•	Borrar directorios. Solo se podrá hacer si se encuentra vacio
•	Mostrar árbol completo e un directorio. Muestra todos los directorios, subdirectorios y archivos del directorio en el que nos encontramos en ese momento

***Administrador.php 

Nos presentara todos los elementos del directorio que reciba en cada momento
Con el icono de la derecha accedemos a operaciones _ directorio.php o a operaciones_ ficheros.php

Con el icono de la izquierda podemos  tener diferentes comportamientos dependiendo de si esta asociado a un directorio o a un fichero.

Si pulsamos cuando está en un directorio te lista todos sus ficheros.(el icono será una carpeta). En este caso redirigimos a la página administrador.php con el parámetro $directorio

Si pulsamos cuando está en un fichero te visualiza su contenido en el navegador. (is_dir())(el icono será una página de texto)

***operaciones _ directorio.php y operaciones_ ficheros.php

Permite seleccionar que operaciones hacer sobre el directorio y sobre el fichero.

Hay formularios para crear directorio, borrar directorio

Finalmente existe operación.php que es el encargado de realizar todas las operaciones dependiendo de si recibe un código u otro en $_GET[‘operación’]
También recibe $_GET[‘directorio’] que indica el fichero o directorio sobre el que realizo la operación. 

Codigo 0, 1,2 3,4,5 para Crear directorio, borrar directorio, mostrar directorio, borrar fichero, copiar y renombrar fichero

```php
Funciones interesantes que nos podemos crear:

Function existe_nombre_en _directorio($nombre)
{
Return file_exists($nombre);
}

Indica si un nombre existe ya en el directorio actual.
Function esta_vacio_directorio()
Indica si está o no vacio 
Utilizar la función mostrar_directorio($raiz) que será recursiva
```