<?php
	/*
	 * Si la sesion de usuario está vacia mostramos un alert informado de que solo los usuarios
	 * registrados pueden hacer pedido y lo redirigimos a la pagina de login
	*/
	session_start();

	if($_SESSION['nick'] != ""){

		header("Location: ../index.php");
	}

	 echo ("
        <script language='JavaScript'>
            window.alert('Solo los usuarios registrados pueden realizar pedidos')
            window.location.href='../USER/login.php';
        </script>"
        );

?>