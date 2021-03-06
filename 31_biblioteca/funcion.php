<?php
 function listar( $sell, $orden, $id )
 {	
    //___________________________________________________________________________________________________ select listar
    $admin = ( $_SESSION['tipo'] == "administrador" ) ? true : false;
    // tipos de orden
    switch($orden){
     case 1:$ordenado="AUTOR";break;
     case 2:$ordenado="NACIONALIDAD";break;
     default:$ordenado="TITULO";break;
    }
    // ___________________________________________________________________________________________________ select listar
    $sql= ( $sell != "*" ) 
    ?  'SELECT TITULO, AUTOR, NACIONALIDAD, ID FROM libex WHERE titulo regexp "'.$sell.'" or autor regexp "'.$sell.'" ORDER BY '.$ordenado.';'
    : 'SELECT * FROM libex ORDER BY '.$ordenado.';';
  // ___________________________________________________________________________________________________ FIN select listar
    $selection = $on->query($sql);
					
							
    if(numeLibros($sell)){
     echo "<table class='table' align='center' width='70%' >";
     echo "<tr >
         <td class='tit'><a href='index.php?bloc=".$sell."&orden=". 0 ."' class='";

            echo ($ordenado=="TITULO") ? 'tits':'titp';
         echo "'>T&Iacute;TULO</a></td>
         <td class='tit' ><a href='index.php?bloc=".$sell."&orden=". 1 ."' class='";
            echo ($ordenado=="AUTOR") ? 'tits':'titp';
         echo "'>AUTOR</a></td>
         <td class='tit'><a href='index.php?bloc=".$sell."&orden=". 2 ."' class='";
            echo ($ordenado=="NACIONALIDAD") ? 'tits':'titp';
         echo"'>NACIONALIDAD</a></td>";

         if($admin) echo "<td class='tit'><p class='titp'>OPCIONES</p></td>";// solo se muestra si eres administrador

         echo "<td class='tit'><p class='titp'>CARATULA</td>";
     echo "</tr>";

        while ($row = $selection->fetch_assoc()){							
            $change = false;
            if($id != 0){
                $change=listar_editar($row,$row["ID"],$sell,$orden,$id);
            }
            if(!$change){
            //antes de hacer el table genero un select para saber si el libro tiene foto o no
                $sqlfe = "SELECT id FROM caratulas WHERE ID =".$row["ID"];
                $resultmod = $on->query($sqlfe);
                $foto = $resultmod ->fetch_array();
                $YES_FOTO= ( $foto[0] != 0 ) ? 1 : 0;
            //foto exisiste fin
                echo "<tr>";
                echo "<td>".$row["TITULO"]."</td>";
                echo "<td>".$row["AUTOR"]."</td>";
                echo "<td>".$row["NACIONALIDAD"]."</td>";
                if($admin){
                    echo '
                    <td width="150px">
                    <a href="index.php?&idEdit='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor""> Editar </a>&nbsp;&nbsp;
                    <a href="index.php?&idDel='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'"  class="botont2" NAME="borrar" onfocus="class="cursor""> Borrar</a>
                    <br>';
                    echo'<a href="index.php?&modF='.$row["ID"].'&bloc='.$sell.'&orden='.$orden.'"  class="botont2" style="padding:0px 10px 0px 10px;" NAME="modfoto" onfocus="class="cursor"">'; 

                    echo ($YES_FOTO == 1) ? 'Modificar foto' : 'Introducir foto';

                    echo '</a></td>';
                }
            //(+) boton VER
                if ($YES_FOTO == 1){
                    echo "
                        <td width='150px'>
                        <a href = 'javascript:popUp(\"verfoto.php?watch=".$row['ID']."\")'  class='botont2' NAME='ver' onfocus='class='cursor''>Ver</a>
                        </td>";
                }
                echo "</tr>";
            }
        }
    echo "</table>";
    }		
    $selection->free();
    $on->close();
}

function numeLibros($sell){
    // _________________________________________________________________________________________ select contador de libros
    $sql_num = ($sell != "*") 
    ? 'SELECT COUNT(TITULO) FROM libex WHERE titulo regexp "'.$sell.'" or autor regexp "'.$sell.'";' 
    : 'SELECT COUNT(TITULO) FROM libex;';
    // _________________________________________________________________________________________ FIN select contador de libros
    $result = $on->query($sql_num);
    $num_res = $on->affected_rows;
    if($num_res==0){	
        echo 'No existe ningun libro con ["'.$sell.'"] como TITULO ni como AUTOR <br>';	
        return false;									
    }else{
        echo "<br> EL N&Uacute;MERO TOTAL DE LIBROS ENCONTRADOS ES : <strong>".$num_res."</strong>";
        return true;
    }	
}

function listar_editar($row,$idMod,$sell,$orden,$id){
    if($idMod==$id){//Esta comparacion se realiza para saber si id del array row es = al id de idEdit	
        //si existe idEdit modifica
        if(isset($_GET['idEdit'])){
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
             $resultn = $on->query($sqln);

             while ($nat = $resultn->fetch_assoc()){
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

            echo '</select></td>';
            echo '<td width="180px">
                    <input type="submit" name="modificar" value="MODIFICAR" class="boton3" onfocus="class="cursor"">
             <a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td><td></td>
             </form>';
            echo "</TR>";
            // PREGUNTAR como ayar el id como mandarlo por form sin introducirlo 
            return true;// para que no vuelva a escribir la linea
        }else if( isset($_GET['idDel']) ){// si existe idDel preguntara confirmar borrado
            echo "<TR bgcolor='#CC6633'>";
            echo '<td>'.$row["TITULO"].'</td>';
            echo '<td>'.$row["AUTOR"].'</td>';
            echo '<td>'.$row["NACIONALIDAD"].'</td>';
            echo '<td width="150px">
            <a href="index.php?&idM='.$id.'&bloc='.$sell.'&orden='.$orden.'" class="boton3" style="background:-moz-linear-gradient( top, #F00 , #666); padding: 2px" onfocus="class="cursor""> confirmar borrado </a>
            <a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td>
            <td></td></TR>';
            return true;// para que no vuelva a escribir la linea
        }else if ( isset($_GET['modF']) ){// si exisite la variable modF modificara fila para editar foto
            echo "<TR>";
            echo '<td>'.$row["TITULO"].'</td>';
            echo '<td>'.$row["AUTOR"].'</td>';
            echo '<td>'.$row["NACIONALIDAD"].'</td><td>
            <a href="index.php?&bloc='.$sell.'&orden='.$orden.'" class="botont2" NAME="editar" onfocus="class="cursor"">Cancelar</a></td>';
            // Modificación o INSERCION de foto.			
            echo '<td width="150px">
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
    $resultn>free();
}

 // FUNCION PARA MODIFICACION------------------------------------------------------
  function modifiLibro($idmod, $titulo, $autor, $nacionalidad){
	$sqlmod="UPDATE libex SET TITULO = '".$titulo."',
			AUTOR = '".$autor."',
			NACIONALIDAD = '".$nacionalidad."'
			 WHERE ID =".$idmod;
	if ($resultmod = $on->query($sqlmod)) 
	{
		echo "SE HA MODIFICADO LA TABLA <br>";
		listar($_GET['bloc'],$_GET['orden'],0);
	}
	$resultmod->free();
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
			 if ($result = $on->query($sqln)) 
				{
					while ($nat = $result->fetch_assoc()) 
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
			$result->free();
 }
 //hacer alta en tabla
 function listadoAltas($up,$titulo,$autor,$nacionalidad){
		$idnew=0;
		$sql= 'SELECT MAX(ID) FROM libex';
		$result = $on->query($sql);
		$row = $result->fetch_array(MYSQLI_NUM);
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
		if ($resultmod =$on->query($sqlalta)) 
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
		$result->free();
		$resultmod->free();
 }
 
 // (+) FUNCION PARA BORRAR ------------------------------------------------------
 function delLibro($idel){
	$sqlmod="DELETE FROM libex WHERE ID =".$idel;
	if ($resultmod = $on->query($sqlmod)) 
	{
		echo "SE HA BORRADO DE LA TABLA <br>";
		$sqlfe="select id FROM caratulas WHERE ID =".$idel;
		$resultmod = $on->query($sqlfe);
		$foto = $resultmod->fetch_array(MYSQLI_NUM);
		if ($foto[0]!=0){
				$sqldelfoto="DELETE FROM caratulas WHERE ID =".$idel;
				if ($resultdelfoto = $on->query($sqlmod)){echo "SE HA BORRADO LA FOTO DE LA TABLA <br>";}
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
				if ( $on->query($query))
					echo "la imagen ha sido guardada correctamente";
				else
				{
				 	$mquery = "UPDATE caratulas SET imagen='$content' WHERE id='$id'";
					$on->query($mquery) or die("No se modifico la imagen");
					echo "la imagen ha sido modificada correctamente";
				 }
				 listar($tit,0,0);
			 }
		 }
		 else
		 {
			 echo "La foto debe ser JPG o JPEG,no se aceptan otros tipos";
		 }
	 }else{
		 echo "FOTO EXCESIVAMENTE GRANDE, Sidesea introducir esta foto reduszcala a menos de 100Kb<br>"; 
	 }
 }
?>