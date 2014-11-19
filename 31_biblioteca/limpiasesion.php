<?php
session_start();
session_destroy();

echo'<html>
<head>
<meta http-equiv="refresh" content="0;URL=login.php">
</head>
</html>';
?>
