<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
/*26. Captcha
*/
include_once("style/style_old.css");
if(isset($_GET['text'])){
    $txt=$_GET['text'];
}else{
   $txt=''; 
}
?>
</head>
<body>
<div class='div'>
    <h2>Captcha PNG</h2>
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method='get' size="6">
        <input type="text" name="text" value='<?php echo $txt; ?>' style="margin:auto;">
    </form>
    <iframe src=<?php echo "h1_26PNG.php?txt=".$txt; ?> frameborder="1px" style="margin: auto;    height: 100px;   width: 200px;">
    </iframe>
</div>
<div class='div'>
    <h2>Captcha JPEG</h2>
    <img src="h1_26JPG.php" frameborder="1px" style="margin: auto;    height: 100px;   width: 200px;">
</div>
<div class='div'>
    <h2>Captcha GIF</h2>
    <img src="h1_26GIF.php" frameborder="1px" style="margin: auto;    height: 100px;   width: 200px;">
</div>
</body>
</html>
