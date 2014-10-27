<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style.css");
?>
</head>
<body>
	<div class="formLS">
		<h3>Agenda</h3>
		<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
		Nombre:<input type="text" name="nombre"><br>
		Buscar:<input type="submit" name="submit" value="Persona" class="sb" ><br>
		<input type="submit" name="submit" value="Contactos" class="sb" >
		</form>
	</div>
<?php
/*
23-Guardar en una agenda toda la información de nuestros amigos, y crear un formulario que nos pida el nombre de uno y nos saca la información de él.
También existe en el formulario la posibilidad de visualizar toda la agenda.
*/
$contact=array(
			"jorge" => array(
						"dirección" => array("C/Rms"),
						"telefono" => array(987987),
						"email" => array("Rs@gmail.com")
						),
			"javier" => array(
						"dirección" => array("C/Pms"),
						"telefono" => array(8987987,98798877,98765473,98798877,98765473),
						"email" => array("Ps@gmail.com")
						),
			"adrian" => array(
						"dirección" => array("Cs/Rms"),
						"telefono" => array(98798877,98765473),
						"email" => array("Rss@gmail.com")
						)
			);

function mostrar(){
	$opt = func_get_args();

	if (!empty($opt[0])) {
		echo "<table border='1px'>";
		foreach ($opt[0] as $key => $value) {
			echo "<tr><td>".$key."</td>";
			foreach ($value as $info => $valorfinal) {
				echo "<td>";
				if(is_array($valorfinal))
					foreach ($valorfinal as $indice => $fin)
						echo " ".$fin;
				else
					echo $valorfinal;
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}

if (isset($_POST['submit'])){
	if ($_POST['submit'] == "Contactos") {
		mostrar($contact);
	}else{
		if(! ($_POST['nombre']==""))
			mostrar($contact[strtolower($_POST['nombre'])]);
	}
}
?>
</div>
</body>
</html>