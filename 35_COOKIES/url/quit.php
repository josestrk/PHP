<!doctype html>
<head>
<?php
foreach ($_COOKIE as $key=>$val) {
	unset($_COOKIE[$key]);
	setcookie($key,'',-1,'/');
}
echo '<META http-equiv="refresh" content="0.5;URL=index35.php">';
?>
</head>
<body>
</body>
</html>