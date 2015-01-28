<?php
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', 'root');

if (isset($_COOKIE['tema'])) {
  $tema = 'css/' . $_COOKIE['tema'];
  echo "<link rel='stylesheet' type='text/css' href=$tema>";
}

if (isset($_COOKIE['idioma'])) {
  include_once('idiomas/' . $_COOKIE['idioma'] . '.php');
} else {
  include_once('idiomas/es.php');
}
?>
