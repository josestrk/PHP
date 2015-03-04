<meta http-equiv="Content-Type" content="charset=utf-8">
<?php
// función de gestión de errores
function miGestorDeErrores($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // Este código de error no está incluido en error_reporting
        return;
    }

    switch ($errno) {
        case E_USER_ERROR:
        echo "<b>Mi ERROR</b> [$errno] $errstr<br />\n";
        echo "  Error fatal en la línea $errline en el archivo $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Abortando...<br />\n";
        exit(1);
        break;

        case E_USER_WARNING:
        echo "<b>Mi WARNING</b> [$errno] $errstr<br />\n";
        break;

        case E_USER_NOTICE:
        echo "<b>Mi NOTICE</b> [$errno] $errstr<br />\n";
        break;

        default:
        echo "Tipo de error desconocido: [$errno] $errstr<br />\n";
        break;
    }

    /* No ejecutar el gestor de errores interno de PHP */
    return true;
}

// función para probar el manejo de errores
function scale_by_log($vect, $scale)
{
    if (!is_numeric($scale) || $scale <= 0) {
        trigger_error("log(x) para x <= 0 no está definido, usó: scale = $scale", E_USER_ERROR);
    }

    if (!is_array($vect)) {
        trigger_error("Vector de entrada incorrecto, se esperaba una matriz de valores", E_USER_WARNING);
        return null;
    }

    $temp = array();
    foreach($vect as $pos => $valor) {
        if (!is_numeric($valor)) {
            trigger_error("El valor en la posición $pos no es un número, usando 0 (cero)", E_USER_NOTICE);
            $valor = 0;
        }
        $temp[$pos] = log($scale) * $valor;
    }

    return $temp;
}

// establecer el gestro de errores definido por el usuario
$gestor_errores_antiguo = set_error_handler("miGestorDeErrores");

// provocar algunos errores, primero definimos una matriz mixta con un elemento no numérico
echo "vector a\n";
$a = array(2, 3, "foo", 5.5, 43.3, 21.11);
print_r($a);

// ahora generamos una segunda matriz
echo "----\nvector b - a notice (b = log(PI) * a)\n";
/* Value at position $pos is not a number, using 0 (zero) */
$b = scale_by_log($a, M_PI);
print_r($b);

// esto es un problema, pasamos una cadena en vez de una matriz
echo "----\nvector c - a warning\n";
/* Vector de entrada incorrecto, se esperaba una matriz de valores */
$c = scale_by_log("no array", 2.3);
var_dump($c); // NULL

// esto es un error crítico, log de cero o de un número negativo es indefinido
echo "----\nvector d - fatal error\n";
/* log(x) para x <= 0 no está definido, usó: scale = $scale */
$d = scale_by_log($a, -2.5);
var_dump($d); // Nunca se alcanza
?>