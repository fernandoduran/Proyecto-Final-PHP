<?php
	session_start();

	if(empty($_SESSION['name'])){
		$_SESSION['name'] = "";
	}

	if(empty($_SESSION['nick'])) {
		$_SESSION['nick'] = "";
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
		<link rel="stylesheet" type="text/css" href="../css/contacto.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-social.css">
		<link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
	<?php
		if(!$_SESSION['nick']){
	?>
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
					<li><a href="../USER/login.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
					<li><a href="../GUESS/registro.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
					<li><a href="../GUESS/pedido-invitado.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li class="active"><a href=contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
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
				<li class="active"><a href="contacto.php">Contacto</a></li>
			</ol>
		</div>
		<section id="contact" style="">
            <div class="container">
                <div class="row">
                    <div class="about_our_company" style="margin-bottom: 20px;">
                        <h1 style="color:#fff;">Escribanos su mensaje</h1>
                        <div class="titleline-icon"></div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form name="sentMessage" id="contactForm" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="form-control">Nombre:</label>
                                        <input type="text" class="form-control" placeholder="Su Name *" id="name" name="name" required data-validation-required-message="Por favor introduzca su nombre.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-control">Email:</label>
                                        <input type="email" class="form-control" placeholder="Su Email *" id="email" name="email" required data-validation-required-message="Por favor introduzca su email.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-control">Teléfono:</label>
                                        <input type="tel" class="form-control" placeholder="Teléfono *" id="phone" name="phone" required data-validation-required-message="Introduzca su número de teléfono.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="form-control">Mensaje:</label>
                                        <textarea class="form-control" placeholder="Su mensaje *" id="message" name="message" required data-validation-required-message="Escriba aqui su Mensaje."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-xl get">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <p style="color:#fff;">
                            <strong><i class="fa fa-map-marker"></i> Dirección</strong><br>
                             189, Calle Aragón, Palma de Mallorca, Baleares
                        </p>
                        <p style="color:#fff;"><strong><i class="fa fa-phone"></i> Teléfono</strong><br>
                             +34 971 421 652</p>
                        <p style="color:#fff;">
                            <strong><i class="fa fa-envelope"></i>  Email</strong><br>
                            info@wokcanlloguet.tk</p>
                        <p></p>
                    </div>
                </div>
            </div>
        </section>

	<?php

         if (isset($_POST['submit'])) {
            
            echo "<script type='text/javascript'>alert('Gracias por tu mensaje')</script>";
        }
        
		}elseif ($_SESSION['nick'] != "admin") {
	?>
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
						<a href="index.php">Home</a>
					</li>
					<li><a href="../USER/modificar.php"><span class="glyphicon glyphicon-pencil"></span> Editar Perfil</a></li>
					<li><a href="../REST/nuevo-pedido.php"><span class="glyphicon glyphicon-cutlery"></span> Nuevo Pedido</a></li>
					<li><a href="../REST/mis-pedidos.php"><span class="glyphicon glyphicon-cutlery"></span> Mis Pedidos</a></li>
					<li class="active"><a href="contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
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
				<li class="active"><a href="contacto.php">Contacto</a></li>
			</ol>
		</div>

		<section id="contact" style="">
            <div class="container">
                <div class="row">
                    <div class="about_our_company" style="margin-bottom: 20px;">
                        <h1 style="color:#fff;">Escribanos su mensaje</h1>
                        <div class="titleline-icon"></div>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form name="sentMessage" id="contactForm" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="form-control">Nombre:</label>
                                        <input type="text" class="form-control" placeholder="Su Name *" id="name" name="name" required data-validation-required-message="Por favor introduzca su nombre.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-control">Email:</label>
                                        <input type="email" class="form-control" placeholder="Su Email *" id="email" name="email" required data-validation-required-message="Por favor introduzca su email.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                    <label class="form-control">Teléfono:</label>
                                        <input type="tel" class="form-control" placeholder="Teléfono *" id="phone" name="phone" required data-validation-required-message="Introduzca su número de teléfono.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="form-control">Mensaje:</label>
                                        <textarea class="form-control" placeholder="Su mensaje *" id="message" name="message" required data-validation-required-message="Escriba aqui su Mensaje."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" name="submit" class="btn btn-xl get">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <p style="color:#fff;">
                            <strong><i class="fa fa-map-marker"></i> Dirección</strong><br>
                             189, Calle Aragón, Palma de Mallorca, Baleares
                        </p>
                        <p style="color:#fff;"><strong><i class="fa fa-phone"></i> Teléfono</strong><br>
                             +34 971 421 652</p>
                        <p style="color:#fff;">
                            <strong><i class="fa fa-envelope"></i>  Email</strong><br>
                            info@wokcanlloguet.tk</p>
                        <p></p>
                    </div>
                </div>
            </div>
        </section>
        <?php }

        if (isset($_POST['submit'])) {
            
            echo "<script type='text/javascript'>alert('Gracias por tu mensaje')</script>";
        }
        ?>
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