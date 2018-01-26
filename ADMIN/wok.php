<?php
	/*
	 * Incluimos el archivo que maneja el tratamiento de datos con la
	 * BBDD para la gestión del restaurante. Incluimos además, las clases
	 * Bases e Ingredientes para realizar consultas y obtener los resultados con los
	 * getters y setters.
	 *
	 * No es necesario session_start() porque ya lo comprobamos en el archivo
	 * de validación.
	*/

	include_once '../CLASES/Bases.php';
	include_once '../CLASES/Ingredientes.php';
	include_once 'gestionar-rest.php';

	if($_SESSION['tipo'] != 2 || !session_start()){

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
					<li class="active"><a href="../ADMIN/wok.php"><span class="glyphicon glyphicon-cutlery"></span> Wok</a></li>
					<li>
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
				<li class="active"><a href="wok.php">Wok</a></li>
			</ol>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="text-center">Gestionar Bases</h1>
					<table class="table table-condensed">
						<tr class="bg-primary">
							<th>#</th>
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php

							$conexion = new mysqli('localhost', 'root', '', 'wok');
							$conexion -> set_charset("utf8");
							$base = new Bases();
							
							/* comprobar la conexión */
							if ($conexion -> connect_errno) {

							    printf("Falló la conexión: %s\n", $conexion -> connect_error);
							    exit();
							}

							$consulta = "SELECT * FROM bases ORDER BY idBase ASC";
							$query = $conexion -> query($consulta);
							$filas = $query -> num_rows;

							if($filas > 0){

								while($row = $query -> fetch_array()){

									$base -> _setIdBase($row[0]);
									$base -> _setDescripcion($row[1]);
									$base -> _setPrecio($row[2]);

									echo "<tr>
											<td>".$base -> getIdBase()."</td>
											<td>".$base -> getDescripcion()."</td>
											<td>".$base -> getPrecio()."€"."</td>
										  </tr>";
								}
							}
						?>
					</table>
				</div>
			</div>
			<div class="row">
				
				<form action="" method="POST">
			
					<h3><span class="label label-primary">Seleccione la base a modificar o eliminar:</span></h3><br>
					<select name="base" class="form-control">
						<option value="0" selected>Seleccione...</option>
						<?php
							/*
							 * En un select mostramos las bases que hay en la BBDD (previa consulta)
							 * donde el value de cada <option> sera el idBase con el cual trabajaremos
							 * para poder realizar las acciones de modificar y eliminar.
							*/
							$consulta = $conexion -> query("SELECT * FROM bases") or trigger_error($conexion -> error."SELECT * FROM bases");

							$filas = $consulta -> num_rows;

							if($filas > 0){

								while ($row = $consulta -> fetch_array()) {
									
									$base -> _setIdBase($row[0]);
									$base -> _setDescripcion($row[1]);
									$base -> _setPrecio($row[2]);

									echo "<option value='".$base -> getIdBase()."' style='font-weight:bold;'>".$base -> getDescripcion()."<span style='color: red'> (".$base -> getPrecio().")</span>";

									

								}
							}

						?>
					</select><br>
					<h2 class="text-center"><span class="label label-warning">Si no selecciona ninguna puede introducir datos para crear una nueva base o solo seleccionar una y eliminarla</span></h2><br>
					<h4><span class="label label-info">Id Base:</span></h4>
						<input type='text' name='idBase' class="form-control"/><br>
					<h4><span class="label label-info">Descripción:</span></h4>
						<input type='text' name='descripBase' class="form-control"/><br>
					<h4><span class="label label-info">Precio:</span></h4>
						<input type='text' name='precio' class="form-control"/><br>
						<input type="submit" name="modificaBase" value="Modificar" class="btn btn-success">
						<input type="submit" name="insertaBase" value="Insertar" class="btn btn-info">
						<input type="submit" name="eliminaBase" value="Eliminar" class="btn btn-danger">
				</form>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<h1 class="text-center">Gestionar Ingredientes</h1>
					<table class="table table-bordered">
						<tr class="bg-primary">
							<th>Nombre</th>
							<th>Descripción</th>
						</tr>
						<?php
							
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
				
				<form action="" method="POST">
			
					<h3><span class="label label-primary">Seleccione el ingrediente a modificar o eliminar:</span></h3><br>
					<select name="ingre" class="form-control">
						<option value="0" selected>Seleccione...</option>
						<?php
							/*
							 * En un select mostramos los ingredientes que hay en la BBDD 
							 * (previa consulta) donde el value de cada <option> sera el idBase con el 
							 * cual trabajaremos para poder realizar las acciones de modificar y 
							 * eliminar.
							*/
							$consulta = $conexion -> query("SELECT * FROM ingredientes") or trigger_error($conexion -> error."SELECT * FROM ingredientes");

							$filas = $consulta -> num_rows;

							if($filas > 0){

								while ($row = $consulta -> fetch_array()) {
									
									$ingre -> _setNombreIng($row[0]);
									$ingre -> _setDescripcion($row[1]);

									echo "<option value='".$ingre -> getNombreIng()."' style='font-weight:bold;'>".$ingre -> getNombreIng()."</option>";
								}
							}

						?>
					</select><br>
					<h3 class="text-center"><span class="label label-warning">Si no selecciona ninguno puede introducir datos para crear un nuevo ingrediente o solo seleccionar uno y eliminarlo</span></h3><br>
					<h4><span class="label label-info">Nombre Ingrediente:</span></h4>
						<input type='text' name='nombreIng' class="form-control"/><br>
					<h4><span class="label label-info">Descripción:</span></h4>
						<input type='text' name='descripIngre' class="form-control"/><br>
					
						<input type="submit" name="modificaIngre" value="Modificar" class="btn btn-success">
						<input type="submit" name="insertaIngre" value="Insertar" class="btn btn-info">
						<input type="submit" name="eliminaIngre" value="Eliminar" class="btn btn-danger">
				</form>
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
		        <li><a href="wok.php">Wok</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="../js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>