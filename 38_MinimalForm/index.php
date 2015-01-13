<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<title>Ejercicio 38</title>

		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>

		<?php
			class Quest{
				public $id;
				public $name;
				public $value;

				//si no lo inserta utiliza constructor vacio
				public function __construct($id,$name,$value){
					$this->id=$id;
					$this->name=$name;
					$this->value=$value;
				}
			}
			function delete(){
				$_SESSION=array();
				unset($_SESSION);
				session_destroy();
			}
			session_start();
			$q=array(
				new Quest (1,'Tipo', array('Piso','Adosado','Chale','Mansion')),
				new Quest (2,'Zona', array('Residencial','Rural','Urbana','Exteriores')),
				new Quest (3,'Dormitorios', array('1','2','3','4')),
				new Quest (4,'Precio', array('1','2','3','4')),
				new Quest (5,'Extras', array('Jardín','Piscina','Garage'))
			);
			$max=5;
			$i = isset($_SESSION['i']) ? $_SESSION['i'] : 0 ;
			if(isset($_POST) && $i!=0) $_SESSION['result'.$i]=$_POST;
		?>
	</head>
	<body>
		<div class="container">
			<!-- Top Navigation -->
			<header class="codrops-header">
				<h1>Form to exercise 38 <span>Guided input's</span></h1>	
			</header>
			<section>
				<form acttion=<?php echo "$_SERVER[PHP_SELF]"; ?> method="post" id="theForm" class="simform" autocomplete="off">
					<div class="simform-inner">
						<ol class="questions">
							<?php
								if($i<$max){
									echo '
									<li>
									<span><label for="q'.$q[$i]->id.'"></label>'.$q[$i]->name.'</span>
									<input  id="q'.$q[$i]->id.'" name="'.$q[$i]->name.'" type="text" autofocus />
									</li>';
									$_SESSION['i'] = $i+1;
								}else{
									var_dump($_SESSION);
									delete();//TO DO
								}
							?>
						</ol>
						<button class="submit" type="submit">Enviar resultados</button>
						<div class="controls">
							<button class="next"></button>
							<div class="progress"></div>
							<span class="number">
								<?php
									echo ($i+1)."/$max";
								?>
							</span>
							<span class="error-message"></span>
						</div>
						<!-- / controls -->
					</div><!-- /simform-inner -->
					<span class="final-message"></span>
				</form><!-- /simform -->			
			</section>
			
		</div><!-- /container -->
	</body>
</html>