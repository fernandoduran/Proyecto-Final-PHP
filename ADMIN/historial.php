<?php
	
	session_start();
	

	if(empty($_SESSION['name'])){
		$_SESSION['name'] = "";
	}

	if(empty($_SESSION['nick'])) {
		$_SESSION['nick'] = "";
	}
	
	if($_SESSION['tipo'] != 2 || !session_start()){

		header("Location: ../index.php");
	}
	include_once '../CLASES/Bases.php';
	include_once '../CLASES/Usuarios.php';
	include_once '../CLASES/Pedidos.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Wok Ca'n Llonguet</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
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
					<li><a href="../ADMIN/gestion.php"><span class="glyphicon glyphicon-cog"></span> Gestionar Usuarios</a></li>
					<li><a href="../ADMIN/wok.php"><span class="glyphicon glyphicon-cutlery"></span> Wok</a></li>
					<li class="active">
						<a href="historial.php"><span class="glyphicon glyphicon-info-sign"></span> Historial Pedidos</a>
					</li>
					<li><a href="../DATA/salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li id="wellcome">
			      		<a href=""><span class="glyphicon glyphicon-user"></span>
			      		<?php

			      			if($_SESSION['name'] == "" && $_SESSION['nick'] == ""){

			      				echo "¡Bienvenido Invitado!";
			      				
			      			} else {
			      				echo "¡Bienvenido <span style='color: red'>ADMINISTRADOR</span> (".$_SESSION['nick'].")!";
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
				<li class="active"><a href="historial.php">Historial pedidos</a></li>
			</ol>
		</div>

		<div class="container">
			<h1 class="text-center">Historial de pedidos de todos los usuarios del sistema</h1>
			<table class="table table-bordered">
				<tr class="bg-primary">
					<th>Número de pedido</th>
					<th>Nick del usuario</th>
					<th>Nombre del usuario</th>
					<th>Base seleccionada</th>
					<th>Ingredientes extra</th>
					<th>Fecha del pedido</th>
					<th>Estado del pedido</th>
				</tr>
				<?php
					/*
					 * Mostramos en una tabla el historial de pedidos de todos los usuarios
					*/
					$conexion = new mysqli('localhost', 'root', '', 'wok');
					$consulta = $conexion ->query("SELECT idPedido, pedidos.login, Nombre, descripcion, ingredientes, fechayhora, servido FROM pedidos, bases, usuario WHERE pedidos.idBase = bases.idBase AND usuario.login = pedidos.login ORDER BY servido ASC") or trigger_error($conexion -> error."SELECT idPedido, pedidos.login, Nombre, descripcion, ingredientes, fechayhora, servido FROM pedidos, bases, usuario WHERE pedidos.idBase = bases.idBase AND usuario.login = pedidos.login ORDER BY servido ASC");
					$conexion -> set_charset("utf8");
					
					$base = new Bases();
					$pedido = new Pedidos();
					$usu = new Usuarios();

					$filas = $consulta -> num_rows;

					if($filas > 0){

						while($row = $consulta -> fetch_array()){

							$pedido -> _setIdPedido($row[0]);
							$pedido -> _setLogin($row[1]);
							$usu -> _setNombre($row[2]);
							$base -> _setDescripcion($row[3]);
							$pedido -> _setIngredientes($row[4]);
							$pedido -> _setFechayHora($row[5]);
							$pedido -> _setServido($row[6]);

							echo "<tr>
									<td>".$pedido -> getIdPedido()."</td>
									<td>".$pedido -> getLogin()."</td>
									<td>".$usu -> getNombre()."</td>
									<td>".$base -> getDescripcion()."</td>
									<td>".$pedido -> getIngredientes()."</td>
									<td>".$pedido -> getFechayHora()."</td>";

									if($pedido -> getServido() == 0){

										echo "<td><span style='color: red; font-weight: bold;'>No entregado</span></td></tr>";
									} else {
										echo "<td>Entregado</td></tr>";
									}
						}
					}
				?>
			</table>
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
		        <li><a href="historial.php">Historial pedidos</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="../js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>