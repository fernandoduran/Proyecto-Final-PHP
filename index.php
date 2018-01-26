<?php
	session_start();

	if(empty($_SESSION['name'])){
		$_SESSION['name'] = "";
	}

	if(empty($_SESSION['nick'])) {
		$_SESSION['nick'] = "";
	}
	include_once 'CLASES/Ingredientes.php';
	include_once 'CLASES/Bases.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Wok Ca'n Llonguet</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap-social.css">
		<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<?php 
			if(!$_SESSION['nick']){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
					<li class="active">
						<a href="index.php">Home</a>
					</li>
					<li><a href="USER/login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
					<li><a href="GUESS/registro.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
					<li><a href="GUESS/pedido-invitado.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li><a href="DATA/contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
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
				</ul>
			</div>
		</nav>

		<div>
			<ol id="migas"  class="breadcrumb">
				<li class="active"><a href="index.php">Inicio</a></li>
				<li><a></a></li>
			</ol>
		</div>

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  
		  <!-- Indicators -->
		  <ol class="carousel-indicators">

		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>

		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="images/slide1.jpg" alt="Fritura con verduras">
		    </div>

		    <div class="item">
		      <img src="images/slide2.jpg" alt="Wok">
		    </div>

		    <div class="item">
		      <img src="images/slide3.jpg" alt="Chop suey">
		    </div>

		    <div class="item">
		      <img src="images/slide4.jpg" alt="Sashimi">
		    </div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

		<div class="container-fluid">
			<div class="jumbotron">
				<h1 id="titulo" class="text-center"><span id="wok">WOK</span> Ca'n Llonguet</h1>
			</div>

			<div class="row">
				<div class="col-sm-12 col-xs-12">
					<h1>Bienvenidos/as a Wok Ca'n Llonguet</h1>

					<p>En nuestro restaurante podrá disfruta de la cocina oriental con un toque del mediterráneo.</p>

					<p>Hemos contratado a los mejores Chef's mallorquines y japoneses para que nuestros platos sean de una calidad exclusiva.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestros ingredientes</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							$conexion = new mysqli('localhost', 'root', '', 'wok');
							$conexion -> query("SET NAMES 'utf8'");
							$ingre = new Ingredientes();
							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$consulta = "SELECT * FROM ingredientes ORDER BY nombreIng ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$ingre -> _setNombreIng($row[0]);
									$ingre -> _setDescripcion($row[1]);

									echo "<tr>
											<td>".$ingre -> getNombreIng()."</td>
											<td>".$ingre -> getDescripcion()."</td>
										  </tr>";
								}
							}
						?>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestras bases</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							
							$base = new Bases();
							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$consulta = "SELECT descripcion, precio FROM bases ORDER BY descripcion ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$base -> _setDescripcion($row[0]);
									$base -> _setPrecio($row[1]);

									echo "<tr>
											<td>".$base -> getDescripcion()."</td>
											<td>".$base -> getPrecio()."€"."</td>
										  </tr>";
								}
							}

							$conexion -> close();
						?>
					</table>
				</div>
			</div>
			
		</div>
		<?php
			} elseif ($_SESSION['nick'] == "admin") {
		?>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
					<li class="active">
						<a href="index.php">Home</a>
					</li>
					<li><a href="ADMIN/gestion.php"><span class="glyphicon glyphicon-cog"></span> Gestionar Usuarios</a></li>
					<li><a href="ADMIN/wok.php"><span class="glyphicon glyphicon-cutlery"></span> Wok</a></li>
					<li><a href="ADMIN/historial.php"><span class="glyphicon glyphicon-info-sign"></span> Historial Pedidos</a></li>
					<li><a href="DATA/salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li>
			      		<a href=""><span class="glyphicon glyphicon-user"></span>
			      		<?php

			      			if($_SESSION['name'] == "" && $_SESSION['nick'] == ""){

			      				echo "¡Bienvenido Invitado!";
			      				
			      			} else {
			      				echo "¡Bienvenido <span style='color: red'>ADMINISTRADOR</span> (".$_SESSION['nick'].")!";
			      			}

			      		?></a>
			      	</li>
			      	<li id="wellcome">
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
				<li class="active"><a href="index.php">Inicio</a></li>
				<li><a></a></li>
			</ol>
		</div>

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  
		  <!-- Indicators -->
		  <ol class="carousel-indicators">

		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>

		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="images/slide1.jpg" alt="Fritura con verduras">
		    </div>

		    <div class="item">
		      <img src="images/slide2.jpg" alt="Wok">
		    </div>

		    <div class="item">
		      <img src="images/slide3.jpg" alt="Chop suey">
		    </div>

		    <div class="item">
		      <img src="images/slide4.jpg" alt="Sashimi">
		    </div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

		<div class="container-fluid">
			<div class="jumbotron">
				<h1 id="titulo" class="text-center"><span id="wok">WOK</span> Ca'n Llonguet</h1>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Bienvenidos/as a Wok Ca'n Llonguet</h1>

					<p>En nuestro restaurante podrá disfruta de la cocina oriental con un toque del mediterráneo.</p>

					<p>Hemos contratado a los mejores Chef's mallorquines y japoneses para que nuestros platos sean de una calidad exclusiva.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestros ingredientes</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							$conexion = new mysqli('localhost', 'root', '', 'wok');
							$conexion -> query("SET NAMES 'utf8'");
							$ingre = new Ingredientes();
							
							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$consulta = "SELECT * FROM ingredientes ORDER BY nombreIng ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$ingre -> _setNombreIng($row[0]);
									$ingre -> _setDescripcion($row[1]);

									echo "<tr>
											<td>".$ingre -> getNombreIng()."</td>
											<td>".$ingre -> getDescripcion()."</td>
										  </tr>";
								}
							}
						?>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestras bases</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							
							$base = new Bases();

							$consulta = "SELECT descripcion, precio FROM bases ORDER BY descripcion ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$base -> _setDescripcion($row[0]);
									$base -> _setPrecio($row[1]);

									echo "<tr>
											<td>".$base -> getDescripcion()."</td>
											<td>".$base -> getPrecio()."€"."</td>
										  </tr>";
								}
							}

							$conexion -> close();
						?>
					</table>
				</div>
			</div>
			
		</div>

		<?php
			} else {
		?>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
					<li class="active">
						<a href="index.php">Home</a>
					</li>
					<li><a href="USER/modificar.php"><span class="glyphicon glyphicon-pencil"></span> Editar Perfil</a></li>
					<li><a href="REST/nuevo-pedido.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li><a href="REST/mis-pedidos.php"><span class="glyphicon glyphicon-cutlery"></span> Mis Pedidos</a></li>
					<li><a href="DATA/contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
					<li><a href="DATA/salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
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
				<li class="active"><a href="index.php">Inicio</a></li>
				<li><a></a></li>
			</ol>
		</div>

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  
		  <!-- Indicators -->
		  <ol class="carousel-indicators">

		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		    <li data-target="#myCarousel" data-slide-to="1"></li>
		    <li data-target="#myCarousel" data-slide-to="2"></li>
		    <li data-target="#myCarousel" data-slide-to="3"></li>

		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="images/slide1.jpg" alt="Fritura con verduras">
		    </div>

		    <div class="item">
		      <img src="images/slide2.jpg" alt="Wok">
		    </div>

		    <div class="item">
		      <img src="images/slide3.jpg" alt="Chop suey">
		    </div>

		    <div class="item">
		      <img src="images/slide4.jpg" alt="Sashimi">
		    </div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>

		<div class="container-fluid">
			<div class="jumbotron">
				<h1 id="titulo" class="text-center"><span id="wok">WOK</span> Ca'n Llonguet</h1>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Bienvenidos/as a Wok Ca'n Llonguet</h1>

					<p>En nuestro restaurante podrá disfruta de la cocina oriental con un toque del mediterráneo.</p>

					<p>Hemos contratado a los mejores Chef's mallorquines y japoneses para que nuestros platos sean de una calidad exclusiva.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestros ingredientes</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							$conexion = new mysqli('localhost', 'root', '', 'wok');

							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$conexion -> query("SET NAMES 'utf8'");
							$ingre = new Ingredientes();
							
							$consulta = "SELECT * FROM ingredientes ORDER BY nombreIng ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$ingre -> _setNombreIng($row[0]);
									$ingre -> _setDescripcion($row[1]);

									echo "<tr>
											<td>".$ingre -> getNombreIng()."</td>
											<td>".$ingre -> getDescripcion()."</td>
										  </tr>";
								}
							}
						?>
					</table>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1>Nuestras bases</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							
							$base = new Bases();

							$consulta = "SELECT descripcion, precio FROM bases ORDER BY descripcion ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$base -> _setDescripcion($row[0]);
									$base -> _setPrecio($row[1]);

									echo "<tr>
											<td>".$base -> getDescripcion()."</td>
											<td>".$base -> getPrecio()."€"."</td>
										  </tr>";
								}
							}
							$conexion -> close();
						?>
					</table>
				</div>
			</div>
			
		</div>
		<?php }?>
		<link href="https://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
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
		        <li><a href="index.php">Inicio</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		
	</body>
</html>