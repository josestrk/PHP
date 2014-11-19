<?php
 function listar($sell,$orden,$id)
 {	
 			//___________________________________________________________________________________________________ select listar
			 if ($_SESSION['tipo']== "administrador")$admin=true;
			 else $admin=false;
			// tipos de orden
			switch($orden){
			 case 1:$ordenado="AUTOR";break;
			 case 2:$ordenado="NACIONALIDAD";break;
			 default:$ordenado="TITULO";break;
			}
			// ___________________________________________________________________________________________________ select listar
			if ($sell != "*") 
			{	
			 $sql= 'SELECT TITULO, AUTOR, NACIONALIDAD, ID FROM libex WHERE titulo regexp "'.$sell.'" or autor regexp "'.$sell.'" ORDER BY '.$ordenado.';';
			}
			else
			{
			 $sql= 'SELECT * FROM libex ORDER BY '.$ordenado.';';
			}
			  // ___________________________________________________________________________________________________ FIN select listar
				if ($result = mysql_query($sql)) 
				{	
							
						if(numeLibros($sell))
						{
						 echo "<table class='table' align='center' width='70%' >";
						 echo "<tr >
						 <td class='tit'><a href='index.php?bloc=".$sell."&orden=". 0 ."' class='";
						 	 if ($ordenado=="TITULO"){
							 echo 'tits';
							 } 
						 	 else {
							 echo 'titp';
							 }
						 echo "'>T&Iacute;TULO</a></td>
						 <td class='tit' ><a href='index.php?bloc=".$sell."&orden=". 1 ."' class='";
						  if ($ordenado=="AUTOR"){
							 echo 'tits';
							 } 
						 	 else {
							 echo 'titp';
							 }
						 echo "'>AUTOR</a></td>
						 <td class='tit'><a href='index.php?bloc=".$sell."&orden=". 2 ."' class='";
						  if ($ordenado=="NACIONALIDAD"){
							 echo 'tits';
							 } 
						 	 else {
							 echo 'titp';
							 }
						 echo"'>NACIONALIDAD</a></td>";
						 if($admin)echo "<td class='tit'><p class='titp'>OPCIONES</p></td>";// solo se muestra si eres administrador
						 echo "<td class='tit'><p class='titp'>CARATULA</td>";
						 echo "</tr>";
							while ($row = mysql_fetch_assoc($result)) 
							{							
										$change=false;
										if($id != 0)
										{
													$change=listar_editar($row,$row["ID"],$sell,$orden,$id);
										}
										if(!$change)
										{
										//antes de hacer el table genero un select para saber si el libro tiene foto o no
													$sqlfe="select id FROM caratulas WHERE ID =".$row["ID"];
													$resultmod = mysql_query($sqlfe);
													$foto = mysql_fetch_array($resultmod);
													if ($foto[0]!=0){$YES_FOTO=1;}else{$YES_FOTO=0;}
										//foto exisiste fin
													echo "<TR>";
													echo "<td>".$row["TITULO"]."</td>";
													echo "<td>".$row["AUTOR"]."</td>";
													echo "<td>".$row["NACIONALIDAD"]."</td>";
													if($admin)
													{
													echo '
														<td width="150px">
														<a href="index.php?&idEdit='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor""> Editar </a>&nbsp;&nbsp;
														<a href="index.php?&idDel='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'"  class="botont2" NAME="borrar" onfocus="class="cursor""> Borrar</a>
														<br>';
														echo'<a href="index.php?&modF='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'"  class="botont2" style="padding:0px 10px 0px 10px;" NAME="modfoto" onfocus="class="cursor"">'; if($YES_FOTO) echo 'Modificar foto'; else echo 'Introducir foto';
														echo '</a></td>';
													}
// (+) boton VER
													if ($YES_FOTO == 1) 
													{
														echo "
															<td width='150px'>
															<a href = 'javascript:popUp(\"verfoto.php?watch=".$row['ID']."\")'  class='botont2' NAME='ver' onfocus='class='cursor''>Ver</a>
														  	</td>";// OJO con las comillas dentro del javascript
													}
													echo "</TR>";
										}
							}
						 echo "</table>";
						}
				}
				
		mysql_close();
 }
 function numeLibros($sell){
	// _________________________________________________________________________________________ select contador de libros
			if ($sell != "*") 
			{	
			 $sql_num = 'SELECT COUNT(TITULO) FROM libex WHERE titulo regexp "'.$sell.'" or autor regexp "'.$sell.'";';
			}
			else
			{
			 $sql_num= 'SELECT COUNT(TITULO) FROM libex;';
			}
			
	// _________________________________________________________________________________________ FIN select contador de libros
			if ($num_res = mysql_query($sql_num)) 
			{
					while ($row = mysql_fetch_array($num_res)) 
					{
						if($row[0]==0)
						{	
							echo 'No existe ningun libro con ["'.$sell.'"] como TITULO ni como AUTOR <br>';	
							return false;									
						}
						else
						{
							echo "<br> EL N&Uacute;MERO TOTAL DE LIBROS ENCONTRADOS ES : <strong>".$row[0]."</strong>";
							return true;
						}	
					}
			}
 }
 function listar_editar($row,$idMod,$sell,$orden,$id){
	if($idMod==$id){//Esta comparacion se realiza para saber si id del array row es = al id de idEdit	
		if(isset($_GET['idEdit']))//si existe idEdit modifica
		{
			echo "<TR>";
			echo '<form action="index.php"   method="get">
			<td>
			<input  class="texto" type="text" name="t" value="'.$row["TITULO"].'"> 
			</td>';
			echo '
			<td>
			<input type="hidden" name="id" value="'.$id.'">
			<input type="hidden" name="orden" value="'.$orden.'">
			<input type="hidden" name="bloc" value="'.$sell.'">
			<input  class="texto" type="text" name="a" value="'.$row["AUTOR"].'"> 
			</td>';
			echo '
			<td>';
			 $sqln= 'SELECT distinct(NACIONALIDAD) FROM libex;';
			 echo '<select name="n">';
			 if ($resultn = mysql_query($sqln)) 
				{
					while ($nat = mysql_fetch_assoc($resultn)) 
					{
						//__ row es la nacionalidad del autor id seleccionado nat el array de nacionalidades
						if ($nat["NACIONALIDAD"]==$row["NACIONALIDAD"])
						{
						 echo '<option value="'.$nat["NACIONALIDAD"].'" selected='.$nat["NACIONALIDAD"].'>';
						 echo $row["NACIONALIDAD"];
						 echo '</option>' ;
						}
						else
						{
						 echo '<option value="'.$nat["NACIONALIDAD"].'">';
						 echo $nat["NACIONALIDAD"];
						 echo '</option>' ;
						}
					}
				}		 			 
			echo '</select></td>';
			echo '
			<td width="180px">
					<input type="submit" name="modificar" value="MODIFICAR" class="boton3" onfocus="class="cursor"">
			 <a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td><td></td>
			 </form>';
			echo "</TR>";
			// PREGUNTAR como ayar el id como mandarlo por form sin introducirlo 
			return true;// para que no vuelva a escribir la linea
		}
		else if (isset($_GET['idDel'])){// si existe idDel preguntara confirmar borrado
			echo "<TR bgcolor='#CC6633'>";
			echo '
			<td>
			'.$row["TITULO"].' 
			</td>';
			echo '
			<td>
			'.$row["AUTOR"].' 
			</td>';
			echo '
			<td>
			'.$row["NACIONALIDAD"].' 
			</td>';
			echo '
			<td width="150px">
					<a href="index.php?&idM='.$id.'&bloc='.$sell.'&orden='.$orden.'" class="boton3" style="background:-moz-linear-gradient( top, #F00 , #666); padding: 2px" onfocus="class="cursor""> confirmar borrado </a>
					<a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td>
			<td></td></TR>';
			return true;// para que no vuelva a escribir la linea
		}
		else if (isset($_GET['modF'])){// si exisite la variable modF modificara fila para editar foto
			echo "<TR>";
			echo '
			<td>
			'.$row["TITULO"].' 
			</td>';
			echo '
			<td>
			'.$row["AUTOR"].' 
			</td>';
			echo '
			<td>
			'.$row["NACIONALIDAD"].' 
			</td><td>
			<a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td>';
 // Modificación o INSERCION de foto.			
			echo '
			<td width="150px">
			<form enctype="multipart/form-data" action="index.php" method="post">
			<input type="hidden" name="orden" value="'.$orden.'">
			<input type="hidden" name="bloc" value="'.$sell.'">
			<input type="hidden" name="idFoto" value="'.$idMod.'">
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<input name="foto" type="file" size="8px">
			<input type="submit" class="boton3" value="Enviar fichero">		
			</form></td></TR>';
			return true;// para que no vuelva a escribir la linea
		}
	}
 }
 // FUNCION PARA MODIFICACION------------------------------------------------------
  function modifiLibro($idmod, $titulo, $autor, $nacionalidad){
	$sqlmod="UPDATE libex SET TITULO = '".$titulo."',
			AUTOR = '".$autor."',
			NACIONALIDAD = '".$nacionalidad."'
			 WHERE ID =".$idmod;
	if ($resultmod = mysql_query($sqlmod)) 
	{
		echo "SE HA MODIFICADO LA TABLA <br>";
		listar($_GET['bloc'],$_GET['orden'],0);
	}
 }
 // FUNCIONES PARA ALTAS------------------------------------------------------
 function altaLibro(){
			 echo "<table class='table' align='center' width='70%'>";
			echo "<TR>";
			echo '<form enctype="multipart/form-data" action="index.php"   method="post">
			<td>
			<input  class="texto" type="text" name="t" value="titulo"> 
			</td>';
			echo '
			<td>
			<input  class="texto" type="text" name="a" value="autor"> 
			</td>';
			echo '<td>';
			 $sqln= 'SELECT distinct(NACIONALIDAD) FROM libex;';
			 echo '<select name="n">';
			 if ($result = mysql_query($sqln)) 
				{
					while ($nat = mysql_fetch_assoc($result)) 
					{
					 echo '<option value="'.$nat["NACIONALIDAD"].'">';
					 echo $nat["NACIONALIDAD"];
					 echo '</option>' ;
					}
				}		 			 
			echo '</select></td>'; 
			echo '
			</tr><tr>
			<td colspan="1">
			Foto de la caratula:<br>(campo no obligatorio)</td>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<td colspan="2"> <input name="foto" type="FILE">	
			</td>
			</tr><tr>
			<td colspan="4">
			<input type="submit" name="ralta" value="Realizar Alta" class="boton3" onfocus="class="cursor"">
			</td>
			</tr></form>';
			echo "</table>";
 }
 //hacer alta en tabla
 function listadoAltas($up,$titulo,$autor,$nacionalidad){
		$idnew=0;
		$sql= 'SELECT MAX(ID) FROM libex';
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$idnew=$row[0]+1;
		//idnueva generada para nuevo libro
		$sqlalta="INSERT INTO libex (
				TITULO ,
				AUTOR ,
				NACIONALIDAD ,
				ID
				)
				VALUES (
				'".$titulo."', '".$autor."', '".$nacionalidad."', '".$idnew."'
				);";
		if ($resultmod = mysql_query($sqlalta)) 
		{
				echo "SE HA A&Ntilde;ADIDO [".$titulo."] A LA TABLA con id: ".$idnew."<br>";
				
		}
		else{
			echo "no se ha podido añadir";
		}
		// añadir foto si se introdjo
		if($_FILES['foto']['name']!="") 
		{
			upphoto($idnew,$titulo);
		}
		else listar($titulo,0,$idnew);
 }
 
 // (+) FUNCION PARA BORRAR ------------------------------------------------------
 function delLibro($idel){
	$sqlmod="DELETE FROM libex WHERE ID =".$idel;
	if ($resultmod = mysql_query($sqlmod)) 
	{
		echo "SE HA BORRADO DE LA TABLA <br>";
		$sqlfe="select id FROM caratulas WHERE ID =".$idel;
		$resultmod = mysql_query($sqlfe);
		$foto = mysql_fetch_array($resultmod);
		if ($foto[0]!=0){
				$sqldelfoto="DELETE FROM caratulas WHERE ID =".$idel;
				if ($resultdelfoto = mysql_query($sqldelfoto)){echo "SE HA BORRADO LA FOTO DE LA TABLA <br>";}
		}
		else{
			echo "NO TIENE FOTO <br>";	
		}
		listar($_GET['bloc'],$_GET['orden'],0);
	}
	else
	{
		echo "NO SE PUDO BORRAR \n";
	}
 }
 // (+) FUNCION PARA SUBIR FOTO ----------------------------------------------------
 function upphoto($id,$tit){
  	 $fileName = $_FILES['foto']['name']; 
	 $tmpName  = $_FILES['foto']['tmp_name']; 
	 $fileSize = $_FILES['foto']['size']; 
	 $fileType = $_FILES['foto']['type']; 
	 if($fileSize<=$_POST['MAX_FILE_SIZE']){
		 if($fileType == "image/jpg" or $fileType == "image/jpeg"){
			 if(!empty($fileName))
			 {
				$fp = fopen($tmpName, 'r'); 
				$content = fread($fp, $fileSize);
				$content=addslashes($content);
				fclose($fp);  
				$query = "INSERT INTO caratulas(id,imagen) VALUES ('$id','$content')";
				if (mysql_query($query))
					echo "la imagen ha sido guardada correctamente";
				else
				{
				 	$mquery = "UPDATE caratulas SET imagen='$content' WHERE id='$id'";
					mysql_query($mquery) or die("No se modifico la imagen");
					echo "la imagen ha sido modificada correctamente";
				 }
				 listar($tit,0,0);
			 }
		 }
		 else
		 {
			 echo "La foto debe ser JPG o JPEG,no se aceptan otros tipos";
		 }
	 }
	 else
	 {
		 echo "FOTO EXCESIVAMENTE GRANDE, Sidesea introducir esta foto reduszcala a menos de 100Kb<br>";
		 
	 }
 }
?>