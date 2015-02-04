<HTML>
<HEAD><TITLE>CARATULA</TITLE>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</HEAD>
	<meta http-equiv="Content-Type" content="text/html ; charset=iso-8859-1" >
<BODY >
		<?php
	
		header("Content-type: image/jpg");
		require('conexionmysql.php');
    	$id      = $_GET['watch']; 
    	$query   = "SELECT imagen FROM libros WHERE id = ' ".$id." '"; 
    	$result  = mysql_query($query) or die('Error, query failed'); 
		
    	list($content) = mysql_fetch_array($result);  
    	echo '<img src="'.$content.'">'; 

    	mysql_close();
		?>
</BODY>
</HTML>


