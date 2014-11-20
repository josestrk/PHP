<?php
 $on =  mysql_connect('localhost', 'root', '123456');
	 if (!$on) {
			die('No se conecto a MYSQL : ' . mysql_error());
	 }
 $db_selected = mysql_select_db('libreria', $on);
	if (!$db_selected) {
		die ('No se puede utilizar libreria: ' . mysql_error());
	}
?>