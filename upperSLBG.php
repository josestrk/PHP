<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<style>
.formLS{width: 500px;float:left;background-color: #EEE;border: 2px solid #666;color: #6DAAF8;padding: 15px;font-family: sans-serif;font-weight: 700;margin: auto;}
.sb{
margin-top: 20px;
height: 40px;
background-color: #4BC5B2;
color: #FFF;
margin-right: 0px;
border-radius: 20px;
padding: 10px;}
h2,h4{color:orange;}
</style>
</head>
<body>
	<div class="formLS">
<?php

function create($i){
	echo '<h2>'.$i.' Bloque</h2><input type="hidden" name="Blq" value="'.$i.'">';
	echo '
	<div> 
		<h4> FOTO </h4> 
		Enlace de la foto y título: <input type="url" name="e_foto'.$i.'" size="50" required />
		<br>subir foto: <input name="uploadedfile'.$i.'" type="file" />
	<br><h4> DEFINICIÓN </h4> 
	Título: <input type="text" size="25" name="tit'.$i.'" required />
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
			
		$uploadedfile_size=$_FILES['uploadedfile'.$i][size];
		
		if ($_FILES['uploadedfile'.$i][size]>200000)
		{$msg=$msg."El archivo es mayor que 200KB, debes reduzcirlo antes de subirlo<BR>";
		$uploadedfileload="false";}

		if (!($_FILES['uploadedfile'.$i][type] =="image/jpeg" OR $_FILES['uploadedfile'.$i][type] =="image/gif" OR $_FILES['uploadedfile'.$i][type] =="image/png"))
		{$msg=$msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
		$uploadedfileload="false";}

		if($uploadedfileload && move_uploaded_file (basename($_FILES['uploadedfile'.$i][name]), $target_path))
		{
			$photo=basename($_FILES['uploadedfile'.$i][name]);
			echo "El archivo ". basename( $_FILES['uploadedfile'.$i][name]) ." ha sido subido";
		} else {
			$photo="example.jpg";
			echo "Ha ocurrido un error, [".$msg."]";
		}
		$content.='<div class="'.$_POST['tip'].'">
		<a href="'.$_POST['e_foto'.$i].'"><img src="http://slbg.es/themes/schoolstore/img/cms/web/'.$photo.'" width="150" height="156" alt="" /></a>
		<div class="content_product_slideshow">
			<h4><a class="text_page_color_text" href="'.$_POST['e_foto'.$i].'">'.$_POST['tit'.$i].'</a></h4>
			<p>'.$_POST['def'.$i].'</p>
		</div>
		</div>';
	}

	echo '<form name="f1"><textarea name="campo1" style="margin: 2px; width: 490px; height: 700px;resice:none; max-width:490px; min-width:490px;">'.$content.'</textarea>
	 <input type="button" onclick="copia_portapapeles()" value="Seleccionar Todo" /><form></div><div class="formLS">'.$content;
	 var_dump($_FILES);
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