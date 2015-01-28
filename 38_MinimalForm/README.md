Formulario para realizar una consulta a la base de datos de viviendas de una inmobiliaria.
En este formulario aparecen de una vez todas las características que el usuario puede seleccionar para realizar la búsqueda de la vivienda.

Se pretende modificar este formulario dividiéndolo en varios formularios sucesivos para crear un asistente que vaya pidiendo los datos de uno en uno y al final muestre los resultados de la búsqueda. En concreto, el asistente irá preguntando lo siguiente en cada paso:
•	Paso 1: tipo de la vivienda
•	Paso 2: zona de la vivienda
•	Paso 3: número de dormitorios 
•	Paso 4: rango de precio de la vivienda
•	Paso 5: características extra de la vivienda

1 - 5 muestran los distintos pasos del asistente
6: Resultados de la búsqueda

Hay que crear en total 4 formularios. Cada uno de ellos sigue el esquema del formulario de PHP con sus tres partes conocidas: (a) validar formulario, (b) procesar formulario y (c) mostrar formulario.

Los formularios 1, 2 y 3 son iguales, con la excepción de los elementos de entrada que contienen. La parte (b) de los tres consiste en avanzar al paso siguiente del asistente, cargando el formulario correspondiente. 

La llamada a la función header produce la carga de la página pasada como parámetro a la función, y que será la que muestra el paso siguiente del formulario. En el caso del formulario 5, la parte (b) consiste en construir la consulta, enviarla a la base de datos y mostrar los resultados.

Por otra parte, los formularios 2, 3 y 4 tendrán un botón que permitirá retroceder al paso anterior del asistente

La 5 muestra el esquema navegacional del asistente con todos los enlaces entre los diferentes pasos del mismo.

 
Figura 7: Estructura navegacional del asistente
El usuario puede saber en cada momento el paso en el que se encuentra gracias a las indicaciones que se le muestran encima del formulario, donde aparecen los cuatro pasos del asistente, estando el paso actual destacado respecto a los demás (a través de los estilos paso y pasoactual definidos en la hoja de estilo).

Para completar el asistente, es preciso disponer en cada paso de la información introducida en el paso anterior. Esta información se almacenará en variables de sesión. El procedimiento para hacer esto es el siguiente:
a)	En cada formulario debe iniciarse la sesión. Para ello se colocará al comienzo del mismo, antes que nada, una llamada a la función de PHP session_start.
b)	En los pasos 1, 2 y 3, antes de cargar el siguiente paso, se almacenarán en la sesión los datos recibidos del formulario. Por ejemplo, en el paso 1 se hará:
	$_SESSION['tipo'] = $tipo;
c)	En los pasos 2, 3 y 4 se recuperarán los datos almacenados en la sesión a la vez que se obtienen los datos del formulario. Por ejemplo, en el paso 2 se hará:
	$tipo = $_SESSION['tipo'];

En realidad la recuperación de los datos de la sesión sólo es necesaria en el paso 4 para realizar la consulta, pero se hace en cada paso para mostrar al usuario la evolución de su consulta

Nota: No se va a poner un ejercicio especifico de token pero se debe añadir a algún formulario que nos parezca interesante su control. 
En el ejercicio 38 es interesante utilizar la clase collator para controlar las comunidades autonomas
