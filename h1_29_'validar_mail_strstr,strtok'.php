<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
include_once("style/style_old.css");
if(isset($_POST['mail'])){
    $txt=$_POST['mail'];
}else{
   $txt=''; 
}
?>
</head>
<body>
<div class='div'>
    <h2>Intro mail</h2>
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method='post' size="6">
        <input type="text" name="mail" value='<?php echo $txt; ?>' style="margin:auto;">

    </form>
</div>

<?php

$c=strstr($txt, '@');
$sw=false;
if(strlen($c)>7){
	if(strlen(strstr($c, '.'))>3){
		$a = strtok($txt, "@");
		if(strlen($a)>3){
			$sw = true;
			echo '<script type="text/javascript">alert("Email Valido");</script>';
			echo "<div class='div'><b>Email Valido</b></div>";
		}
	}
}

if(!$sw){
	echo '<script type="text/javascript">alert("Email Invalido");</script>';
	echo "<div class='div'><b>Invalido</b></div>";
}
?>
