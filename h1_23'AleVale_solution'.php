<!doctype html>
<head><meta http-equiv="Content-Type" content="charset=utf-8">
<?php
require_once("style/style_old.css");
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


function mostrar(){
	$contact=array(
			"Jorge" => array(
						"dirección" => array("C/Rms"),
						"telefono" => array(987987),
						"email" => array("Rs@gmail.com")
						),
			"Javier" => array(
						"dirección" => array("C/Pms"),
						"telefono" => array(8987987),
						"email" => array("Ps@gmail.com")
						),
			"Adrian" => array(
						"dirección" => array("Cs/Rms"),
						"telefono" => array(98798877,98765473),
						"email" => array("Rss@gmail.com")
						)
			);

	$opt = func_get_args();

	if (empty($opt[0])) {
		echo "<table border='1px'>";
		foreach ($contact as $key => $value) {
			echo "<tr><td>".$key."</td>";
			foreach ($value as $info => $valorfinal) {
				echo "<td>".$info."->";
				foreach ($valorfinal as $indice => $fin) {
					echo $fin;
				}
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}else{
		$clave=$contact[$opt[0]];
		echo "<table border='1px'>";
		foreach ($clave as $info => $valorfinal) {
				echo "<td>".$info."->";
				foreach ($valorfinal as $indice => $fin) {
					echo $fin;
				}
				echo "</td>";
			}
		echo "</table>";
	}
}
if (isset($_POST['submit'])){
	if ($_POST['submit'] == "Contactos") {
		mostrar();
	}else{
		mostrar($_POST['nombre']);
	}
}
?>
</div>
</body>
</html>