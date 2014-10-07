<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel=stylesheet href="css/css1.css" type="text/css">
</head>
<body>
<?php
	$dni=$_REQUEST['dni'];

	function letra(){
		global $dni;
		$letras=['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];
		return $letras[$dni%23];
	}

	
	echo "<p>DNI:".$dni."-".letra()."</p>";
	echo "<p>DNI:".$dni."-".letra()."</p>";

	echo "<p>".var_dump($GLOBALS)."</p>";
?>
</body>
</html>