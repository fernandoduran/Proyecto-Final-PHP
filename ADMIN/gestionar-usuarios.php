<?php

	/*
	 * Si se ha pulsao el botón eliminar, capturamos el value de dicho boton y eliminamos
	 * al usuario de la BBDD.
	*/
	session_start();

	if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == ""){

		header("Location: ../index.php");
	}

	if (isset($_POST['eliminaUsuario'])) {
		
		$nick = $_POST['eliminaUsuario'];
		
		$conexion = new mysqli('localhost', 'root', '', 'wok');
		$conexion->set_charset("utf8");

		if (!$conexion) {
			echo "no se puede conectar a la base de datos.";
		}
				

		if($nick == 'admin'){
			
			echo "<script type='text/javascript'>alert('No se puede eliminar al administrador')</script>";
			//header("Location: ../ADMIN/gestion.php");
		

		} else {

			$conexion -> query("DELETE FROM usuario WHERE Login = '".$nick . "' ");

			echo "<script type='text/javascript'>alert('Usuario eliminado')</script>";
			
		}
		
	}
?>