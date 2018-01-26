<?php
	/*
	 * Incluimos el archivo que maneja el tratamiento de datos con la
	 * BBDD para la gestión de los usuarios. Incluimos además, la clase
	 * Usuarios para realizar consultas y obtener los resultados con los
	 * getters y setters.
	 *
	*/

	session_start();
	
	if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == ""){

		header("Location: ../index.php");
	}
	
	include_once 'gestionar-usuarios.php';
	include_once '../CLASES/Usuarios.php';
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
					<li>
						<a href="../index.php">Home</a>
					</li>
					<li class="active">
						<a href="gestion.php"><span class="glyphicon glyphicon-cog"></span> Gestionar Usuarios</a>
					</li>
					<li>
						<a href="../ADMIN/wok.php"><span class="glyphicon glyphicon-cutlery"></span> Wok</a>
					</li>
					<li>
						<a href="../ADMIN/historial.php"><span class="glyphicon glyphicon-info-sign"></span> Historial Pedidos</a>
					</li>
					<li>
						<a href="../DATA/salir.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a>
					</li>
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
				<li class="active"><a href="gestion.php">Gestionar usuarios</a></li>
			</ol>
		</div>

		<div class="container">
			<div class="row">

				<?php
					$conexion = new mysqli('localhost', 'root', '', 'wok');
					$conexion -> set_charset("utf8");
					
					/* comprobar la conexión */
					if ($conexion -> connect_errno) {

					    printf("Falló la conexión: %s\n", $conexion -> connect_error);
					    exit();
					}

					/*
					 * Hacemos una consulta del Login de los usuarios existentes en la
					 * BBDD y los almacenamos en un array.
					*/
					if ($consulta=$conexion ->query("SELECT Login FROM usuario")) {
						$usuarios=array();
						while ($filas=$consulta->fetch_array()) {
							array_push($usuarios, $filas[0]);
						}
					}
					$conexion -> close();
	   			?>
		   		<table class="table table-condensed">
		   			<tr>
		   				<th>Usuario</th>
		   				<th colspan="2" class="text-center">Accion</th>
		   			</tr>
		   			<tbody>
			   			<form action="" method="POST">
			   			<?php
			   				/*
			   				 * Recorremos el array e imprimos cada posicion en un <tr>, mostrando
			   				 * en un <td> el login y en otros dos los botones de editar y eliminar
			   				 * cuyo value es el login del usuario.
			   				*/
			   				foreach ($usuarios as $key => $value) {
			   					echo "<tr>
			   							<td>$value</td>
			   					 		<td>
			   					 			<button disabled type='submit'  class='btn btn-warning' name='editaUsuario' value='$value'>Editar</button>
			   					 		</td>
			   					 		<td>
			   					 			<button  type='submit'  class='btn  btn-danger' name='eliminaUsuario' value='$value'><span class='glyphicon glyphicon-remove'></span></button>
			   					 		</td>
			   					 	</tr>";
			   				}


			   			?>
			   			</form>
		   			</tbody>
		   		</table>
			</div>
		</div>

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
		        <li><a href="../index.php">Inicio</a></li>
		        <li><a href="gestion.php">Gestion</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="../js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>