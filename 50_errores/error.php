<!--50.	Realizar error.php propuesto en la documentacion de errores . Nos va a presentar distintos .html dependiendo del código de error rec ibido.
# Customizable error responses come in three flavors:
# 1) plain text 2) local redirects 3) external redirects
#
# Some examples:
#ErrorDocument 500 "The server made a boo boo."
#ErrorDocument 404 /missing.html
#ErrorDocument 404 "/cgi-bin/missing_handler.pl"
#ErrorDocument 402 http://www.example.com/subscription_info.html

ErrorDocument 400 /50_error/error.php?400
ErrorDocument 401 /50_error/error.php?401
ErrorDocument 403 /50_error/error.php?403
ErrorDocument 404 /50_error/error.php?404
ErrorDocument 500 /50_error/error.php?500
-->
<?php
function errorEcho($number){
echo '
<!DOCTYPE html>
<html lang="es-ES" id="wp_maintenance_mode">
<head>
		
	<title>AgenciaLid</title>	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="author" content="WP Maintenance Mode: Frank Bueltge, http://bueltge.de" />
	<meta name="description" content="AgenciaLid - Línea de información en directo" />
	<meta name="keywords" content="Maintenance Mode" />
	<meta name="robots" content="index, follow" />
	<link rel="Shortcut Icon" type="image/x-icon" href="http://agencialid.com/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="http://agencialid.com/wp-content/plugins/wp-maintenance-mode/css/jquery.countdown.css" media="all" />
	
	<link rel="stylesheet" href="http://agencialid.com/wp-content/plugins/wp-maintenance-mode/styles/monster.css" type="text/css" media="all" />
	
</head>

<body>
	
	<div id="header">Errores</div>

	<div id="content">
		
		<H1>Error '.$number.'.</H1>
		
	</div>
	
				<div id="footer">
				<p><a href="http://bueltge.de/">Plugin de: <img src="http://bueltge.de/favicon.ico" alt="bueltge.de" width="16" height="16" /></a>
									&nbsp;<a href="http://www.distractedbysquirrels.com">Dise&ntilde;ado por: <img src="http://www.distractedbysquirrels.com/favicon.ico" alt="distractedbysquirrels.com" width="16" height="16" /></a>
								</p>
			</div>
			</body>
</html>';
}
if(isset($_GET['400'])){
    errorEcho('400');
}else if(isset($_GET['401'])){
    errorEcho('401');
}else if(isset($_GET['402'])){
    errorEcho('402');
}else if(isset($_GET['403'])){
    errorEcho('403');
}else if(isset($_GET['404'])){
    errorEcho('404');
}else if(isset($_GET['500'])){
    errorEcho('500');
}else{
    
}
?>