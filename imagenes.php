<?php
echo "
<form ACTION=$_SERVER[PHP_SELF] METHOD=POST ENCTYPE=multipart/form-data>
	<input type=file name=imagen>
	<input type=submit>

</form>
";
if(isset($_FILES['imagen']['name'])){
  echo "name:".$_FILES['imagen']['name']."\n";
   echo "tmp_name:".$_FILES['imagen']['tmp_name']."\n";
   echo "size:".$_FILES['imagen']['size']."\n";
   echo "type:".$_FILES['imagen']['type']."\n";
}
?>