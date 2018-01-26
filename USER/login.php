<?php
	session_start();

	include_once 'validar-login.php';
		
	if(empty($_SESSION['name'])){
		$_SESSION['name'] = "";
	}

	if(empty($_SESSION['nick'])) {
		$_SESSION['nick'] = "";
	}

	if(empty($_SESSION['tipo'])) {
		$_SESSION['tipo'] = "";
	}

	if(empty($_SESSION['intentos'])){
			$_SESSION['intentos'] = "";
		}
	$_SESSION['captxa'] = rand(150000, 350000);

	if($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 1){

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
		<link rel="stylesheet" type="text/css" href="../css/forms.css">
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
					<li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
					<li><a href="../GUESS/registro.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
					<li><a href="../GUESS/pedido-invitado.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li><a href="../DATA/contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
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
				<li><a href="../index.php">Inicio</a></li>
				<li class="active"><a href="login.php">Entrar</a></li>
			</ol>
		</div>

		<div class="container">
			<div class="row">
			    <div class="col-sm-6 col-md-4 col-md-offset-4">
			        <div class="account-wall">
			            <div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="login">
			               		<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
			                    alt="">
			               		<form class="form-signin" action="" method="POST">
			               			<input type="text" class="form-control" name="inputNick" placeholder="Username" required autofocus>
			               			<input type="password" class="form-control" name="inputPass" placeholder="Password" required>
			               			<?php

			               				if($_SESSION['intentos']>=3){

			               					echo "<label class='form-control'>".$_SESSION['captxa']."</label>
			               						<input type='text' id='inputCaptxa' name='inputCaptxa' class='form-control' requried>";
			               				}

			               			?>
			               			<input type="submit" name="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
			               		</form>
			               		<div id="tabs" data-tabs="tabs">
			               			<p class="text-center"><a href="../GUESS/registro.php" data-toggle="tab">¿No tiene una cuenta?</a></p>
			              		</div>
							</div>
			            </div>
			        </div>
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
		        <li><a href="login.php">Login</a></li>
		      </ul>
		    </div>
		  </div>
		</div>
		<script src="../js/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="../js/bootstrap.min.js"></script>
		
	</body>
</html>