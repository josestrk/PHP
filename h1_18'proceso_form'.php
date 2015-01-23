<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style/style_old.css");
?>
</head>
<body>
	<div class="formLS">
<?php

function create($i){
	echo '<h2>'.$i.' Bloque</h2><input type="hidden" name="Blq" value="'.$i.'">';
	echo '
	<div> 
		<h4> FOTO </h4> 
		Enlace de la foto: <input type="url" name="e_foto'.$i.'" size="50" />
		<br>subir foto: <input name="uploadedfile'.$i.'" type="file" />
	<br><h4> DEFINICIÓN </h4> 
	Título: <input type="text" size="25" name="tit'.$i.'" required />
	<br>Enlace del título: <input type="url" name="e_tit'.$i.'" size="50" required />
	<br>
	<br>Definición CORTA:<small>200 caracteres máximo</small><br> <textarea maxlength="200" rows="3" cols="15" name="def'.$i.'" style="resice:none; max-width:388px; min-width:388px;  max-height:100px; min-height:90px;margin: 2px;" required ></textarea><br>
	</div>';
}
if (!isset($_POST['Blq'])){
	echo "<form enctype='multipart/form-data' action=$_SERVER[PHP_SELF] method='post'>";
	create(1);
	echo '</div><div class="formLS">';
	create(2);
	echo '</div><div class="formLS">';
	echo "
		<div align='center'>
		Bloque que vas a editar:  <small>(lateral de la imagen central)</small><br>
		<input type='radio' name='tip' value='product_left_slideshow product_slideshow' checked >Left            
		<input type='radio' name='tip' value='product_right_slideshow product_slideshow'>Right<br>
		<input type='submit' value='Enviar' class='sb' /></div>";
	echo '</form>';
}else{
	
	$content;
	for($i=1;$i<=2;$i++){
		$target_path = "/themes/schoolstore/img/cms/web/";
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { $photo=$_FILES['uploadedfile']['tmp_name'];echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
		} else{
			$photo="example.jpg";
			echo "Ha ocurrido un error, trate de nuevo!";
		}
		$content.='<div class="'.$_POST['tip'].'">
		<a href="'.$_POST['e_foto'.$i].'"><img src="http://slbg.es/themes/schoolstore/img/cms/web/'.$photo.'" width="150" height="156" alt="" /></a>
		<div class="content_product_slideshow">
			<h4><a class="text_page_color_text" href="'.$_POST['e_tit'.$i].'">'.$_POST['tit'.$i].'</a></h4>
			<p>'.$_POST['def'.$i].'</p>
		</div>
		</div>';
	}
	echo '<form name="f1"><textarea name="campo1" style="margin: 2px; width: 490px; height: 700px;resice:none; max-width:490px; min-width:490px;">'.$content.'</textarea>
	 <input type="button" onclick="copia_portapapeles()" value="Seleccionar Todo" /><form></div><div class="formLS">'.$content;
}
?>
</div>
</body>
<script language="javascript">

function copia_portapapeles(){ 
   document.f1.campo1.select() 
   //window.clipboardData.setData("Text", document.f1.campo1.value); 
} 
</script>
</html>