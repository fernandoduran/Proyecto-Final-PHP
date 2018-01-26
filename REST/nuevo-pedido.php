<?php
	session_start();

	if(empty($_SESSION['name'])){
		$_SESSION['name'] = "";
	}

	if(empty($_SESSION['nick'])) {
		$_SESSION['nick'] = "";
	}
	include_once '../CLASES/Ingredientes.php';
	include_once '../CLASES/Bases.php';
	include_once 'validar-pedido.php';

	if($_SESSION['tipo'] != 1 || !session_start()){

		header("Location: ../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wok Ca'n Llonguet</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/forms.css">
		<link rel="stylesheet" type="text/css" href="../css/footer.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-social.css">
		<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      				<span class="sr-only">Desplegar navegación</span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
    			</button>
    			<a class="navbar-brand" href="#">
    				<span id="wok">WOK</span> <span id="llonguet">Ca'n Llonguet</span>
    			</a>
  			</div>

  			<div class="collapse navbar-collapse">

				<ul class="nav navbar-nav">
					<li>
						<a href="../index.php">Home</a>
					</li>
					<li><a href="../USER/modificar.php"><span class="glyphicon glyphicon-pencil"></span> Editar Perfil</a></li>
					<li class="active"><a href="../REST/nuevo-pedido.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li><a href="../REST/mis-pedidos.php"><span class="glyphicon glyphicon-cutlery"></span> Mis Pedidos</a></li>
					<li><a href="../DATA/contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
					<li><a href="../DATA/salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li id="wellcome">
			      		<a href=""><span class="glyphicon glyphicon-user"></span>
			      		<?php

			      			if($_SESSION['name'] == "" && $_SESSION['nick'] == ""){

			      				echo "¡Bienvenido Invitado!";
			      				
			      			} else {
			      				echo "¡Bienvenido ".$_SESSION['name']." (".$_SESSION['nick']."!)";
			      			}

			      		?></a>
			      	</li>
			      	<li>
			      		<a href=""><span class="glyphicon glyphicon-time"></span>
			      		<?php
			      			setlocale(LC_ALL, "es_ES");
							echo strftime("%d/%m/%Y - %H:%M:%S");
			      		?></a>
			      	</li>
				</ul>
			</div>
		</nav>
		<div>
			<ol id="migas"  class="breadcrumb">
				<li><a href="../index.php">Inicio</a></li>
				<li class="active"><a href="nuevo-pedido.php">Nuevo pedido</a></li>
			</ol>
		</div>

		<div class="container-fluid">
			<div class="jumbotron">
				<h1 id="titulo" class="text-center"><span id="wok">WOK</span> Ca'n Llonguet</h1>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>1.- Elige una base</h1>
					<form action="" method="POST">
						<?php
							/*
							 * Consultamos las bases disponibles y las mostramos en un radiobutton.
							 * El value de cada input será el id de la base.
							*/
							$conexion = new mysqli('localhost', 'root', '', 'wok');
							$conexion -> query("SET NAMES 'utf8'");
							$base = new Bases();
							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$consulta = "SELECT * FROM bases ORDER BY descripcion ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){
									$base -> _setIdBase($row[0]);
									$base -> _setDescripcion($row[1]);
									$base -> _setPrecio($row[2]);

									echo "<div class='col-sm-3 radio'>
											<input type='radio' name='bases' value='".$base->getIdBase()."' required> ".$base -> getDescripcion()."<br>
											<p style='font-weight: bold;'> Precio: <span style='color:red;'>".$base -> getPrecio()."</span></p><br>
										</div>	";
								}
							}
						?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<h1>2.- Elige los ingredientes <small>(1€ por cada ingrediente)</small></h1>
					
						<?php
							/*
							 * Consultamos los ingred. disponibles y las mostramos en checkboxes.
							 * El value de cada input será el nombre del ingrediente.
							*/
							
							$ingre = new Ingredientes();

							$consulta = "SELECT * FROM ingredientes ORDER BY nombreIng ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$ingre -> _setNombreIng($row[0]);
									$ingre -> _setDescripcion($row[1]);

									echo "<div class='col-sm-3 checkbox'>
											<input type='checkbox' name='ingre[]' value='".$ingre -> getNombreIng()."'>".$ingre -> getNombreIng()."<br>
											<p style='font-weight: bold;'>".$ingre -> getDescripcion()."</p><br>
										</div>";
								}
							}
						?>
						<div class="col-sm-12">
							
						<input type="submit" name="pedir" value="Realizar pedido" class="btn btn-success">
						</div>
					</form>
				</div>
			</div>			
		</div>

		<!--footer start from here-->
		<footer>
		  <div class="container">
		    <div class="row">
		      <div class="col-md-4 col-sm-6 footerleft ">
		        <div class="logofooter"><span id="wok">WOK</span> <span id="llonguet">Ca'n Llonguet</span></div>
		        <p class="text-justify">Restaurante de comida asiática con un toque mallorquín. Disfrute de la alta cocina occidental fusionada con la gastronomía local. Algo diferente jamás visto en Mallorca, toda una experiencia para los sentidos!</p>
		        <p><i class="fa fa-map-pin"></i> 189, Calle Aragón, Palma de Mallorca, Baleares</p>
		        <p><i class="fa fa-phone"></i> Teléfono : +34 971 421 652</p>
		        <p><i class="fa fa-envelope"></i> E-mail : info@wokcanlloguet.tk</p>
		        
		      </div>
		    </div>
		  </div>
		</footer>
		<!--footer start from here-->

		<div class="copyright">
		  <div class="container">
		    <div class="col-md-6">
		      <p>© 2017 - Todos los derechos reservados</p>
		    </div>
		    <div class="col-md-6">
		      <ul class="bottom_ul">
		        <li><a href="../index.php">Inicio</a></li>
		        <li><a href="nuevo-pedido.php">Realizar pedido</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="../js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>